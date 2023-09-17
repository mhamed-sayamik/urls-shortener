<?php

use App\Http\Controllers\UrlController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
})*/

// API route for shortening a URL
Route::post('/urls', [UrlController::class, 'create']);

// API route for getting all URLs sorted by click_count
Route::get('/urls/most-visited', [UrlController::class, 'mostVisited']);

// API route for getting the URL to redirect to
Route::get('/urls/{shortUrl}', [UrlController::class, 'show']);

// API route for getting all URLs with their data
Route::get('/urls', [UrlController::class, 'index']);


