<?php

namespace App\Providers;


use App\Repository\CategoryRepository;
use App\Repository\CategoryRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->bind(CategoryRepositoryInterface::class,CategoryRepository::class);
    }


    public function boot(): void
    {
        //
    }
}
