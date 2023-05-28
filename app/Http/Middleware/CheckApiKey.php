<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Api\ApiKey;
use Illuminate\Http\Request;

class CheckApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $apiKey = $request->header('x-api-key');

        if(!$apiKey) {
            return response()->json(['error' => 'Api key not provided.'], 401);
        }

        $apiKeyModel = ApiKey::where('key', $apiKey)->first();

        if(!$apiKeyModel) {
            return response()->json(['error' => 'Invalid api key.'], 401);
        }
        
        return $next($request);
    }
}
