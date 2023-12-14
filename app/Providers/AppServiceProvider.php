<?php

namespace App\Providers;

use App\Models\User;
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
    // app/Providers/AppServiceProvider.php

    public function boot()
    {
        view()->composer('*', function ($view) {
            $auth = auth()->user();
            $sidebarLogo = $auth ? User::where('photo', $auth->photo)->first() : null;

            $view->with('sidebarLogo', $sidebarLogo);
        });
    }

}
