<?php

namespace App\Providers;

use App\Http\Repositories\Eloquent\BaseRepository;
use App\Http\Repositories\Eloquent\ServiceRepository;
use App\Http\Repositories\Interfaces\ModelRepositoryInterface;
use App\Http\Repositories\Interfaces\ServiceRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            ModelRepositoryInterface::class,
            BaseRepository::class,
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
