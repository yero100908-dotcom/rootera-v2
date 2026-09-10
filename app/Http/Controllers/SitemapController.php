<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ServiceCategory;
use App\Models\City;
use App\Models\Gallery;
use App\Models\FaqCategory;
use App\Models\Technology;
use App\Models\ServiceSector;
use App\Models\PropertyType;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class SitemapController extends Controller
{
    /**
     * Master Sitemap Index File (/sitemap.xml)
     */
    public function index(): Response
    {
        $content = Cache::remember('sitemap_index_xml_v4', 86400, function () {
            $latestArticle = Article::published()->latest('updated_at')->first();
            $lastmodBlog = $latestArticle ? ($latestArticle->updated_at ?? $latestArticle->published_at)->tz('UTC')->toAtomString() : now()->tz('UTC')->toAtomString();
            $lastmodNow = now()->tz('UTC')->toAtomString();

            return view('sitemap-index', compact('lastmodBlog', 'lastmodNow'))->render();
        });

        return response(trim($content), 200)->header('Content-Type', 'text/xml; charset=utf-8');
    }

    /**
     * Pages & Core Sub-Sitemap (/sitemap-pages.xml)
     */
    public function pages(): Response
    {
        $content = Cache::remember('sitemap_pages_xml_v4', 86400, function () {
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
        $content = Cache::remember('sitemap_services_xml_v4', 86400, function () {
            $categories = ServiceCategory::where('is_active', true)->get();
            $cities = City::where('is_active', true)->get();
            $sectors = ServiceSector::where('is_active', true)->get();

            return view('sitemap-services', compact('categories', 'cities', 'sectors'))->render();
        });

        return response(trim($content), 200)->header('Content-Type', 'text/xml; charset=utf-8');
    }

    /**
     * City Hubs & Property Types Sub-Sitemap (/sitemap-cities.xml)
     */
    public function cities(): Response
    {
        $content = Cache::remember('sitemap_cities_xml_v4', 86400, function () {
            $cities = City::where('is_active', true)->get();
            $propertyTypes = PropertyType::where('is_active', true)->get();
            return view('sitemap-cities', compact('cities', 'propertyTypes'))->render();
        });

        return response(trim($content), 200)->header('Content-Type', 'text/xml; charset=utf-8');
    }

    /**
     * Articles & Educational Blog Sub-Sitemap (/sitemap-blog.xml)
     */
    public function blog(): Response
    {
        $content = Cache::remember('sitemap_blog_xml_v4', 86400, function () {
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
        $content = Cache::remember('sitemap_gallery_xml_v4', 86400, function () {
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
        $content = Cache::remember('sitemap_videos_xml_v4', 86400, function () {
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
        $content = view('sitemap-xsl')->render();
        return response(trim($content), 200)->header('Content-Type', 'text/xsl; charset=utf-8');
    }
}
