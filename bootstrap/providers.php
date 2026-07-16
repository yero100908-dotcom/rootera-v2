<?php

use App\Providers\AppServiceProvider;

return [
    AppServiceProvider::class,
    Nwidart\Modules\LaravelModulesServiceProvider::class,
    App\Providers\RepositoryServiceProvider::class,
    App\Providers\ViewServiceProvider::class,
];
