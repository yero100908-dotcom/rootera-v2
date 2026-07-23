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
        return $this->serviceRepo->getAllActive();
    }

    /**
     * Get all active services with their child services eager loaded, cached.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getActiveServicesWithRelations()
    {
        return $this->serviceRepo->getAllActiveWithServices();
    }

    /**
     * Find a service category by its slug with caching enabled.
     *
     * @param string $slug
     * @return \App\Models\ServiceCategory
     */
    public function getServiceBySlug(string $slug)
    {
        return $this->serviceRepo->findBySlug($slug);
    }
}
