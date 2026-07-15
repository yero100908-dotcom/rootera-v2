<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Article;
use App\Models\ServiceArea;
use App\Models\ServiceCategory;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Stats
        $totalContacts   = Contact::count();
        $newContacts     = Contact::where('status', 'new')->count();
        $completedOrders = Contact::where('status', 'completed')->count();
        $totalRevenue    = Contact::where('status', 'completed')->sum('invoice_amount');
        
        $totalArticles   = Article::count();
        $totalCategories = ServiceCategory::count();
        $totalAreas      = ServiceArea::count();
        $totalGalleries  = \App\Models\GalleryPhoto::count();
        $totalFaqs       = \App\Models\Faq::count();
        $totalTechs      = \App\Models\Technology::count();
        $totalSectors    = \App\Models\ServiceSector::count();
        $totalPartners   = \App\Models\Partner::count();

        // Chart: Monthly contacts (last 12 months)
        $monthlyContacts = Contact::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as total')
            ->where('created_at', '>=', now()->subMonths(12))
            ->groupByRaw('YEAR(created_at), MONTH(created_at)')
            ->orderByRaw('YEAR(created_at), MONTH(created_at)')
            ->get();

        // Chart: Monthly revenue (last 12 months)
        $monthlyRevenue = Contact::selectRaw('YEAR(completed_at) as year, MONTH(completed_at) as month, SUM(invoice_amount) as total')
            ->where('status', 'completed')
            ->where('completed_at', '>=', now()->subMonths(12))
            ->groupByRaw('YEAR(completed_at), MONTH(completed_at)')
            ->orderByRaw('YEAR(completed_at), MONTH(completed_at)')
            ->get();

        // Build chart labels (last 12 months)
        $chartLabels  = [];
        $contactData  = [];
        $revenueData  = [];

        for ($i = 11; $i >= 0; $i--) {
            $date  = now()->subMonths($i);
            $label = $date->format('M Y');
            $chartLabels[] = $label;

            $contactVal = $monthlyContacts->first(fn($r) =>
                $r->year == $date->year && $r->month == $date->month
            );
            $contactData[] = $contactVal ? $contactVal->total : 0;

            $revenueVal = $monthlyRevenue->first(fn($r) =>
                $r->year == $date->year && $r->month == $date->month
            );
            $revenueData[] = $revenueVal ? (float) $revenueVal->total : 0;
        }

        // Recent contacts
        $recentContacts = Contact::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalContacts', 'newContacts', 'completedOrders', 'totalRevenue',
            'totalArticles', 'totalCategories', 'totalAreas', 'totalGalleries',
            'totalFaqs', 'totalTechs', 'totalSectors', 'totalPartners',
            'chartLabels', 'contactData', 'revenueData', 'recentContacts'
        ));
    }
}
