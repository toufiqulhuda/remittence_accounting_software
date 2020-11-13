<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\ExhouseController;
use App\Http\Controllers\HouseKeepingController;
use App\Http\Controllers\TransactionController;
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
Route::resource('users', UserController::class);
// Route::get('users', [UserController::class,'index']);
// Route::get('users/show', [UserController::class,'show'])->name('users-show');
// Route::get('users/edit', [UserController::class,'edit'])->name('users-edit');
// Route::get('users/create', [UserController::class,'create'])->name('users-create');
//Route::get('users/reset', [UserController::class,'users-reset']);
//Route::get('users/destroy', [UserController::class,'']);
/************************************
  role route
*************************************/
Route::resource('roles', RoleController::class);
/************************************
  Country route
*************************************/
Route::resource('countries', CountryController::class);

/************************************
  Currency route
*************************************/
Route::resource('currencies', CurrencyController::class);

/************************************
  Exhouse route
*************************************/
Route::resource('exhouses', ExhouseController::class);

/************************************
  GroupAccount route
*************************************/
//Route::get('groupAccount', [HouseKeepingController::class,'groupAccountCreate']);
Route::get('groupAccount/edit', [HouseKeepingController::class,'groupAccountEdit'])->name('groupAccount-edit');
Route::get('groupAccount/create', [HouseKeepingController::class,'groupAccountCreate'])->name('groupAccount-create');
/************************************
  SubGroupAccount route
*************************************/
//Route::get('exhouse', [HouseKeepingController::class,'index']);
Route::get('subGroupAccount/edit', [HouseKeepingController::class,'subGroupAccountEdit'])->name('subGroupAccount-edit');
Route::get('subGroupAccount/create', [HouseKeepingController::class,'subGroupAccountCreate'])->name('subGroupAccount-create');
/************************************
  ChartOfAccount route
*************************************/
//Route::get('exhouse', [HouseKeepingController::class,'index']);
Route::get('chartOfAccount/edit', [HouseKeepingController::class,'chartOfAccountEdit'])->name('chartOfAccount-edit');
Route::get('chartOfAccount/create', [HouseKeepingController::class,'chartOfAccountCreate'])->name('chartOfAccount-create');
/************************************
  Transaction route
*************************************/
Route::get('transaction/account', [TransactionController::class,'accountTransactionCreate'])->name('transaction-account');
Route::get('transaction/reverse', [TransactionController::class,'reverseTransactionCreate'])->name('transaction-reverse');
