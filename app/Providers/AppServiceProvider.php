<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
    Blade::directive('prettyDateFormat', function ($expression) {
      return "<?php echo \Carbon\Carbon::parse($expression)->format('M. d, Y H:i:s'); ?>";
    });
  }
}
