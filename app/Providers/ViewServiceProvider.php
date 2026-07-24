<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Services\SeoService;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Bind SEO data globally to frontend templates
        View::composer(['layouts.app', 'layouts.admin'], function ($view) {
            $seoModel = null;
            try {
                $seoModel = app(SeoService::class)->getMetadataForCurrentRoute();
            } catch (\Throwable $e) {
                // Prevent boot failures during console commands or migrations
            }

            $seo = [
                'title'        => $seoModel['meta_title'] ?? 'Rooterin – Jasa Pipa & Saluran Mampet Profesional',
                'description'  => $seoModel['meta_description'] ?? 'Rooterin solusi terpercaya pipa dan wastafel mampet. Profesional, cepat, bergaransi.',
                'canonical'    => $seoModel['canonical_url'] ?? url()->current(),
                'og_image'     => $seoModel && !empty($seoModel['og_image']) 
                                    ? asset('storage/' . $seoModel['og_image']) 
                                    : asset('images/og-default.jpg'),
                'is_indexable' => $seoModel['is_indexable'] ?? true,
            ];

            $view->with('seo', $seo);
        });
    }
}
