<?php

namespace App\Repositories\Contracts;

interface ServiceRepositoryInterface
{
    /**
     * Get all active service categories.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllActive();

    /**
     * Get all active service categories with their services loaded.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllActiveWithServices();

    /**
     * Find a service category by its slug.
     *
     * @param string $slug
     * @return \App\Models\ServiceCategory
     */
    public function findBySlug(string $slug);
}
