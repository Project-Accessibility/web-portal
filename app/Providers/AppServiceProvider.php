<?php

namespace App\Providers;

use App\View\Components\Breadcrumb;
use App\View\Components\Button;
use App\View\Components\Input;
use App\View\Components\Table\Header;
use App\View\Components\Table\Row;
use App\View\Components\Table\Table;
use App\View\Components\NavBar;
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

        Blade::component('nav-bar', NavBar::class);
        Blade::component('button', Button::class);
        Blade::component('input', Input::class);
        Blade::component('breadcrumb', Breadcrumb::class);

        Blade::component('table', Table::class);
        Blade::component('table-header', Header::class);
        Blade::component('table-row', Row::class);
    }
}
