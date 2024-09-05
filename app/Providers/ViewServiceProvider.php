<?php

namespace App\Providers;

use App\Http\View\Composers\DanhmucComposers;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;
use App\View\Composers\ProfileComposer;
use Illuminate\Support\Facades;
class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // ...
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Facades\View::composer('Users.layouts.header', DanhmucComposers::class);
    }
}