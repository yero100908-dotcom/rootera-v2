<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ServiceCategory;
use App\Models\City;
use App\Models\District;
use App\Models\ServiceArea;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class SitemapController extends Controller
{
    /**
     * Master Sitemap Index File (/sitemap.xml)
     */
    public function index(): Response
    {
        $content = Cache::remember('sitemap_index_xml', 3600, function () {
            return view('sitemap-index')->render();
        });

        return response($content, 200)->header('Content-Type', 'text/xml');
    }

    /**
     * Main static pages sitemap (/sitemap-main.xml)
     */
    public function main(): Response
    {
        $content = Cache::remember('sitemap_main_xml', 3600, function () {
            $faqCategories = \App\Models\FaqCategory::where('is_active', true)->get();
            return view('sitemap-main', compact('faqCategories'))->render();
        });

        return response($content, 200)->header('Content-Type', 'text/xml');
    }

    /**
     * Programmatic Local SEO Services & Cities/Districts sitemap (/sitemap-services.xml)
     */
    public function services(): Response
    {
        $content = Cache::remember('sitemap_services_xml', 3600, function () {
            $categories = ServiceCategory::where('is_active', true)->get();
            $propertyTypes = \App\Models\PropertyType::where('is_active', true)->get();
            $sectors = \App\Models\ServiceSector::where('is_active', true)->get();
            $cities = City::where('is_active', true)->with(['districts' => function ($q) {
                $q->where('is_active', true);
            }])->get();

            return view('sitemap-services', compact('categories', 'propertyTypes', 'sectors', 'cities'))->render();
        });

        return response($content, 200)->header('Content-Type', 'text/xml');
    }

    /**
     * Blog articles & guides sitemap (/sitemap-blog.xml)
     */
    public function blog(): Response
    {
        $content = Cache::remember('sitemap_blog_xml', 3600, function () {
            $articles = Article::published()->latest('updated_at')->get();
            return view('sitemap-blog', compact('articles'))->render();
        });

        return response($content, 200)->header('Content-Type', 'text/xml');
    }
}
