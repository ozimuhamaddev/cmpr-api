<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\HomeController;
use App\Http\Controllers\API\NewsController;
use App\Http\Controllers\API\AboutUsController;
use App\Http\Controllers\API\ContactController;
use App\Http\Controllers\API\ServicesController;
use App\Http\Controllers\API\ProjectsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\API\Admin\AdminHomeController;



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
Route::post('menu', [HomeController::class, 'Menu']);
Route::post('banner-home', [HomeController::class, 'BannerHome']);
Route::post('news-home', [HomeController::class, 'NewsHome']);
Route::post('services-home', [HomeController::class, 'ServicesHome']);
Route::post('projects-home', [HomeController::class, 'ProjectsHome']);
Route::post('aboutus-home', [HomeController::class, 'AboutUsHome']);
Route::post('others-home', [HomeController::class, 'OthersHome']);
Route::post('projects-category', [HomeController::class, 'ProjectsCategory']);
Route::post('news-detail', [NewsController::class, 'Detail']);
Route::post('aboutus', [AboutUsController::class, 'index']);
Route::post('contact', [ContactController::class, 'index']);
Route::post('services', [ServicesController::class, 'index']);
Route::post('news', [NewsController::class, 'index']);
Route::post('services-detail', [ServicesController::class, 'Detail']);
Route::post('projects', [ProjectsController::class, 'index']);
Route::post('category-news', [NewsController::class, 'category']);
Route::post('tags-news', [NewsController::class, 'tags']);
Route::post('news-tags', [NewsController::class, 'tagsDetail']);
Route::post('news-category', [NewsController::class, 'categoryDetail']);


Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('refresh', [AuthController::class, 'refresh']);
Route::post('check-token', [AuthController::class, 'checkToken']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Protect these routes with JWT middleware
Route::middleware(['check.jwt'])->group(function () use ($router) {

    Route::get('me', [AuthController::class, 'me']);
    $router->group(['prefix' => 'admin'], function () use ($router) {

        $router->post('home', [AdminHomeController::class, 'index']);
        $router->post('do-status-menu', [AdminHomeController::class, 'doStatusMenu']);
    });
    // Add other protected routes here
});
