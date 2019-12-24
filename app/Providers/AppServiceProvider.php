<?php

namespace App\Providers;

use App\Post;
use App\TopCategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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
        if (!Auth::guest() && Auth::user()->is_admin == 1) {
            $categories = Category::all();
            View::share('categories', $categories);

            $topCategories = TopCategory::all();
            View::share('topCategories', $topCategories);
        } else {
            $categories = Category::all()->where('is_private', '=', '0');
            View::share('categories', $categories);

            $topCategories = TopCategory::all()->where('is_private', '=', '0');
            View::share('topCategories', $topCategories);
        }

        Carbon::setLocale('dk');

        ini_set("memory_limit", "100M");
    }
}
