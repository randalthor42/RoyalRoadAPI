<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{FictionController, AuthorController, ChapterController, SearchController, ListingController};

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

Route::get('/fictions/{id}', [FictionController::class, 'show']);
Route::get('/authors/{id}', [AuthorController::class, 'show']);
Route::get('/chapters/{id}', [ChapterController::class, 'show']);
Route::get('/search', [SearchController::class, 'index']);
Route::get('/listings', [ListingController::class, 'index']);
