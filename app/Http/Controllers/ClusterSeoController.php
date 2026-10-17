<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\ResidentialCluster;
use App\Models\ServiceCategory;
use App\Models\Faq;
use App\Models\ProjectGallery;
use App\Services\Seo\SchemaGeneratorService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

/**
 * ClusterSeoController
 *
 * Handles public-facing hyper-local pSEO pages for elite residential clusters.
 *
 * Routes:
 *   GET /area-perumahan/{clusterSlug}                 → show()
 *   GET /area-perumahan/{clusterSlug}/{categorySlug}  → service()
 */
class ClusterSeoController extends Controller
{
    public function __construct(
        private readonly SchemaGeneratorService $schemaGenerator,
        private readonly \App\Services\SpintaxService $spintaxService
    ) {}

    /* ─────────────────────────────────────────────────────────────────
     | CLUSTER LANDING — /area-perumahan/{clusterSlug}
     | ─────────────────────────────────────────────────────────────── */

    public function show(string $clusterSlug): Response
    {
        $cacheKey = "cluster_show_v2_{$clusterSlug}";

        $html = Cache::remember($cacheKey, 3600, function () use ($clusterSlug): string {
            /** @var ResidentialCluster $cluster */
            $cluster = ResidentialCluster::with([
                'city.province',
                'district',
                'districts',
                'projectGalleries' => fn ($q) => $q->where('is_active', true)->latest()->take(6),
            ])
                ->where('slug', $clusterSlug)
                ->where('is_active', true)
                ->firstOrFail();

            // Enforce noindex gate — 404 so Googlebot never caches thin stubs
            if (! $cluster->is_indexable) {
                abort(404);
            }

            $canonicalUrl = url("/area-perumahan/{$clusterSlug}");

            // ── Service categories for cross-sell grid ───────────────
            $categories = ServiceCategory::where('is_active', true)
                ->orderBy('sort_order')
                ->get(['id', 'name', 'slug', 'icon', 'description']);

            // ── Localised FAQs: cluster-specific + generic fallback ──
            $faqs = Faq::where('is_active', true)
                ->where(function ($q) use ($cluster) {
                    $q->whereRaw("LOWER(question) LIKE ?", ['%' . strtolower($cluster->short_name ?? $cluster->name) . '%'])
                      ->orWhere('faq_category_id', null);
                })
                ->orderByDesc('is_featured_home')
                ->take(6)
                ->get(['question', 'answer']);

            // Ensure we always have at least 3 FAQs
            if ($faqs->count() < 3) {
                $extra = Faq::where('is_active', true)
                    ->whereNotIn('id', $faqs->pluck('id'))
                    ->take(3 - $faqs->count())
                    ->get(['question', 'answer']);
                $faqs = $faqs->merge($extra);
            }

            // ── JSON-LD schemas ───────────────────────────────────────
            $faqArr = $faqs->map(fn ($f) => [
                'question' => $f->question,
                'answer'   => strip_tags($f->answer),
            ])->toArray();

            $schemas = [
                $this->schemaGenerator->getLocalBusinessSchema($cluster->city),
                $this->schemaGenerator->getFaqSchema($faqArr),
            ];

            $metaTitle       = $cluster->meta_title
                ?? "Jasa Tukang Pipa {$cluster->name} | Rootera Plumbing 24 Jam";
            $metaDescription = $cluster->meta_description
                ?? "Layanan pipa mampet dan instalasi plumbing profesional di {$cluster->name}. Teknisi tersertifikasi, harga transparan, estimasi tiba cepat.";

            return view('pages.cluster-landing', compact(
                'cluster',
                'categories',
                'faqs',
                'schemas',
                'canonicalUrl',
                'metaTitle',
                'metaDescription',
            ))->render();
        });

        return response($html);
    }

    /* ─────────────────────────────────────────────────────────────────
     | CLUSTER × SERVICE — /area-perumahan/{clusterSlug}/{categorySlug}
     | ─────────────────────────────────────────────────────────────── */

    public function service(string $clusterSlug, string $categorySlug): Response
    {
        $cacheKey = "cluster_service_v2_{$clusterSlug}_{$categorySlug}";

        $html = Cache::remember($cacheKey, 3600, function () use ($clusterSlug, $categorySlug): string {
            $cluster = ResidentialCluster::with(['city.province', 'district'])
                ->where('slug', $clusterSlug)
                ->where('is_active', true)
                ->firstOrFail();

            if (! $cluster->is_indexable) {
                abort(404);
            }

            $category = ServiceCategory::where('slug', $categorySlug)
                ->where('is_active', true)
                ->firstOrFail();

            $canonicalUrl = url("/area-perumahan/{$clusterSlug}/{$categorySlug}");

            // ── Project galleries for this category+city combo ────────
            $projectShowcases = ProjectGallery::with(['city', 'district', 'serviceCategory'])
                ->where('is_active', true)
                ->where(function ($q) use ($cluster, $category) {
                    $q->where('residential_cluster_id', $cluster->id)
                      ->orWhere(function ($q2) use ($cluster, $category) {
                          $q2->where('city_id', $cluster->city_id)
                             ->where('service_category_id', $category->id);
                      });
                })
                ->latest()
                ->take(4)
                ->get();

            // ── All categories for sidebar nav ────────────────────────
            $allCategories = ServiceCategory::where('is_active', true)
                ->orderBy('sort_order')
                ->get(['id', 'name', 'slug', 'icon']);

            // ── FAQs ──────────────────────────────────────────────────
            $faqs = Faq::where('is_active', true)
                ->where(function ($q) use ($cluster, $category) {
                    $q->whereRaw("LOWER(question) LIKE ?", ['%' . strtolower($category->name) . '%'])
                      ->orWhereRaw("LOWER(question) LIKE ?", ['%' . strtolower($cluster->short_name ?? $cluster->name) . '%']);
                })
                ->orderByDesc('is_featured_home')
                ->take(5)
                ->get(['question', 'answer']);

            // ── JSON-LD schemas ───────────────────────────────────────
            $faqArr = $faqs->map(fn ($f) => [
                'question' => $f->question,
                'answer'   => strip_tags($f->answer),
            ])->toArray();

            $schemas = [
                $this->schemaGenerator->getLocalBusinessSchema($cluster->city),
                $this->schemaGenerator->getServiceSchema($category, $cluster->city),
                $this->schemaGenerator->getFaqSchema($faqArr),
            ];

            $copyAliases = Cache::remember("cat_copy_alias_list_{$category->id}", 3600, function () use ($category) {
                return \App\Models\ServiceAlias::active()
                    ->copyOnly()
                    ->where('service_category_id', $category->id)
                    ->pluck('keyword')
                    ->take(6)
                    ->all();
            });

            $seedKey = "cluster_svc_{$cluster->id}_{$category->id}";
            $heroHeadline = $this->spintaxService->generateHeroHeadline($category->name, $cluster->name, $seedKey, $category->id);
            $heroSubtitle = $this->spintaxService->generateHeroSubtitle($category->name, $cluster->name, $cluster->estimated_arrival ?? '20–40 menit', $seedKey, $category->id);

            $metaTitle       = "{$category->name} di {$cluster->name} | Rootera Plumbing";
            $metaDescription = "Jasa {$category->name} profesional di kawasan {$cluster->name}. "
                . "Teknisi berpengalaman, harga transparan, garansi pekerjaan. ☎ 0813-8540-4000.";

            return view('pages.cluster-service', compact(
                'cluster',
                'category',
                'projectShowcases',
                'allCategories',
                'faqs',
                'schemas',
                'canonicalUrl',
                'metaTitle',
                'metaDescription',
                'copyAliases',
                'heroHeadline',
                'heroSubtitle',
            ))->render();
        });

        return response($html);
    }
}
