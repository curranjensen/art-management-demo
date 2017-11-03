<?php

namespace App\Providers;

use App\Repositories\CatalogueRepository;
use App\Repositories\DetailRepository;
use App\Repositories\EloquentCatalogueRepository;
use App\Repositories\EloquentDetailRepository;
use App\Repositories\EloquentFeaturedRepository;
use App\Repositories\EloquentPieceRepository;
use App\Repositories\FeaturedRepository;
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

        $this->app->bind(CatalogueRepository::class, EloquentCatalogueRepository::class);

        $this->app->bind(FeaturedRepository::class, EloquentFeaturedRepository::class);
    }
}
