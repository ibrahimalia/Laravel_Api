<?php

namespace App\Providers;

use App\Repositories\Contracts\IDesign;
use App\Repositories\Eloquent\DesignRepositories;
use Illuminate\Support\ServiceProvider;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->app->bind(IDesign::class , DesignRepositories::class);
    }
}
