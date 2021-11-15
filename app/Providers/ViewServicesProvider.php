<?php

namespace App\Providers;
use App\Models\cat;
use App\Models\Setting;
use Illuminate\Support\ServiceProvider;

class ViewServicesProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        View()->composer('Front.inc.Header',function ($view){
            $view->with('categories',cat::select('id','name')->get());
        });
        View()->composer('Front.inc.Header',function ($view){
            $view->with('setting',Setting::select('logo','favicon')->first());
        });
        View()->composer('Front.inc.Footer',function ($view){
            $view->with('setting',Setting::first());
        });
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
