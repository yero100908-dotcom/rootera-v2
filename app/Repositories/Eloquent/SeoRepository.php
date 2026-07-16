<?php

namespace App\Repositories\Eloquent;

use App\Models\SeoPage;
use App\Repositories\Contracts\SeoRepositoryInterface;

class SeoRepository implements SeoRepositoryInterface
{
    /**
     * @var SeoPage
     */
    protected $model;

    /**
     * SeoRepository constructor.
     *
     * @param SeoPage $model
     */
    public function __construct(SeoPage $model)
    {
        $this->model = $model;
    }

    /**
     * {@inheritdoc}
     */
    public function findByRoute(string $routeName)
    {
        return $this->model
            ->where('route_name', $routeName)
            ->first();
    }

    /**
     * {@inheritdoc}
     */
    public function updateOrCreate(array $attributes, array $values)
    {
        return $this->model->updateOrCreate($attributes, $values);
    }

    /**
     * {@inheritdoc}
     */
    public function getAll()
    {
        return $this->model->orderBy('page_name', 'asc')->get();
    }

    /**
     * {@inheritdoc}
     */
    public function find(int $id)
    {
        return $this->model->find($id);
    }
}
