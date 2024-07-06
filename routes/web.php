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
use App\Http\Controllers\API\Admin\AdminProjectsController;
use App\Http\Controllers\API\Admin\StaticController;
use App\Http\Controllers\API\Admin\AdminAboutUsController;
use App\Http\Controllers\API\Admin\AdminContactController;
use App\Http\Controllers\API\Admin\AdminServicesController;
use App\Http\Controllers\API\Admin\AdminBannerController;
use App\Http\Controllers\API\Admin\AdminWeDoController;
use App\Http\Controllers\API\Admin\AdminNumberClientController;
use App\Http\Controllers\API\Admin\TestimonialController;
use App\Http\Controllers\API\Admin\AdminClientsController;
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
Route::post('icon', [HomeController::class, 'Icon']);
Route::post('clients-home', [HomeController::class, 'ClientsHome']);
Route::post('numberclient-home', [HomeController::class, 'NumberClientHome']);
Route::post('wedo-home', [HomeController::class, 'WeDoHome']);
Route::post('contact-home', [HomeController::class, 'ContactHome']);


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
        $router->post('static', [StaticController::class, 'index']);
        $router->post('static-image', [StaticController::class, 'index']);
        $router->post('do-add-static', [StaticController::class, 'doAddStatic']);
        $router->post('do-add-static-image', [StaticController::class, 'doAddStaticImage']);

        $router->post('testimonial', [TestimonialController::class, 'index']);
        $router->post('client', [ClientController::class, 'index']);
        $router->post('wedo', [WedoController::class, 'index']);

        $router->post('about/do-update', [AdminAboutUsController::class, 'doUpdate']);
        $router->post('contact/do-update', [AdminContactController::class, 'doUpdate']);

        $router->post('news/index-admin', [AdminNewsController::class, 'index']);
        $router->post('news/do-add', [AdminNewsController::class, 'doAdd']);
        $router->post('news/do-delete', [AdminNewsController::class, 'doDelete']);
        $router->post('news/index-category', [AdminNewsController::class, 'indexCategory']);
        $router->post('news/do-add-category', [AdminNewsController::class, 'doAddCategory']);
        $router->post('news/do-delete-category', [AdminNewsController::class, 'doDeleteCategory']);
        $router->post('news/master-category-detail', [AdminNewsController::class, 'masterCategoryDetail']);

        $router->post('projects/index-admin', [AdminProjectsController::class, 'index']);
        $router->post('projects/do-add', [AdminProjectsController::class, 'doAdd']);
        $router->post('projects-detail', [AdminProjectsController::class, 'Detail']);
        $router->post('projects/do-delete', [AdminProjectsController::class, 'doDelete']);
        $router->post('projects/index-category', [AdminProjectsController::class, 'indexCategory']);
        $router->post('projects/do-add-category', [AdminProjectsController::class, 'doAddCategory']);
        $router->post('projects/do-delete-category', [AdminProjectsController::class, 'doDeleteCategory']);
        $router->post('projects/master-category-detail', [AdminProjectsController::class, 'masterCategoryDetail']);

        $router->post('services/index-admin', [AdminServicesController::class, 'index']);
        $router->post('services/do-add', [AdminServicesController::class, 'doAdd']);
        $router->post('services/do-delete', [AdminServicesController::class, 'doDelete']);

        $router->post('banner/index-admin', [AdminBannerController::class, 'index']);
        $router->post('banner/do-add', [AdminBannerController::class, 'doAdd']);
        $router->post('banner/do-delete', [AdminBannerController::class, 'doDelete']);
        $router->post('banner/banner-detail', [AdminBannerController::class, 'Detail']);

        $router->post('wedo/index-admin', [AdminWeDoController::class, 'index']);
        $router->post('wedo/do-add', [AdminWeDoController::class, 'doAdd']);
        $router->post('wedo/do-delete', [AdminWeDoController::class, 'doDelete']);
        $router->post('wedo/wedo-detail', [AdminWeDoController::class, 'Detail']);

        $router->post('numberclient/index-admin', [AdminNumberClientController::class, 'index']);
        $router->post('numberclient/do-add', [AdminNumberClientController::class, 'doAdd']);
        $router->post('numberclient/do-delete', [AdminNumberClientController::class, 'doDelete']);
        $router->post('numberclient/numberclient-detail', [AdminNumberClientController::class, 'Detail']);

        $router->post('clients/index-admin', [AdminClientsController::class, 'index']);
        $router->post('clients/do-add', [AdminClientsController::class, 'doAdd']);
        $router->post('clients/do-delete', [AdminClientsController::class, 'doDelete']);
        $router->post('clients/clients-detail', [AdminClientsController::class, 'Detail']);
    });
});
