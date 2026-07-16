<?php

namespace App\Repositories\Eloquent;

use App\Models\ServiceCategory;
use App\Repositories\Contracts\ServiceRepositoryInterface;

class ServiceRepository implements ServiceRepositoryInterface
{
    /**
     * @var ServiceCategory
     */
    protected $model;

    /**
     * ServiceRepository constructor.
     *
     * @param ServiceCategory $model
     */
    public function __construct(ServiceCategory $model)
    {
        $this->model = $model;
    }

    /**
     * {@inheritdoc}
     */
    public function getAllActive()
    {
        return $this->model
            ->where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get();
    }

    /**
     * {@inheritdoc}
     */
    public function getAllActiveWithServices()
    {
        return $this->model
            ->with('services')
            ->where('is_active', true)
            ->orderBy('sort_order', 'asc')
            ->get();
    }

    /**
     * {@inheritdoc}
     */
    public function findBySlug(string $slug)
    {
        return $this->model
            ->where('slug', $slug)
            ->firstOrFail();
    }
}
