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
        RateLimiter::for('getRequestApiLimiter', function (Request $request) { 
            return Limit::perMinute(10)->by($request->ip())->response(function () {
                return response()->json(['error' => 'Number of GET requests per minute is limited to 10.'], 429);
            });
        });

        RateLimiter::for('postRequestApiLimiter', function (Request $request) { 
            return Limit::perMinute(3)->by($request->ip())->response(function () {
                return response()->json(['error' => 'Number of POST requests per minute is limited to 5.'], 429);
            });
        });
    }
}
