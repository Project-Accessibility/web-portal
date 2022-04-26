<?php

namespace App\Providers;

use App\View\Components\Breadcrumb;
use App\View\Components\Button;
use App\View\Components\DateTime;
use App\View\Components\Input;
use App\View\Components\Table\Header;
use App\View\Components\Table\Row;
use App\View\Components\Table\Table;
use App\View\Components\NavBar;
use App\View\Components\Tabs;
use Carbon\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

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
        if (config('app.env') !== 'local') {
            URL::forceScheme('https');
        } else {
            URL::forceScheme('http');
        }

        Carbon::setLocale(config('app.locale'));
        Carbon::setFallbackLocale(config('app.fallback_locale'));

        Blade::component('nav-bar', NavBar::class);
        Blade::component('tabs', Tabs::class);
        Blade::component('button', Button::class);
        Blade::component('input', Input::class);
        Blade::component('breadcrumb', Breadcrumb::class);

        Blade::component('table', Table::class);
        Blade::component('table-header', Header::class);
        Blade::component('table-row', Row::class);
    }
}
