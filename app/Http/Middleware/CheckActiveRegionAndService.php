<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckActiveRegionAndService
{
    /**
     * Intercept incoming requests to enforce HTTP 410 Gone for:
     * 1. Permanently disabled "Cuci Toren" services.
     * 2. Non-target / inactive city & district location pages.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $uri = strtolower($request->getRequestUri());

        // 1. Check for Cuci Toren Service URLs -> HTTP 410 Gone
        if (str_contains($uri, 'cuci-toren') || str_contains($uri, 'cuci_toren')) {
            return response()->view('errors.410', [
                'title'   => 'Layanan Cuci Toren Telah Dinonaktifkan Permanen',
                'message' => 'Layanan Cuci Toren & Kuras Tandon Air telah dihentikan secara permanen dari operasional Rootera Plumbing. Silakan manfaatkan layanan utama pelancaran saluran pipa mampet kami.',
            ], 410);
        }

        // 2. Check City Slug parameter if present in route
        $citySlug = $request->route('citySlug') ?? $request->route('city');
        if ($citySlug) {
            $city = City::where('slug', $citySlug)->first();

            // If city exists but is soft-deactivated (is_active == false)
            if ($city && !$city->is_active) {
                return response()->view('errors.410', [
                    'title'   => 'Wilayah Operasional Tidak Aktif',
                    'message' => "Halaman wilayah {$city->full_name} telah dinonaktifkan secara permanen. Operasional Rootera Plumbing saat ini berfokus di Jabodetabek, Semarang, dan Bandar Lampung.",
                ], 410);
            }
        }

        // 3. Check Region / Province Slug parameter if present in route
        $regionSlug = $request->route('regionSlug') ?? $request->route('region');
        if ($regionSlug) {
            $province = Province::where('slug', $regionSlug)->first();

            if ($province && !$province->is_active) {
                return response()->view('errors.410', [
                    'title'   => 'Wilayah Provinsi Tidak Aktif',
                    'message' => "Halaman wilayah Provinsi {$province->name} telah dinonaktifkan secara permanen dari operasional Rootera Plumbing.",
                ], 410);
            }
        }

        return $next($request);
    }
}
