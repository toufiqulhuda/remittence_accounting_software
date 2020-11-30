<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\ExhouseController;
use App\Http\Controllers\GroupAccountController;
use App\Http\Controllers\SubGroupAccountController;
use App\Http\Controllers\ChartOfAccountController;
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



Route::view('home','home')->name('home')->middleware(['auth']);
/************************************
  User route
*************************************/
Route::resource('users', UserController::class);
Route::put('users/reset/{user_id}', [UserController::class,'reset'])->name('users-reset');
Route::post('change-userstatus', [UserController::class,'isactive'])->name('change-userstatus');

/************************************
  role route
*************************************/
Route::resource('roles', RoleController::class);
Route::post('change-rolestatus', [RoleController::class,'isactive'])->name('change-rolestatus');
/************************************
  Country route
*************************************/
Route::resource('countries', CountryController::class);
Route::post('change-countrystatus', [CountryController::class,'isactive'])->name('change-countrystatus');

/************************************
  Currency route
*************************************/
Route::resource('currencies', CurrencyController::class);
Route::post('change-currencystatus', [CurrencyController::class,'isactive'])->name('change-currencystatus');

/************************************
  Exhouse route
*************************************/
Route::resource('exhouses', ExhouseController::class);
Route::post('change-exhousestatus', [ExhouseController::class,'isactive'])->name('change-exhousestatus');
/************************************
  GroupAccount route
*************************************/
Route::resource('groupAccount', GroupAccountController::class);
//Route::get('groupAccount/edit', [HouseKeepingController::class,'groupAccountEdit'])->name('groupAccount-edit');
//Route::get('groupAccount/create', [HouseKeepingController::class,'groupAccountCreate'])->name('groupAccount-create');
//Route::post('groupAccount/store', [HouseKeepingController::class,'groupAccountStore'])->name('groupAccount-store');
/************************************
  SubGroupAccount route
*************************************/
Route::resource('subGroupAccount', SubGroupAccountController::class);
//Route::get('subGroupAccount/edit', [HouseKeepingController::class,'subGroupAccountEdit'])->name('subGroupAccount-edit');
//Route::get('subGroupAccount/create', [HouseKeepingController::class,'subGroupAccountCreate'])->name('subGroupAccount-create');
/************************************
  ChartOfAccount route
*************************************/
Route::resource('chartOfAccount', ChartOfAccountController::class);
//Route::get('chartOfAccount/edit', [HouseKeepingController::class,'chartOfAccountEdit'])->name('chartOfAccount-edit');
//Route::get('chartOfAccount/create', [HouseKeepingController::class,'chartOfAccountCreate'])->name('chartOfAccount-create');
/************************************
  Transaction route
*************************************/
//Route::resource('transactions', TransactionController::class);
Route::get('transaction/account', [TransactionController::class,'accountTransactionCreate'])->name('transaction-account');
Route::post('transaction/account/store', [TransactionController::class,'accountTransactionStore'])->name('transaction-account-store');
Route::get('transaction/reverse', [TransactionController::class,'reverseTransactionCreate'])->name('transaction-reverse');
Route::post('transaction/delete', [TransactionController::class,'transactionDelete'])->name('transaction-delete');
