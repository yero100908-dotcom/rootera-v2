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
            $technologies = \App\Models\Technology::where('is_active', true)->get();
            return view('sitemap-main', compact('faqCategories', 'technologies'))->render();
        });

        return response($content, 200)->header('Content-Type', 'text/xml');
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

        return response($content, 200)->header('Content-Type', 'text/xml');
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

        return response($content, 200)->header('Content-Type', 'text/xml');
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

        return response($content, 200)->header('Content-Type', 'text/xml');
    }

    /**
     * Programmatic Local SEO Services & Cities/Districts sitemap (/sitemap-services.xml - legacy fallback)
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

    /**
     * Documentation Videos sitemap (/sitemap-videos.xml)
     */
    public function videos(): Response
    {
        $content = Cache::remember('sitemap_videos_xml', 3600, function () {
            $videos = [
                [
                    'title' => 'Video Inspeksi Kamera CCTV Pipa Gedung Kantor Jakarta',
                    'description' => 'Dokumentasi inspeksi visual kamera CCTV pipa saluran tersumbat gedung bertingkat oleh teknisi Rootera Plumbing Jakarta.',
                    'thumbnail' => asset('images/dokumentasi/thumb-video-inspeksi-cctv-gedung-kantor-jakarta.webp'),
                    'content' => asset('videos/dokumentasi/video-inspeksi-cctv-gedung-kantor-jakarta.mp4'),
                    'page_url' => url('/galeri'),
                    'pub_date' => '2026-08-25T08:00:00+07:00'
                ],
                [
                    'title' => 'Video Inspeksi CCTV Saluran Wastafel Rumah',
                    'description' => 'Deteksi titik sumbatan lemak dan kerak menggunakan kamera CCTV endoskopi pipa wastafel cuci piring.',
                    'thumbnail' => asset('images/dokumentasi/thumb-video-inspeksi-cctv-wastafel.webp'),
                    'content' => asset('videos/dokumentasi/video-inspeksi-cctv-wastafel.mp4'),
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

        return response($content, 200)->header('Content-Type', 'text/xml');
    }
}
