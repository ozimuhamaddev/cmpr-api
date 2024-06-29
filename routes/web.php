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
use App\Http\Controllers\API\Admin\AdminNewsController;
use App\Http\Controllers\API\Admin\StaticController;
use App\Http\Controllers\API\Admin\AdminAboutUsController;
use App\Http\Controllers\API\Admin\AdminContactController;

use App\Http\Controllers\API\Admin\TestimonialController;
use App\Http\Controllers\API\Admin\ClientController;
use App\Http\Controllers\API\Admin\WedoController;
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

// Protect these routes with JWT middleware
Route::middleware(['check.jwt'])->group(function () use ($router) {
    Route::get('me', [AuthController::class, 'me']);
    $router->group(['prefix' => 'admin'], function () use ($router) {
        $router->post('home', [AdminHomeController::class, 'index']);
        $router->post('do-status-menu', [AdminHomeController::class, 'doStatusMenu']);
        $router->post('news', [AdminNewsController::class, 'index']);
        $router->post('static', [StaticController::class, 'index']);
        $router->post('do-add-static', [StaticController::class, 'doAddStatic']);


        $router->post('testimonial', [TestimonialController::class, 'index']);
        $router->post('client', [ClientController::class, 'index']);
        $router->post('wedo', [WedoController::class, 'index']);


        $router->post('about/do-update', [AdminAboutUsController::class, 'doUpdate']);
        $router->post('contact/do-update', [AdminContactController::class, 'doUpdate']);
    });
});
