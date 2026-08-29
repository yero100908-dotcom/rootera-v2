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

        return response(trim($content), 200)->header('Content-Type', 'text/xml; charset=utf-8');
    }

    /**
     * Main static pages sitemap (/sitemap-main.xml)
     */
    public function main(): Response
    {
        $content = Cache::remember('sitemap_main_xml', 3600, function () {
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
        $content = Cache::remember('sitemap_sectors_xml', 3600, function () {
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
        $content = Cache::remember('sitemap_cities_xml', 3600, function () {
            $cities = City::where('is_active', true)->get();
            $propertyTypes = \App\Models\PropertyType::where('is_active', true)->get();
            return view('sitemap-cities', compact('cities', 'propertyTypes'))->render();
        });

        return response(trim($content), 200)->header('Content-Type', 'text/xml; charset=utf-8');
    }

    /**
     * Programmatic Category x City x District sitemap (/sitemap-districts.xml)
     */
    public function districts(): Response
    {
        $content = Cache::remember('sitemap_districts_xml', 3600, function () {
            $categories = ServiceCategory::where('is_active', true)->get();
            $cities = City::where('is_active', true)->with(['districts' => function ($q) {
                $q->where('is_active', true);
            }])->get();

            return view('sitemap-districts', compact('categories', 'cities'))->render();
        });

        return response(trim($content), 200)->header('Content-Type', 'text/xml; charset=utf-8');
    }

    /**
     * Programmatic Local SEO Services & Cities/Districts sitemap (/sitemap-services.xml - legacy fallback)
     */
    public function services(): Response
    {
        $content = Cache::remember('sitemap_services_xml', 3600, function () {
            $categories = ServiceCategory::where('is_active', true)->get();
            $cities = City::where('is_active', true)->get();
            $districts = District::where('is_active', true)->get();

            return view('sitemap-services', compact('categories', 'cities', 'districts'))->render();
        });

        return response(trim($content), 200)->header('Content-Type', 'text/xml; charset=utf-8');
    }

    /**
     * Articles & Educational Blog sitemap (/sitemap-blog.xml)
     */
    public function blog(): Response
    {
        $content = Cache::remember('sitemap_blog_xml', 3600, function () {
            $articles = Article::published()->latest('published_at')->get();
            return view('sitemap-blog', compact('articles'))->render();
        });

        return response(trim($content), 200)->header('Content-Type', 'text/xml; charset=utf-8');
    }

    /**
     * Video Documentation sitemap (/sitemap-videos.xml)
     */
    public function videos(): Response
    {
        $content = Cache::remember('sitemap_videos_xml', 3600, function () {
            $videos = [
                [
                    'title' => 'Video High-Pressure Hydro Jetting Restoran Marugame Udon',
                    'description' => 'Dokumentasi tim Rootera Plumbing melancarkan pipa saluran pembuangan lemak Restoran Marugame Udon.',
                    'thumbnail' => asset('images/dokumentasi/thumb-video-hydro-jetting-marugame-udon.webp'),
                    'content' => asset('videos/dokumentasi/video-hydro-jetting-marugame-udon.mp4'),
                    'page_url' => url('/galeri'),
                    'pub_date' => '2026-08-25T08:00:00+07:00'
                ],
                [
                    'title' => 'Video Pelancaran Gutter Lemak Restoran Sushi Tei',
                    'description' => 'Pembersihan kerak gumpalan lemak padat pada saluran gutter dapur restoran komersial Sushi Tei.',
                    'thumbnail' => asset('images/dokumentasi/thumb-video-pelancaran-gutter-lemak-sushi-tei.webp'),
                    'content' => asset('videos/dokumentasi/video-pelancaran-gutter-lemak-sushi-tei.mp4'),
                    'page_url' => url('/galeri'),
                    'pub_date' => '2026-08-25T08:00:00+07:00'
                ],
                [
                    'title' => 'Video Pelancaran Saluran Stasiun Tugu Yogyakarta',
                    'description' => 'Penanganan pipa tersumbat fasilitas publik Stasiun Tugu Yogyakarta oleh tim spesialis Rootera Plumbing.',
                    'thumbnail' => asset('images/dokumentasi/thumb-video-pelancaran-saluran-stasiun-tugu-yogyakarta.webp'),
                    'content' => asset('videos/dokumentasi/video-pelancaran-saluran-stasiun-tugu-yogyakarta.mp4'),
                    'page_url' => url('/galeri'),
                    'pub_date' => '2026-08-25T08:00:00+07:00'
                ],
                [
                    'title' => 'Video Ridgid Drain Cleaner Gutter Mie Kari',
                    'description' => 'Pembersihan saluran talang air mampet restoran Seporsi Mie Kari menggunakan mesin Ridgid Drain Cleaner.',
                    'thumbnail' => asset('images/dokumentasi/thumb-video-ridgid-drain-cleaner-gutter-mie-kari.webp'),
                    'content' => asset('videos/dokumentasi/video-ridgid-drain-cleaner-gutter-mie-kari.mp4'),
                    'page_url' => url('/galeri'),
                    'pub_date' => '2026-08-25T08:00:00+07:00'
                ],
                [
                    'title' => 'Video Ridgid Pelancaran Saluran Kloset Pabrik Jabar',
                    'description' => 'Pelancaran saluran toilet kloset meluap kawasan industri pabrik Jawa Barat tanpa membongkar pipa.',
                    'thumbnail' => asset('images/dokumentasi/thumb-video-ridgid-saluran-kloset-pabrik-jabar.webp'),
                    'content' => asset('videos/dokumentasi/video-ridgid-saluran-kloset-pabrik-jabar.mp4'),
                    'page_url' => url('/galeri'),
                    'pub_date' => '2026-08-25T08:00:00+07:00'
                ]
            ];
            return view('sitemap-videos', compact('videos'))->render();
        });

        return response(trim($content), 200)->header('Content-Type', 'text/xml; charset=utf-8');
    }

    /**
     * Cuci Toren City Hubs sitemap (/sitemap-cuci-toren-cities.xml)
     */
    public function cuciTorenCities(): Response
    {
        $content = Cache::remember('sitemap_cuci_toren_cities_xml', 3600, function () {
            $cities = City::where('is_active', true)->get();
            return view('sitemap-cuci-toren-cities', compact('cities'))->render();
        });

        return response(trim($content), 200)->header('Content-Type', 'text/xml; charset=utf-8');
    }

    /**
     * Cuci Toren District Spokes sitemap (/sitemap-cuci-toren-districts.xml)
     */
    public function cuciTorenDistricts(): Response
    {
        $content = Cache::remember('sitemap_cuci_toren_districts_xml', 3600, function () {
            $cities = City::where('is_active', true)->with(['districts' => function ($q) {
                $q->where('is_active', true);
            }])->get();

            return view('sitemap-cuci-toren-districts', compact('cities'))->render();
        });

        return response(trim($content), 200)->header('Content-Type', 'text/xml; charset=utf-8');
    }
}
