<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\GalleryPhoto;
use App\Models\ServiceCategory;
use App\Models\ServiceArea;
use App\Models\ServiceSector;
use App\Models\Partner;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // CMS Stats
        $totalArticles   = Article::count();
        $totalGallery    = GalleryPhoto::where('is_active', true)->count();
        $totalCategories = ServiceCategory::count();
        $totalAreas      = ServiceArea::count();
        $totalSectors    = ServiceSector::count();
        $totalPartners   = Partner::count();

        // Chart: Monthly Articles (last 12 months)
        $monthlyArticles = Article::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as total')
            ->where('created_at', '>=', now()->subMonths(12))
            ->groupByRaw('YEAR(created_at), MONTH(created_at)')
            ->orderByRaw('YEAR(created_at), MONTH(created_at)')
            ->get();

        // Build chart labels (last 12 months)
        $chartLabels  = [];
        $articleData  = [];

        for ($i = 11; $i >= 0; $i--) {
            $date  = now()->subMonths($i);
            $label = $date->format('M Y');
            $chartLabels[] = $label;

            $articleVal = $monthlyArticles->first(fn($r) =>
                $r->year == $date->year && $r->month == $date->month
            );
            $articleData[] = $articleVal ? $articleVal->total : 0;
        }

        return view('admin.dashboard', compact(
            'totalArticles', 'totalGallery', 'totalCategories', 'totalAreas',
            'totalSectors', 'totalPartners',
            'chartLabels', 'articleData'
        ));
    }
}

