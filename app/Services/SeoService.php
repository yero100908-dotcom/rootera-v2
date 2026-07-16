<?php

namespace App\Services;

use App\Repositories\Contracts\SeoRepositoryInterface;
use Illuminate\Support\Facades\Cache;

class SeoService
{
    /**
     * @var SeoRepositoryInterface
     */
    protected $seoRepo;

    /**
     * SeoService constructor.
     *
     * @param SeoRepositoryInterface $seoRepo
     */
    public function __construct(SeoRepositoryInterface $seoRepo)
    {
        $this->seoRepo = $seoRepo;
    }

    /**
     * Get SEO metadata for the current active route name.
     *
     * @return \App\Models\SeoPage|null
     */
    public function getMetadataForCurrentRoute()
    {
        $route = request()->route();
        if (!$route) {
            return null;
        }

        $routeName = $route->getName();
        if (!$routeName) {
            return null;
        }

        return Cache::remember("seo_meta_{$routeName}", 3600, function () use ($routeName) {
            $page = $this->seoRepo->findByRoute($routeName);
            return $page ? $page->toArray() : null;
        });
    }

    /**
     * Get all pages for management dashboard.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllPages()
    {
        return $this->seoRepo->getAll();
    }

    /**
     * Update an SEO page.
     *
     * @param int $id
     * @param array $data
     * @return \App\Models\SeoPage
     */
    public function updatePage(int $id, array $data)
    {
        $page = $this->seoRepo->find($id);
        if (!$page) {
            throw new \Exception("Page not found");
        }

        $page->update($data);

        // Clear the specific route's cache
        Cache::forget("seo_meta_{$page->route_name}");

        return $page;
    }
}
