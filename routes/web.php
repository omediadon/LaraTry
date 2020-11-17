<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PostsController;
use App\Lbc\LaravelBootstrapComponents;
use App\Models\Category;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

LaravelBootstrapComponents::init();
LaravelBootstrapComponents::initDocs();

Route::get('/', [
	LandingController::class,
	'index',
])
     ->name('landing');

Auth::routes();

Route::get('/home', [
	HomeController::class,
	'index',
])
     ->name('home');

Route::post('post', [
	PostsController::class,
	'store',
])
     ->name('post.create');

Route::PUT('post/{post}', [
	PostsController::class,
	'update',
])
     ->name('post.update');

Route::get('/category/{category:slug}', function(Category $category){

	dd($category->name);
})
     ->name('category.view');

Route::get('/lang/{locale}', function($locale){
	if(!in_array($locale, config('app.locales'))){
		return redirect()->back();
	}
	App::setLocale($locale);
	session()->put('locale', $locale);

	return redirect()->back();
});
