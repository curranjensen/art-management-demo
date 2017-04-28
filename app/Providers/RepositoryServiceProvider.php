<?php

namespace App\Providers;

use App\Repositories\DetailRepository;
use App\Repositories\EloquentDetailRepository;
use App\Repositories\EloquentPieceRepository;
use App\Repositories\PieceRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(DetailRepository::class, EloquentDetailRepository::class);

        $this->app->bind(PieceRepository::class, EloquentPieceRepository::class);
    }
}
