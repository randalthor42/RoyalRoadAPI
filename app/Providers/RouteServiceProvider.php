<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Api\ApiKey;
use Illuminate\Support\Facades\RateLimiter;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            $apiKey = ApiKey::where('key', $request->header('X-API-KEY'))->with('limit')->first();
            
            $rateLimit = $apiKey && $apiKey->limit ? $apiKey->limit->rate_limit : null;
        
            return $rateLimit
                ? Limit::perMinute($rateLimit)
                : Limit::none();
        });
        

        $this->routes(function () {
            Route::middleware(['api', 'api.key.auth', 'throttle:api'])
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
