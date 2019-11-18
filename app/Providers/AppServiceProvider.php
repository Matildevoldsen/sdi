<?php

namespace App\Providers;

use App\TopCategory;
use Illuminate\Support\ServiceProvider;
use App\Category;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $categories = Category::all();
        View::share('categories', $categories);

        $topCategories = TopCategory::all();
        View::share('topCategories', $topCategories);

        ini_set("memory_limit", "100M");
    }
}
