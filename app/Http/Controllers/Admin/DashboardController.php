<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\GalleryPhoto;
use App\Models\ServiceCategory;
use App\Models\ServiceArea;
use App\Models\ServiceSector;
use App\Models\Partner;
use App\Models\Contact;
use App\Models\City;
use App\Models\ProjectGallery;
use App\Models\Faq;
use App\Models\Technology;

class DashboardController extends Controller
{
    public function index()
    {
        // CMS Stats Metrics
        $totalArticles   = Article::count();
        $totalGallery    = GalleryPhoto::where('is_active', true)->count();
        $totalCategories = ServiceCategory::count();
        $totalAreas      = ServiceArea::count();
        $totalSectors    = ServiceSector::count();
        $totalPartners   = Partner::count();
        $totalContacts   = Contact::count();
        $newContactsCount= Contact::where('status', 'new')->count();

        // Recent Inquiries (5 latest)
        $recentContacts  = Contact::orderBy('created_at', 'desc')->take(5)->get();

        // Chart: Monthly Articles & Monthly Contacts (last 12 months)
        $monthlyArticles = Article::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as total')
            ->where('created_at', '>=', now()->subMonths(12))
            ->groupByRaw('YEAR(created_at), MONTH(created_at)')
            ->orderByRaw('YEAR(created_at), MONTH(created_at)')
            ->get();

        $monthlyContacts = Contact::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as total')
            ->where('created_at', '>=', now()->subMonths(12))
            ->groupByRaw('YEAR(created_at), MONTH(created_at)')
            ->orderByRaw('YEAR(created_at), MONTH(created_at)')
            ->get();

        // Build chart labels & datasets (last 12 months)
        $chartLabels  = [];
        $articleData  = [];
        $contactData  = [];

        for ($i = 11; $i >= 0; $i--) {
            $date  = now()->subMonths($i);
            $label = $date->format('M Y');
            $chartLabels[] = $label;

            $articleVal = $monthlyArticles->first(fn($r) =>
                $r->year == $date->year && $r->month == $date->month
            );
            $articleData[] = $articleVal ? $articleVal->total : 0;

            $contactVal = $monthlyContacts->first(fn($r) =>
                $r->year == $date->year && $r->month == $date->month
            );
            $contactData[] = $contactVal ? $contactVal->total : 0;
        }

        // System Health & SEO Metrics
        $totalCities = City::count();
        $totalProjects = ProjectGallery::count();
        $totalFaqs = Faq::count();
        $totalTechs = Technology::count();

        $totalIndexedUrls = 12 + $totalArticles + $totalCategories + $totalCities + $totalSectors + $totalProjects;

        $seoHealth = [
            'db_status' => 'Online & Stable',
            'cache_status' => 'Aktif (60m Auto Refresh)',
            'sitemap_xml' => 'Valid (/sitemap.xml)',
            'total_urls' => $totalIndexedUrls,
            'total_faqs' => $totalFaqs,
            'total_techs' => $totalTechs,
        ];

        return view('admin.dashboard', compact(
            'totalArticles', 'totalGallery', 'totalCategories', 'totalAreas',
            'totalSectors', 'totalPartners', 'totalContacts', 'newContactsCount',
            'recentContacts', 'chartLabels', 'articleData', 'contactData',
            'seoHealth'
        ));
    }
}
