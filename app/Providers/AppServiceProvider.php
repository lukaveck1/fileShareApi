<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;

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
        RateLimiter::for('getRequestApiLimiter', function () { 
            return Limit::perMinute(10)->response(function () {
                return response()->json(['error' => 'Number of GET requests per minute is limited to 10.'], 401);
            });
        });

        RateLimiter::for('postRequestApiLimiter', function () { 
            return Limit::perMinute(2)->response(function () {
                return response()->json(['error' => 'Number of POST requests per minute is limited to 5.'], 401);
            });
        });
    }
}
