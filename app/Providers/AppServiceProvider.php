<?php

namespace App\Providers;


use App\Repository\category\CategoryRepository;
use App\Repository\category\CategoryRepositoryInterface;
use App\Repository\product\ProductRepository;
use App\Repository\product\ProductRepositoryInterface;
use App\Repository\User\UserRepository;
use App\Repository\User\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->bind(CategoryRepositoryInterface::class,CategoryRepository::class);
        $this->app->bind(ProductRepositoryInterface::class ,ProductRepository::class);
        $this->app->bind(UserRepositoryInterface::class ,UserRepository::class);
    }


    public function boot(): void
    {
        //
    }
}
