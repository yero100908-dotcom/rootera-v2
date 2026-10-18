<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\Article;
use App\Models\District;
use App\Models\ProjectGallery;
use App\Models\ResidentialCluster;
use App\Models\ServiceCategory;
use App\Observers\ArticleObserver;
use App\Observers\DistrictObserver;
use App\Observers\ProjectGalleryObserver;
use App\Observers\ResidentialClusterObserver;
use App\Observers\ServiceCategoryObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Anti-doorway content score engine
        ResidentialCluster::observe(ResidentialClusterObserver::class);
        District::observe(DistrictObserver::class);
        ProjectGallery::observe(ProjectGalleryObserver::class);

        // Real-time SEO IndexNow pings
        Article::observe(ArticleObserver::class);
        ServiceCategory::observe(ServiceCategoryObserver::class);
    }
}
