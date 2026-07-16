<?php

namespace App\Repositories\Contracts;

interface SeoRepositoryInterface
{
    /**
     * Find SEO metadata by route name.
     *
     * @param string $routeName
     * @return \App\Models\SeoPage|null
     */
    public function findByRoute(string $routeName);

    /**
     * Update or create an SEO page record.
     *
     * @param array $attributes
     * @param array $values
     * @return \App\Models\SeoPage
     */
    public function updateOrCreate(array $attributes, array $values);

    /**
     * Get all SEO pages.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAll();

    /**
     * Find SEO page by ID.
     *
     * @param int $id
     * @return \App\Models\SeoPage|null
     */
    public function find(int $id);
}
