<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
    return view('auth.login');
});//->middleware(['auth']);

// Route::get('/users', function () {
//     return view('pages.users.index');
// });

// Route::view('home','home')->middleware(['auth']);
Route::get('users', [UserController::class,'index']);
Route::get('users/show', [UserController::class,'show'])->name('show');
Route::get('users/edit', [UserController::class,'edit'])->name('edit');
//Route::get('users/destroy', [UserController::class,'']);
