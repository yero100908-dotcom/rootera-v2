<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ResidentialCluster;
use App\Models\ServiceCategory;
use App\Models\City;
use App\Models\Gallery;
use App\Models\FaqCategory;
use App\Models\Technology;
use App\Models\ServiceSector;
use App\Models\PropertyType;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\URL;

class SitemapController extends Controller
{
    /**
     * Cache keys for all sitemap endpoints.
     */
    public const CACHE_KEYS = [
        'sitemap_index'    => 'sitemap_index_xml_v5',
        'sitemap_pages'    => 'sitemap_pages_xml_v5',
        'sitemap_services' => 'sitemap_services_xml_v5',
        'sitemap_cities'   => 'sitemap_cities_xml_v5',
        'sitemap_districts' => 'sitemap_districts_xml_v5',
        'sitemap_blog'     => 'sitemap_blog_xml_v5',
        'sitemap_gallery'  => 'sitemap_gallery_xml_v5',
        'sitemap_videos'   => 'sitemap_videos_xml_v5',
        'sitemap_clusters' => 'sitemap_clusters_xml_v1',
    ];

    /**
     * List of city slugs that are alias 301 redirects and must be excluded from sitemaps.
     */
    protected array $aliasSlugs = [
        'tangerang-kota',
        'kab-tangerang',
        'cikarang',
        'karawang',
        'sleman',
        'sidoarjo',
        'gresik',
        'solo'
    ];

    public function __construct()
    {
        $this->prepareCanonicalUrls();
    }

    /**
     * Ensure URL generator always produces canonical HTTPS URLs for sitemaps
     * regardless of whether it is invoked via CLI artisan command or HTTP request.
     */
    protected function prepareCanonicalUrls(): void
    {
        $domain = env('SITEMAP_CANONICAL_HOST', 'https://rooteraplumbing.id');
        URL::forceRootUrl($domain);
        URL::forceScheme('https');
    }

    /**
     * Flush all sitemap caches (both current v5 and legacy keys).
     */
    public static function clearCache(): void
    {
        $legacyKeys = [
            'sitemap_index_xml_v4',
            'sitemap_pages_xml_v4',
            'sitemap_services_xml_v4',
            'sitemap_cities_xml_v4',
            'sitemap_districts_xml_v4',
            'sitemap_blog_xml_v4',
            'sitemap_gallery_xml_v4',
            'sitemap_videos_xml_v4',
        ];

        foreach (array_merge($legacyKeys, array_values(self::CACHE_KEYS)) as $key) {
            Cache::forget($key);
        }
    }

    /**
     * Master Sitemap Index File (/sitemap.xml & /sitemap-index.xml)
     */
    public function index(): Response
    {
        $this->prepareCanonicalUrls();
        $content = Cache::remember(self::CACHE_KEYS['sitemap_index'], 86400, function () {
            $latestArticle  = Article::published()->latest('updated_at')->first();
            $latestCluster  = ResidentialCluster::indexable()->latest('updated_at')->first();
            $latestCity     = City::where('is_active', true)->latest('updated_at')->first();

            $lastmodNow = now()->tz('UTC')->toAtomString();
            $lastmodBlog = $latestArticle
                ? ($latestArticle->updated_at ?? $latestArticle->published_at)->tz('UTC')->toAtomString()
                : $lastmodNow;
            $lastmodClusters = $latestCluster
                ? ($latestCluster->updated_at ?? now())->tz('UTC')->toAtomString()
                : $lastmodNow;
            $lastmodCities = $latestCity
                ? ($latestCity->updated_at ?? now())->tz('UTC')->toAtomString()
                : $lastmodNow;

            return view('sitemap-index', compact(
                'lastmodBlog', 'lastmodNow', 'lastmodClusters', 'lastmodCities'
            ))->render();
        });

        return response(trim($content), 200)->header('Content-Type', 'text/xml; charset=utf-8');
    }

    /**
     * Pages & Core Sub-Sitemap (/sitemap-pages.xml)
     */
    public function pages(): Response
    {
        $this->prepareCanonicalUrls();
        $content = Cache::remember(self::CACHE_KEYS['sitemap_pages'], 86400, function () {
            $faqCategories = FaqCategory::where('is_active', true)->get();
            $technologies = Technology::where('is_active', true)->get();
            return view('sitemap-pages', compact('faqCategories', 'technologies'))->render();
        });

        return response(trim($content), 200)->header('Content-Type', 'text/xml; charset=utf-8');
    }

    /**
     * B2B Commercial Sectors & Services Sub-Sitemap (/sitemap-services.xml)
     */
    public function services(): Response
    {
        $this->prepareCanonicalUrls();
        $content = Cache::remember(self::CACHE_KEYS['sitemap_services'], 86400, function () {
            $categories = ServiceCategory::where('is_active', true)->get();
            $cities = City::where('is_active', true)->whereNotIn('slug', $this->aliasSlugs)->get();
            $sectors = ServiceSector::where('is_active', true)->get();
            $aliases = \App\Models\ServiceAlias::active()->landingPage()->with('serviceCategory')->get();

            return view('sitemap-services', compact('categories', 'cities', 'sectors', 'aliases'))->render();
        });

        return response(trim($content), 200)->header('Content-Type', 'text/xml; charset=utf-8');
    }

    /**
     * City Hubs & Property Types Sub-Sitemap (/sitemap-cities.xml)
     */
    public function cities(): Response
    {
        $this->prepareCanonicalUrls();
        $content = Cache::remember(self::CACHE_KEYS['sitemap_cities'], 86400, function () {
            $cities = City::where('is_active', true)->whereNotIn('slug', $this->aliasSlugs)->orderBy('sort_order')->orderBy('name')->get();
            $propertyTypes = PropertyType::where('is_active', true)->get();
            return view('sitemap-cities', compact('cities', 'propertyTypes'))->render();
        });

        return response(trim($content), 200)->header('Content-Type', 'text/xml; charset=utf-8');
    }

    /**
     * District Spoke Landing Pages Sub-Sitemap (/sitemap-districts.xml)
     */
    public function districts(): Response
    {
        $this->prepareCanonicalUrls();
        $content = Cache::remember(self::CACHE_KEYS['sitemap_districts'], 86400, function () {
            $cities = City::where('is_active', true)
                ->whereNotIn('slug', $this->aliasSlugs)
                ->with(['districts' => function ($q) {
                    $q->where('is_active', true)->orderBy('name');
                }])
                ->get();
            $categories = ServiceCategory::where('is_active', true)->get();

            return view('sitemap-districts', compact('cities', 'categories'))->render();
        });

        return response(trim($content), 200)->header('Content-Type', 'text/xml; charset=utf-8');
    }

    /**
     * Articles & Educational Blog Sub-Sitemap (/sitemap-blog.xml)
     */
    public function blog(): Response
    {
        $this->prepareCanonicalUrls();
        $content = Cache::remember(self::CACHE_KEYS['sitemap_blog'], 86400, function () {
            $articles = Article::published()->latest('published_at')->get();
            $categories = Article::CATEGORIES;
            $galleries = Gallery::where('is_active', true)->latest('created_at')->get();

            return view('sitemap-blog', compact('articles', 'categories', 'galleries'))->render();
        });

        return response(trim($content), 200)->header('Content-Type', 'text/xml; charset=utf-8');
    }

    /**
     * Project Gallery Sub-Sitemap (/sitemap-gallery.xml)
     */
    public function gallery(): Response
    {
        $this->prepareCanonicalUrls();
        $content = Cache::remember(self::CACHE_KEYS['sitemap_gallery'], 86400, function () {
            $galleries = Gallery::where('is_active', true)->latest('created_at')->get();
            return view('sitemap-gallery', compact('galleries'))->render();
        });

        return response(trim($content), 200)->header('Content-Type', 'text/xml; charset=utf-8');
    }

    /**
     * Video Documentation Sub-Sitemap (/sitemap-videos.xml)
     */
    public function videos(): Response
    {
        $this->prepareCanonicalUrls();
        $content = Cache::remember(self::CACHE_KEYS['sitemap_videos'], 86400, function () {
            $videos = Gallery::where('is_active', true)
                ->where('media_type', 'video')
                ->latest('created_at')
                ->get();
            return view('sitemap-videos', compact('videos'))->render();
        });

        return response(trim($content), 200)->header('Content-Type', 'text/xml; charset=utf-8');
    }

    /**
     * XSLT Visual Stylesheet (/sitemap.xsl)
     */
    public function xsl(): Response
    {
        $this->prepareCanonicalUrls();
        $content = view('sitemap-xsl')->render();
        return response(trim($content), 200)->header('Content-Type', 'text/xsl; charset=utf-8');
    }

    /**
     * Residential Clusters Sub-Sitemap (/sitemap-clusters.xml)
     *
     * Includes cluster landing pages and cluster × service-category intersections
     * for all indexable (content_score ≥ 70) clusters.
     */
    public function clusters(): Response
    {
        $this->prepareCanonicalUrls();
        $content = Cache::remember(self::CACHE_KEYS['sitemap_clusters'], 86400, function () {
            $clusters   = ResidentialCluster::indexable()->orderBy('sort_order')->get();
            $categories = ServiceCategory::where('is_active', true)->orderBy('sort_order')->get();

            return view('sitemap-clusters', compact('clusters', 'categories'))->render();
        });

        return response(trim($content), 200)->header('Content-Type', 'text/xml; charset=utf-8');
    }

    /**
     * Serve an artisan-generated static sitemap XML file from public/.
     * Works for: /sitemap-static.xml, /sitemap-pseo.xml, /sitemap-articles.xml
     * Falls back to a 503 with an XML error body if the file hasn't been generated yet.
     */
    public function serveStaticFile(\Illuminate\Http\Request $request): Response
    {
        // Derive filename from request path: /sitemap-static.xml -> sitemap-static.xml
        $filename = ltrim($request->path(), '/');
        $filepath = public_path($filename);

        if (!file_exists($filepath) || filesize($filepath) === 0) {
            \Illuminate\Support\Facades\Artisan::call('sitemap:generate');
        }

        if (!file_exists($filepath) || filesize($filepath) === 0) {
            $xml = '<?xml version="1.0" encoding="UTF-8"?>'
                 . '<error>Sitemap not yet generated. Run: php artisan sitemap:generate</error>';
            return response($xml, 503)->header('Content-Type', 'text/xml; charset=utf-8');
        }

        $content = file_get_contents($filepath);
        return response($content, 200)->header('Content-Type', 'text/xml; charset=utf-8');
    }
}
