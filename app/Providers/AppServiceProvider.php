<?php

namespace App\Providers;

use App\View\Components\Button;
use App\View\Components\Input;
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
    if (config('APP_ENV') !== 'local') {
      URL::forceScheme('https');
    }

    Blade::component('button', Button::class);
    Blade::component('input', Input::class);
  }
}
