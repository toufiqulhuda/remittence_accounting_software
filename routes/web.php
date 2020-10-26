<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CurrencyController;
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
// clear application cache
Route::get('/clear-all', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');

    return "Application cache-route-view clear";
});
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Application cache flushed";
});

// clear route cache
Route::get('/clear-route-cache', function() {
    Artisan::call('route:clear');
    return "Route cache file removed";
});

// clear view compiled files
Route::get('/clear-view-compiled-cache', function() {
    Artisan::call('view:clear');
    return "View compiled files removed";
});

// clear config files
Route::get('/clear-config-cache', function() {
    Artisan::call('config:clear');
    return "Configuration cache file removed";
});

Route::get('/', function () {
    //return view('auth.login');
    return redirect('login');
});//->middleware(['auth']);



Route::view('home','home')->name('home');
/************************************
  User route
*************************************/
Route::get('users', [UserController::class,'index']);
Route::get('users/show', [UserController::class,'show'])->name('users-show');
Route::get('users/edit', [UserController::class,'edit'])->name('users-edit');
Route::get('users/create', [UserController::class,'create'])->name('users-create');
//Route::get('users/reset', [UserController::class,'users-reset']);
//Route::get('users/destroy', [UserController::class,'']);
/************************************
  role route
*************************************/
Route::get('role', [RoleController::class,'index']);
Route::get('role/edit', [RoleController::class,'edit'])->name('role-edit');
Route::get('role/create', [RoleController::class,'create'])->name('role-create');
/************************************
  Country route
*************************************/
Route::get('country', [CountryController::class,'index']);
Route::get('country/edit', [CountryController::class,'edit'])->name('country-edit');
Route::get('country/create', [CountryController::class,'create'])->name('country-create');
/************************************
  Currency route
*************************************/
Route::get('currency', [CurrencyController::class,'index']);
Route::get('currency/edit', [CurrencyController::class,'edit'])->name('currency-edit');
Route::get('currency/create', [CurrencyController::class,'create'])->name('currency-create');
