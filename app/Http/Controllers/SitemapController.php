<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ServiceCategory;
use App\Models\City;
use App\Models\Gallery;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class SitemapController extends Controller
{
    /**
     * Master Sitemap Index File (/sitemap.xml)
     */
    public function index(): Response
    {
        $content = Cache::remember('sitemap_index_xml', 86400, function () {
            return view('sitemap-index')->render();
        });

        return response(trim($content), 200)->header('Content-Type', 'text/xml; charset=utf-8');
    }

    /**
     * Main static pages sitemap (/sitemap-pages.xml)
     */
    public function pages(): Response
    {
        $content = Cache::remember('sitemap_pages_xml', 86400, function () {
            $faqCategories = \App\Models\FaqCategory::where('is_active', true)->get();
            $technologies = \App\Models\Technology::where('is_active', true)->get();
            return view('sitemap-main', compact('faqCategories', 'technologies'))->render();
        });

        return response(trim($content), 200)->header('Content-Type', 'text/xml; charset=utf-8');
    }

    /**
     * B2B Commercial Sectors sitemap (/sitemap-sectors.xml)
     */
    public function sectors(): Response
    {
        $content = Cache::remember('sitemap_sectors_xml', 86400, function () {
            $sectors = \App\Models\ServiceSector::where('is_active', true)->get();
            $cities = City::where('is_active', true)->get();
            return view('sitemap-sectors', compact('sectors', 'cities'))->render();
        });

        return response(trim($content), 200)->header('Content-Type', 'text/xml; charset=utf-8');
    }

    /**
     * City Hubs & Property Types sitemap (/sitemap-cities.xml)
     */
    public function cities(): Response
    {
        $content = Cache::remember('sitemap_cities_xml', 86400, function () {
            $cities = City::where('is_active', true)->get();
            $propertyTypes = \App\Models\PropertyType::where('is_active', true)->get();
            return view('sitemap-cities', compact('cities', 'propertyTypes'))->render();
        });

        return response(trim($content), 200)->header('Content-Type', 'text/xml; charset=utf-8');
    }

    /**
     * Programmatic Category x City x District sitemap (/sitemap-districts.xml - Pruned 410 Gone)
     */
    public function districts(): Response
    {
        return response(view('errors.410', [
            'title'   => 'Sitemap Tidak Tersedia (410 Gone)',
            'message' => 'Sitemap rincian kecamatan telah dipangkas (pruned) untuk konsolidasi SEO ke Halaman Hub Kota.',
        ]), 410)->header('Content-Type', 'text/html; charset=utf-8');
    }

    /**
     * Programmatic Local SEO Services & Cities sitemap (/sitemap-services.xml)
     */
    public function services(): Response
    {
        $content = Cache::remember('sitemap_services_xml', 86400, function () {
            $categories = ServiceCategory::where('is_active', true)->get();
            $cities = City::where('is_active', true)->get();
            $sectors = class_exists('\App\Models\ServiceSector') ? \App\Models\ServiceSector::where('is_active', true)->get() : collect();
            $propertyTypes = class_exists('\App\Models\PropertyType') ? \App\Models\PropertyType::where('is_active', true)->get() : collect();

            return view('sitemap-services', compact('categories', 'cities', 'sectors', 'propertyTypes'))->render();
        });

        return response(trim($content), 200)->header('Content-Type', 'text/xml; charset=utf-8');
    }

    /**
     * Articles & Educational Blog sitemap (/sitemap-blog.xml)
     */
    public function blog(): Response
    {
        $content = Cache::remember('sitemap_blog_xml', 86400, function () {
            $articles = Article::published()
                ->where('slug', 'not like', '%cuci-toren%')
                ->latest('published_at')
                ->get();
            $categories = Article::CATEGORIES;
            return view('sitemap-blog', compact('articles', 'categories'))->render();
        });

        return response(trim($content), 200)->header('Content-Type', 'text/xml; charset=utf-8');
    }

    /**
     * Project Gallery & Documentation Images sitemap (/sitemap-gallery.xml)
     */
    public function gallery(): Response
    {
        $content = Cache::remember('sitemap_gallery_xml', 86400, function () {
            $galleries = Gallery::where('is_active', true)->latest('created_at')->get();
            return view('sitemap-gallery', compact('galleries'))->render();
        });

        return response(trim($content), 200)->header('Content-Type', 'text/xml; charset=utf-8');
    }

    /**
     * Video Documentation sitemap (/sitemap-videos.xml)
     */
    public function videos(): Response
    {
        $content = Cache::remember('sitemap_videos_xml', 86400, function () {
            $videos = Gallery::where('is_active', true)
                ->where('media_type', 'video')
                ->latest('created_at')
                ->get();
            return view('sitemap-videos', compact('videos'))->render();
        });

        return response(trim($content), 200)->header('Content-Type', 'text/xml; charset=utf-8');
    }

    /**
     * Cuci Toren City Hubs sitemap (/sitemap-cuci-toren-cities.xml - Permanently Removed 410)
     */
    public function cuciTorenCities(): Response
    {
        return response(view('errors.410', [
            'title'   => 'Sitemap Tidak Tersedia (410 Gone)',
            'message' => 'Sitemap Layanan Cuci Toren telah dinonaktifkan secara permanen.',
        ]), 410)->header('Content-Type', 'text/html; charset=utf-8');
    }

    /**
     * Cuci Toren District Spokes sitemap (/sitemap-cuci-toren-districts.xml - Permanently Removed 410)
     */
    public function cuciTorenDistricts(): Response
    {
        return response(view('errors.410', [
            'title'   => 'Sitemap Tidak Tersedia (410 Gone)',
            'message' => 'Sitemap Layanan Cuci Toren telah dinonaktifkan secara permanen.',
        ]), 410)->header('Content-Type', 'text/html; charset=utf-8');
    }
}
