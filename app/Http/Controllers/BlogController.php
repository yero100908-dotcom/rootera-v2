<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $categories     = Article::CATEGORIES;
        $filterCategory = $request->query('category', 'all');
        $filterPostType = $request->query('type') ?: $request->query('filter', 'all');
        $rawSearch      = $request->query('search') ?: $request->query('q');
        $tag            = $request->query('tag');

        // Sanitasi Kata Kunci Pencarian (Mencegah ReDoS / SQL Wildcard Flooding)
        $search = null;
        $escapedSearch = null;
        if (!empty($rawSearch)) {
            $search = Str::substr(strip_tags(trim($rawSearch)), 0, 80);
            $escapedSearch = addcslashes($search, '%_\\');
        }

        // 1 & 2. Hero Headline (60%) & Side Highlights (40%) - Cache IDs (1 Jam)
        $heroIds = Cache::remember('blog_hero_ids_v2', 3600, function () {
            $headlineId = Article::published()
                ->headline()
                ->orderBy('published_at', 'desc')
                ->value('id');

            if (!$headlineId) {
                $headlineId = Article::published()
                    ->orderBy('published_at', 'desc')
                    ->value('id');
            }

            $excludedIds = $headlineId ? [$headlineId] : [];

            $sideIds = Article::published()
                ->whereNotIn('id', $excludedIds)
                ->featured()
                ->orderBy('published_at', 'desc')
                ->take(3)
                ->pluck('id')
                ->toArray();

            if (count($sideIds) < 3) {
                $existingSideIds = array_merge($excludedIds, $sideIds);
                $needed = 3 - count($sideIds);

                $additionalSideIds = Article::published()
                    ->whereNotIn('id', $existingSideIds)
                    ->orderBy('views', 'desc')
                    ->orderBy('published_at', 'desc')
                    ->take($needed)
                    ->pluck('id')
                    ->toArray();

                $sideIds = array_merge($sideIds, $additionalSideIds);
            }

            return [
                'headline_id'     => $headlineId,
                'side_ids'        => $sideIds,
                'heroExcludedIds' => array_merge($excludedIds, $sideIds),
            ];
        });

        $headline = $heroIds['headline_id'] 
            ? Article::select(Article::LIST_COLUMNS)->find($heroIds['headline_id']) 
            : null;

        $sideHeadlines = !empty($heroIds['side_ids'])
            ? Article::select(Article::LIST_COLUMNS)->whereIn('id', $heroIds['side_ids'])->get()
            : collect();

        $heroExcludedIds = $heroIds['heroExcludedIds'] ?? [];

        // 3. Dedicated Video Guides (Rootera TV) - Cached IDs (1 Jam)
        $videoIds = Cache::remember('blog_video_ids_v2', 3600, function () {
            return Article::published()
                ->where(function ($q) {
                    $q->where('post_type', Article::TYPE_VIDEO_GUIDE)
                      ->orWhereNotNull('youtube_video_id');
                })
                ->orderBy('published_at', 'desc')
                ->take(6)
                ->pluck('id')
                ->toArray();
        });

        $videoArticles = !empty($videoIds)
            ? Article::select(Article::LIST_COLUMNS)->whereIn('id', $videoIds)->orderBy('published_at', 'desc')->get()
            : collect();

        // 4. Categories & Content Hub Post Types Aggregation Count - Cached (1 Jam)
        $categoryCounts = Cache::remember('blog_category_counts_v2', 3600, function () use ($categories) {
            $countsRaw = Article::published()
                ->selectRaw('category, count(*) as total')
                ->groupBy('category')
                ->pluck('total', 'category');

            $counts = [];
            foreach ($categories as $catKey => $catLabel) {
                $counts[$catKey] = (int) ($countsRaw[$catKey] ?? 0);
            }
            return $counts;
        });

        $postTypeCounts = Cache::remember('blog_post_type_counts_v2', 1800, function () {
            return [
                'all'           => Article::published()->count(),
                'article'       => Article::published()->where(function ($q) {
                    $q->whereNull('post_type')->orWhere('post_type', Article::TYPE_ARTICLE);
                })->whereNull('youtube_video_id')->count(),
                'promo'         => Article::published()->where('post_type', Article::TYPE_PROMO)->count(),
                'case_study'    => Article::published()->where('post_type', Article::TYPE_CASE_STUDY)->count(),
                'news'          => Article::published()->where('post_type', Article::TYPE_NEWS)->count(),
                'press_release' => Article::published()->where('post_type', Article::TYPE_PRESS_RELEASE)->count(),
                'video_guide'   => Article::published()->where(function ($q) {
                    $q->where('post_type', Article::TYPE_VIDEO_GUIDE)->orWhereNotNull('youtube_video_id');
                })->count(),
            ];
        });

        // 5. Main Feed Query (Hanya memuat LIST_COLUMNS untuk efisiensi RAM/DB)
        $query = Article::published()->select(Article::LIST_COLUMNS);

        // Filter Kategori
        if ($filterCategory !== 'all' && isset($categories[$filterCategory])) {
            $query->where('category', $filterCategory);
        }

        // Filter Tipe Konten Hub
        if ($filterPostType !== 'all') {
            if ($filterPostType === 'video' || $filterPostType === Article::TYPE_VIDEO_GUIDE) {
                $query->where(function ($q) {
                    $q->where('post_type', Article::TYPE_VIDEO_GUIDE)
                      ->orWhereNotNull('youtube_video_id');
                });
            } elseif ($filterPostType === Article::TYPE_ARTICLE) {
                $query->where(function ($q) {
                    $q->whereNull('post_type')
                      ->orWhere('post_type', Article::TYPE_ARTICLE);
                })->whereNull('youtube_video_id');
            } elseif (in_array($filterPostType, array_keys(Article::POST_TYPES))) {
                $query->where('post_type', $filterPostType);
            }
        }

        // Filter Pencarian yang sudah di-escape
        if (!empty($escapedSearch)) {
            $query->where(function ($q) use ($escapedSearch) {
                $q->where('title', 'like', "%{$escapedSearch}%")
                  ->orWhere('excerpt', 'like', "%{$escapedSearch}%")
                  ->orWhere('tags', 'like', "%{$escapedSearch}%");
            });
        }

        // Filter Tag
        if (!empty($tag)) {
            $cleanTag = Str::substr(strip_tags(trim($tag)), 0, 50);
            $escapedTag = addcslashes($cleanTag, '%_\\');
            $query->where(function ($q) use ($escapedTag) {
                $q->where('tags', 'like', "%{$escapedTag}%")
                  ->orWhere('title', 'like', "%{$escapedTag}%")
                  ->orWhere('excerpt', 'like', "%{$escapedTag}%")
                  ->orWhere('category', 'like', "%{$escapedTag}%");
            });
        }

        // Kecualikan artikel hero jika pada tampilan default tanpa filter
        if ($filterCategory === 'all' && $filterPostType === 'all' && empty($search) && empty($tag)) {
            $query->whereNotIn('id', $heroExcludedIds);
        }

        // Paginasi terkontrol (12 per halaman, hemat memori)
        $articles = $query->orderBy('published_at', 'desc')->paginate(12);

        $featuredSpotlight = $headline;
        $filter = $filterPostType;
        $filterType = $filterPostType;

        // Penanganan SEO Meta & Kanonikal Dinamis
        $seoTitle = 'Portal Jurnal & Content Hub Plumbing Indonesia | Rootera';
        $seoDesc  = 'Pusat edukasi sanitasi, promo layanan pipa mampet, studi kasus penanganan industri B2B, kabar perusahaan, dan tutorial teknis resmi dari Rootera Plumbing.';
        $isIndexable = true;

        if ($filterCategory !== 'all' && isset($categories[$filterCategory])) {
            $seoTitle = "Panduan & Artikel {$categories[$filterCategory]} | Rootera Plumbing";
            $seoDesc  = "Kumpulan artikel & panduan teknis seputar {$categories[$filterCategory]} oleh tim ahli Rootera Plumbing Indonesia.";
        } elseif ($filterPostType === Article::TYPE_PROMO) {
            $seoTitle = 'Promo & Penawaran Spesial Jasa Plumbing | Rootera';
            $seoDesc  = 'Dapatkan promo diskon khusus pelancaran saluran pipa mampet, cuci toren, dan kuras grease trap dari teknisi resmi Rootera Plumbing.';
        } elseif ($filterPostType === Article::TYPE_CASE_STUDY) {
            $seoTitle = 'Studi Kasus & Portofolio Proyek B2B Plumbing | Rootera';
            $seoDesc  = 'Dokumentasi investigasi CCTV pipa, hydro jetting industri, dan solusi sanitasi pipa komersial & residensial oleh Rootera Plumbing.';
        } elseif ($filterPostType === Article::TYPE_NEWS) {
            $seoTitle = 'Kabar Terbaru & Informasi Perusahaan | Rootera News';
            $seoDesc  = 'Berita terkini, pembaruan operasional, dan pengumuman resmi perusahaan Rootera Plumbing Indonesia.';
        } elseif ($filterPostType === Article::TYPE_PRESS_RELEASE) {
            $seoTitle = 'Press Release & Rilis Media Resmi | Rootera Plumbing';
            $seoDesc  = 'Rilis pers resmi, kemitraan strategis, dan liputan media terkait inovasi sanitasi modern Rootera Plumbing.';
        } elseif ($filterPostType === Article::TYPE_ARTICLE) {
            $seoTitle = 'Artikel Edukasi Teknis & Sanitasi Pipa | Jurnal Rootera';
            $seoDesc  = 'Kumpulan artikel teknis edukatif tentang investigasi pipa, standar AMDAL, instalasi sanitasi, dan perpipaan modern.';
        } elseif ($filterPostType === 'video' || $filterPostType === Article::TYPE_VIDEO_GUIDE) {
            $seoTitle = 'Video Tutorial & Demo Lapangan Plumbing | Rootera TV';
            $seoDesc  = 'Tonton video tutorial pelancaran saluran pipa mampet, inspeksi CCTV pipa, dan demonstrasi peralatan teknis dari teknisi Rootera.';
        } elseif (!empty($search)) {
            $seoTitle = "Hasil Pencarian: " . e($search) . " | Rootera News";
            $seoDesc  = "Menampilkan artikel dan panduan terkait kata kunci " . e($search) . " di Rootera Plumbing.";
            // Halaman pencarian internal WAJIB noindex sesuai rekomendasi Google
            $isIndexable = false;
        }

        $page = (int) $request->query('page', 1);
        if ($page > 1) {
            $seoTitle .= " - Halaman {$page}";
        }

        // Pembangunan URL Kanonikal yang Valid & Terintegrasi Filter Tipe
        $canonicalParams = [];
        if ($filterCategory !== 'all' && isset($categories[$filterCategory])) {
            $canonicalParams['category'] = $filterCategory;
        }
        if ($filterPostType !== 'all') {
            $canonicalParams['type'] = $filterPostType;
        }
        if ($page > 1) {
            $canonicalParams['page'] = $page;
        }

        $canonicalUrl = route('blog', $canonicalParams);

        $seo = [
            'title'        => $seoTitle,
            'description'  => $seoDesc,
            'canonical'    => $canonicalUrl,
            'is_indexable' => $isIndexable,
            'og_image'     => $headline ? $headline->thumbnail_url : asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp'),
        ];

        return view('pages.blog', compact(
            'headline',
            'sideHeadlines',
            'videoArticles',
            'articles',
            'categories',
            'categoryCounts',
            'postTypeCounts',
            'featuredSpotlight',
            'filterCategory',
            'filterPostType',
            'filterType',
            'filter',
            'search',
            'tag',
            'seo'
        ));
    }

    public function show(Request $request, string $slug)
    {
        $article = Article::published()
            ->where('slug', $slug)
            ->firstOrFail();

        // 🛡️ Mitigasi View Counter: Cegah manipulasi refresh spam & bot crawling
        $this->trackLegitimateView($request, $article);

        $previousArticle = Article::published()
            ->select(Article::LIST_COLUMNS)
            ->where('id', '<', $article->id)
            ->orderBy('id', 'desc')
            ->first();

        $nextArticle = Article::published()
            ->select(Article::LIST_COLUMNS)
            ->where('id', '>', $article->id)
            ->orderBy('id', 'asc')
            ->first();

        // Trending & Related Articles (Cached IDs 30 Menit)
        $trendingIds = Cache::remember("article_trending_ids_{$article->id}", 1800, function () use ($article) {
            return Article::published()
                ->where('id', '!=', $article->id)
                ->orderBy('views', 'desc')
                ->orderBy('published_at', 'desc')
                ->take(5)
                ->pluck('id')
                ->toArray();
        });

        $trendingArticles = !empty($trendingIds)
            ? Article::select(Article::LIST_COLUMNS)->whereIn('id', $trendingIds)->get()
            : collect();

        $relatedIds = Cache::remember("article_related_ids_{$article->id}_{$article->category}", 1800, function () use ($article) {
            return Article::published()
                ->where('id', '!=', $article->id)
                ->where('category', $article->category)
                ->orderBy('published_at', 'desc')
                ->take(3)
                ->pluck('id')
                ->toArray();
        });

        $relatedArticles = !empty($relatedIds)
            ? Article::select(Article::LIST_COLUMNS)->whereIn('id', $relatedIds)->get()
            : collect();

        $citiesData = Cache::remember('active_cities_12_v2', 86400, function () {
            return \App\Models\City::where('is_active', true)
                ->select(['id', 'name', 'slug'])
                ->orderBy('sort_order')
                ->take(12)
                ->get()
                ->map(fn($c) => [
                    'id'   => $c->id,
                    'name' => $c->name,
                    'slug' => $c->slug,
                ])
                ->toArray();
        });
        $cities = collect($citiesData)->map(fn($item) => (object) $item);

        $allCategoriesData = Cache::remember('active_service_categories_v2', 86400, function () {
            return \App\Models\ServiceCategory::where('is_active', true)
                ->select(['id', 'name', 'slug'])
                ->orderBy('sort_order')
                ->get()
                ->map(fn($cat) => [
                    'id'   => $cat->id,
                    'name' => $cat->name,
                    'slug' => $cat->slug,
                ])
                ->toArray();
        });
        $allCategories = collect($allCategoriesData)->map(fn($item) => (object) $item);

        $projectShowcasesData = Cache::remember('active_project_showcases_3_v2', 86400, function () {
            return \App\Models\ProjectGallery::where('is_active', true)
                ->with(['district:id,name', 'city:id,name'])
                ->take(3)
                ->get()
                ->map(fn($p) => [
                    'id'       => $p->id,
                    'title'    => $p->title,
                    'image'    => $p->image,
                    'district' => $p->district ? (object)['name' => $p->district->name] : null,
                    'city'     => $p->city ? (object)['name' => $p->city->name] : null,
                ])
                ->toArray();
        });
        $projectShowcases = collect($projectShowcasesData)->map(fn($item) => (object) $item);

        $rawTitle = $article->meta_title ?: ($article->clean_title ?? $article->title);
        $seoTitle = (mb_strlen($rawTitle) > 65) ? mb_strimwidth($rawTitle, 0, 63, '..') : $rawTitle;

        $seo = [
            'title'          => $seoTitle,
            'description'    => $article->meta_description ?? $article->excerpt,
            'canonical'      => $article->canonical_url ?? url('/blog/' . $article->slug),
            'og_image'       => $article->thumbnail_url,
            'og_type'        => 'article',
            'is_indexable'   => true,
            'published_time' => $article->published_at?->toIso8601String(),
            'modified_time'  => $article->updated_at?->toIso8601String(),
            'section'        => $article->category ?? 'Tips Rumah',
        ];

        return view('pages.blog-detail', compact(
            'article',
            'previousArticle',
            'nextArticle',
            'trendingArticles',
            'relatedArticles',
            'cities',
            'allCategories',
            'projectShowcases',
            'seo'
        ));
    }

    /**
     * Hitung tayangan hanya jika bukan bot dan belum dikunjungi dalam 2 jam terakhir.
     */
    protected function trackLegitimateView(Request $request, Article $article): void
    {
        $userAgent = strtolower((string) $request->userAgent());

        // Lewati jika bot mesin pencari
        if (preg_match('/(googlebot|bingbot|yandex|slurp|baiduspider|duckduckbot|facebookexternalhit|whatsapp|ahrefs|semrush|mj12bot|crawler|spider|bot)/i', $userAgent)) {
            return;
        }

        $sessionKey = 'viewed_article_' . $article->id;
        $ipCacheKey = 'art_view_' . $article->id . '_' . md5((string) $request->ip());

        if (!$request->session()->has($sessionKey) && !Cache::has($ipCacheKey)) {
            $article->incrementViews();
            $request->session()->put($sessionKey, true);
            Cache::put($ipCacheKey, true, now()->addHours(2));
        }
    }

    /**
     * Dynamic SEO Image Sitemap untuk Content Hub (/sitemap-blog.xml)
     */
    public function sitemap(): \Illuminate\Http\Response
    {
        $articles = Article::published()
            ->orderBy('updated_at', 'desc')
            ->get();

        return response()
            ->view('sitemap.blog', ['articles' => $articles])
            ->header('Content-Type', 'text/xml');
    }
}

