<?php

namespace App\Providers;

use App\View\Composers\AnnouncementsComposer;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use View;

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
        Paginator::defaultView('pagination.links');

        View::composer('panel.partials.announcemnts', AnnouncementsComposer::class);
    }
}
