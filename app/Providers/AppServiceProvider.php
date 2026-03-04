<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Faculty;
use Illuminate\Auth\Events\Login;
use App\Listeners\UpdateLoginInfo;
use Illuminate\Support\Facades\Event;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share active faculties with the navbar component automatically
        View::composer('components.navigation', function ($view) {
            $view->with('navFaculties', Faculty::where('is_active', true)->orderBy('name')->get());
        });
        //Login update listener
        Event::listen(Login::class, UpdateLoginInfo::class);
    }
}
