<?php

namespace App\Providers;

use App\Http\Composers\Admin\MenuComposer;
use App\Http\Composers\Customer\MenuComposer as CustomerMenuComposer;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
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
        Schema::defaultStringLength(191);
        View::composer('admin.layouts.backend', MenuComposer::class);
        View::composer('customer.layout', CustomerMenuComposer::class);

        Blade::directive('moneyFormat', function ($money) {
            return "<?php echo number_format($money, 2); ?>";
        });
    }
}
