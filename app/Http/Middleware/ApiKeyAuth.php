<?php
namespace App\Http\Middleware;

use Closure;
use App\Models\Api\ApiKey;

class ApiKeyAuth
{
    public function handle($request, Closure $next)
    {
        $apiKey = $request->header('X-API-KEY');

        if (!$apiKey || !ApiKey::where('key', $apiKey)->first()) {
            return response()->json(['message' => 'Unauthorized.'], 401);
        }

        return $next($request);
    }
}