<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::post('banner-home', [HomeController::class, 'BannerHome']);
Route::post('news-home', [HomeController::class, 'NewsHome']);
Route::post('services-home', [HomeController::class, 'ServicesHome']);
Route::post('projects-home', [HomeController::class, 'ProjectsHome']);
Route::post('aboutus-home', [HomeController::class, 'AboutUsHome']);
Route::post('others-home', [HomeController::class, 'OthersHome']);
