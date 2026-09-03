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
        // Bind SEO data globally to frontend templates, prioritizing controller-passed $seo array
        View::composer(['layouts.app', 'layouts.admin'], function ($view) {
            $data = $view->getData();
            $customSeo = $data['seo'] ?? [];

            $seoModel = null;
            try {
                $seoModel = app(SeoService::class)->getMetadataForCurrentRoute();
            } catch (\Throwable $e) {
                // Prevent boot failures during console commands or migrations
            }

            $seo = [
                'title'        => $customSeo['title'] ?? $seoModel['meta_title'] ?? 'Jasa Saluran Pipa Mampet 24 Jam | Rootera',
                'description'  => $customSeo['description'] ?? $seoModel['meta_description'] ?? 'Layanan jasa saluran pipa mampet & pelancaran drainase profesional tanpa bongkar oleh Rootera. Solusi wastafel, got, & WC tersumbat bergaransi. CS 24 Jam!',
                'canonical'    => $customSeo['canonical'] ?? $seoModel['canonical_url'] ?? url()->current(),
                'og_image'     => $customSeo['og_image'] ?? ($seoModel && !empty($seoModel['og_image']) 
                                    ? asset('storage/' . $seoModel['og_image']) 
                                    : asset('images/brand/logo-utama-rooteraplumbing-jasa-saluran-pipa-mampet.webp')),
                'is_indexable' => $customSeo['is_indexable'] ?? $seoModel['is_indexable'] ?? true,
            ];

            $view->with('seo', $seo);
        });
    }
}
