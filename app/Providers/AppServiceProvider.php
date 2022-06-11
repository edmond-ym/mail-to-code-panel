<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;

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
        $request=new Request ;
        if (App::environment('production')) {
            URL::forceScheme('https');
            if (!$request->secure()) {
                return redirect()->secure($request->getRequestUri());
            }
        }
        
    }
}
