<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{FictionController};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Fiction API endpoints
Route::group(['prefix' => '/{website}', 'namespace' => 'Api', 'middleware' => \App\Http\Middleware\SetWebsiteForWebsiteContext::class], function () {
    Route::get('/fiction/{fiction}', [FictionController::class, 'show']);
    Route::get('/fiction/{fiction}/chapters', [FictionController::class, 'chapters']);
    Route::get('/fiction/{fiction}/chapters/{chapter}', [FictionController::class, 'showChapter']);
});
