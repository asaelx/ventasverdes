<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('store.layout.top', function($view) {
            $categories = Category::pluck('title', 'id')->toArray();
            $categories = ['' => 'Todas las categorías'] + $categories;
            $view->with('search_categories', $categories);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
