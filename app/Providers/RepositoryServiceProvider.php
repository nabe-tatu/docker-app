<?php

namespace App\Providers;

use App\Ddd\User\Domain\RepositoryInterface\GetRecommendUserRepositoryInterface;
use App\Ddd\User\Infrastructure\Repository\GetRecommendUserRepository;
use App\Repositories\UserRepository\UserRepository;
use App\Repositories\UserRepository\UserRepositoryInterface;
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
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->bind(
            GetRecommendUserRepositoryInterface::class,
            GetRecommendUserRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
