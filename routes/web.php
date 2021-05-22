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
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MailController;
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
//Route::get('users-search', [UserController::class,'search'])->name('users-search');
Route::get('users-search', [UserController::class,'showUserInfoByName']);
Route::post('users-search', [UserController::class,'showUserInfoByName'])->name('users-search');
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
Route::get('transaction/reverse-pdf', [TransactionController::class,'createPDF'])->name('transaction-reverse-pdf');
Route::post('transaction/delete', [TransactionController::class,'transactionDelete'])->name('transaction-delete');
Route::get('endOfDay', [TransactionController::class,'endOfDay'])->name('endOfDay');
Route::post('endOfDay', [TransactionController::class,'endOfDayProcess'])->name('endOfDay');
Route::get('startDay', [TransactionController::class,'startTransactionDay'])->name('startDay');
Route::post('startDay', [TransactionController::class,'startTransactionDayProcess'])->name('startDay');
Route::get('yearClosing', [TransactionController::class,'yearClosing'])->name('yearClosing');

/************************************
  Report route
*************************************/
Route::get('houseKeepingRpt/pdf', [ReportsController::class,'houseKeepingPDF'])->name('houseKeepingRpt-pdf');
Route::get('todaysRpt', [ReportsController::class,'todaysRptView'])->name('todaysRpt');
Route::post('todaysRpt', [ReportsController::class,'todaysRpt'])->name('todaysRpt');
//Route::post('voucherPrintRptPDF', [ReportsController::class,'voucherPrintRpt'])->name('voucherPrintRptPDF');
Route::get('rptAsOnDate', [ReportsController::class,'rptAsOnDateView'])->name('rptAsOnDate');
Route::post('rptAsOnDate', [ReportsController::class,'rptAsOnDate'])->name('rptAsOnDate');
/************************************
  Menu route
*************************************/
Route::get('menus',[MenuController::class,'index'])->name('menus.index');
Route::get('menus-show',[MenuController::class,'show']);
Route::post('menus',[MenuController::class,'store'])->name('menus.store');

/************************************
  Send Mail route
*************************************/
//Route::get('sendbasicemail',[MailController::class,'basic_email']);
Route::get('sendhtmlemail',[MailController::class,'html_email']);
//Route::get('sendattachmentemail',[MailController::class,'attachment_email']);
