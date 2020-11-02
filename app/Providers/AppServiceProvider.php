<?php

namespace App\Providers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Category;

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
        if (Schema::hasTable('categories')) {
            $categories = Cache::get(
                'categories',
                function () {
                    return Category::all();
                }
            );
            View::share(compact('categories'));
        }
        if (Schema::hasTable('order_delivery_methods')) {
            $delivery_methods = Cache::get(
                'delivery_method',
                function () {
                    return DB::table('order_delivery_methods')->get();
                }
            );
            View::share(compact('delivery_methods'));
        }
    }
}
