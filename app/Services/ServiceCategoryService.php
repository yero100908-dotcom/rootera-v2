<?php

namespace App\Services;

use App\Repositories\Contracts\ServiceRepositoryInterface;
use Illuminate\Support\Facades\Cache;

class ServiceCategoryService
{
    /**
     * @var ServiceRepositoryInterface
     */
    protected $serviceRepo;

    /**
     * ServiceCategoryService constructor.
     *
     * @param ServiceRepositoryInterface $serviceRepo
     */
    public function __construct(ServiceRepositoryInterface $serviceRepo)
    {
        $this->serviceRepo = $serviceRepo;
    }

    /**
     * Get all active services with caching enabled.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getActiveServices()
    {
        // Cache active services for 60 minutes
        return Cache::remember('active_service_categories', 3600, function () {
            return $this->serviceRepo->getAllActive();
        });
    }

    /**
     * Get all active services with their child services eager loaded, cached.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getActiveServicesWithRelations()
    {
        // Cache active services with services relationship for 60 minutes
        return Cache::remember('active_service_categories_with_relations', 3600, function () {
            return $this->serviceRepo->getAllActiveWithServices();
        });
    }

    /**
     * Find a service category by its slug with caching enabled.
     *
     * @param string $slug
     * @return \App\Models\ServiceCategory
     */
    public function getServiceBySlug(string $slug)
    {
        // Cache individual service query dynamically by slug
        return Cache::remember("service_category_{$slug}", 3600, function () use ($slug) {
            return $this->serviceRepo->findBySlug($slug);
        });
    }
}
