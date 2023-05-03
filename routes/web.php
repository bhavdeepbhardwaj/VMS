<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;

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


Auth::routes();


Route::group(['middleware' => 'PreventBackHistory'], function () {
});


// User

Route::group(['prefix' => 'Visitor', 'middleware' => ['isUser', 'auth', 'PreventBackHistory']], function () {

    Route::get('Thank-you', [UserController::class, 'thankYou'])->name('thankYou.user');
    // Dashboard
    Route::get('list', [UserController::class, 'VisitiorRegistration'])->name('user.list');

    Route::get('popUpVisitiorRegistration', [UserController::class, 'popUpVisitiorRegistration']);

    // Export All User Visitor Registration
    Route::get('export-All-VisitorRegistration', [UserController::class, 'exportAllVisitorRegistration'])->name('exportAllVisitorRegistration');

    // Date Filter Export User Visitor Registration datefilterdemo
    Route::get('datefilterVisitor', [UserController::class, 'datefilterVisitor'])->name('datefilterVisitor');

    // QR Code
    Route::get('qr-code', [UserController::class, 'QRCode'])->name('user.qrcode');

    // Profile

    // Route::get('/', [UserController::class, 'profile']);
    Route::get('profile', [UserController::class, 'profile'])->name('profile');
    Route::post('profile/profilesave', [UserController::class, 'profilesave'])->name('profilesave');

    // Password Change

    Route::get('password-change', [UserController::class, 'changePassword'])->name('change-password');
    Route::post('password-change/store', [UserController::class, 'changePasswordSave'])->name('user.changePassword');
});

Route::group(['prefix' => 'Admin', 'middleware' => ['isAdmin', 'auth', 'PreventBackHistory']], function () {
    // Admin
    Route::get('dash', [AdminController::class, 'adminHome'])->name('admin.home');

    // Visitor Registration
    Route::get('visitor-list', [AdminController::class, 'visitorRegistration'])->name('admin.visitor');
    // Route::post('visitor-list/{companyName?}', [AdminController::class, 'visitorRegistration']);
    Route::get('visitor-demo', [AdminController::class, 'visitordemoRegistration'])->name('admin.demo');

    // Export All Visitor Registration
    Route::get('export-All-visitorRegistration', [AdminController::class, 'exportAllvisitorRegistration'])->name('exportAllvisitorRegistration');

    //  Date Filter Export Visitor Registration datefilterdemo
    Route::get('datefiltervisitor', [AdminController::class, 'datefiltervisitor'])->name('datefiltervisitor');

    // PopUp
    Route::get('popUpVisitorRegistration', [AdminController::class, 'popUpVisitorRegistration']);
    // Route::get('popUpVisitorRegistration', [HomeController::class, 'popUpVisitorRegistration']);

    // Admin Profile
    Route::get('profile', [AdminController::class, 'profile'])->name('admin.profile');

    // Admin Profile Update
    Route::post('profile/profilesave', [AdminController::class, 'adminProfilesave'])->name('admin.profilesave');

    // Admin Password Change
    Route::post('changePassword', [AdminController::class, 'changePasswordSave'])->name('changePassword');

    // All User
    Route::get('customers', [AdminController::class, 'user'])->name('user');

    // Export All Customers
    Route::get('all-customers', [AdminController::class, 'exportAllUsers'])->name('all-customers');

    // POPUP
    Route::get('popUpUserRegistration', [AdminController::class, 'popUpUserRegistration']);

    // Export Visitor
    Route::post('exportVisitor', [AdminController::class, 'exportVisitor'])->name('admin.exportVisitor');

    // Calendar routes
    // Index
    Route::get('calendar/index', [CalendarController::class, 'index'])->name('calendar.index');
    // Store
    Route::post('calendar', [CalendarController::class, 'store'])->name('calendar.store');
    // Edit
    Route::put('calendar/edit/{id}', [CalendarController::class, 'edit'])->name('calendar.edit');
    // Drag & update
    Route::patch('calendar/update/{id}', [CalendarController::class, 'update'])->name('calendar.update');
    // Delete
    Route::delete('calendar/destroy/{id}', [CalendarController::class, 'destroy'])->name('calendar.destroy');
});

Route::group(['prefix' => 'Gsync', 'middleware' => ['isDemo', 'auth', 'PreventBackHistory']], function () {

    // Dashboard
    Route::get('dash', [DemoController::class, 'demoHome'])->name('demo.home');
    // Demo List
    Route::get('Gsync-list', [DemoController::class, 'demoRegistration'])->name('demo.index');

    Route::get('popUpDemoRegistration', [DemoController::class, 'popUpDemoRegistration']);

    // Export All Clinic Visitor Registration
    Route::get('export-All-DemoRegistration', [DemoController::class, 'exportAllDemoRegistration'])->name('exportAllDemoRegistration');

    //  Date Filter Export Visitor Registration datefilterdemo
    Route::get('datefilterdemo', [DemoController::class, 'datefilterdemo'])->name('datefilterdemo');

    //  Demo Profile
    Route::get('profile', [DemoController::class, 'profile'])->name('demo.profile');
    Route::post('profile/profilesave', [DemoController::class, 'profilesave'])->name('demo.profilesave');

    // Password Change

    Route::get('password-change', [DemoController::class, 'changePassword'])->name('demo.change-password');
    Route::post('password-change/store', [DemoController::class, 'changePasswordSave'])->name('demo.changePassword');
});


Route::post('api/fetch-states', [CountriesStatesCitiesController::class, 'fetchState']);

Route::post('api/fetch-cities', [CountriesStatesCitiesController::class, 'fetchCity']);


// Privacy Policy

Route::get('privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacyPolicy');

// Thank You
Route::get('Thank-you', [HomeController::class, 'thankYou'])->name('thankYou');

// Sign UP Thank You
Route::get('sign-up-thanku-you', [HomeController::class, 'signUpthankyou'])->name('sign-up-thank');


Route::get('pagetest', [HomeController::class, 'pagetest'])->name('pagetest');

// visitor

Route::get('globalsyncvisitor', [HomeController::class, 'visitor'])->name('visitor');
Route::post('Visitor/store', [HomeController::class, 'visitorSave'])->name('visitor.store');
Route::get('globalsyncvisitor/submit', [HomeController::class, 'submitForm'])->name('submit');

// Route::get('popUpVisitorRegistration', [HomeController::class, 'popUpVisitorRegistration']);


// User visitor

// Route::get('resgvisitor/{slg}', [HomeController::class, 'uservisitor'])->name('user.visitor');
// Route::post('uservisitor/store', [HomeController::class, 'UvisitorSave'])->name('user.visitorstore');
// Route::get('user/submit', [HomeController::class, 'UvisitorSubmit'])->name('user.sumbit');
// Route::get('user/submit', [HomeController::class, 'UvisitorSubmit'])->name('user.sumbit');

// // Route::get('user/submit', [HomeController::class, 'UvisitorSubmit'])->name('user.sumbit');
// Route::get('submit/{id}', [HomeController::class, 'UvisitorSubmit'])->name('user.sumbit');

Route::get('resgvisitor/{slg}', [HomeController::class, 'uservisitor'])->name('user.visitor');
Route::post('uservisitor/store', [HomeController::class, 'UvisitorSave'])->name('user.visitorstore');
// Route::get('user/submit', [HomeController::class, 'UvisitorSubmit'])->name('user.sumbit');
Route::get('submit/{id}', [HomeController::class, 'UvisitorSubmit'])->name('user.sumbit');


// Demo visitor

Route::get('demovisitor', [HomeController::class, 'demovisitor'])->name('demo');
Route::post('demovisitor/store', [HomeController::class, 'demovisitorSave'])->name('demo.store');
Route::get('demo/submit', [HomeController::class, 'demoSubmitForm'])->name('demo.sumbit');



// Dashboard Report Visitor

Route::get('/get-visitor-chart-data', [HomeController::class, 'getMonthlyVisitorRegistrationData']);


// Optimize
Route::get('/Optimize', function () {
    // Config Cache & Clear
    $configcache = Artisan::call('config:cache');
    $configclear = Artisan::call('config:clear');
    // Cache Clear
    $cacheclear = Artisan::call('cache:clear');
    // Route Cache & Clear
    $routeclear = Artisan::call('route:clear');
    $routecache = Artisan::call('route:cache');
    // View Clear
    $viewclear = Artisan::call('view:clear');
    $viewcache = Artisan::call('view:cache');

    echo "Optimize ...!<br>";
    // return redirect()->back()->with("success", "Optimize ...!");
});

// // Migrate Fresh Table
// Route::get('/re-migrate', function () {
//     // Migrate Fresh Table
//     $migrate = Artisan::call('migrate:fresh');
//     echo "Migrate Fresh...!<br>";
// });

// Seeder
// Route::get('/db-seed', function () {
//     // php artisan db:seed
//     $dbseed = Artisan::call('db:seed');

//     echo "DB Seed!<br>";
// });


// Calendar View
Route::get('calendar/list', [CalendarController::class, 'list'])->name('calendar.list');

// All CheckOut Script
Route::get('checkOut-visitor', [ScriptController::class, 'updateCheckOut']);

// Check Out
Route::put('chechOutVisitior/{id}', [HomeController::class, 'checkOutVisitior']);
Route::get('phpinfo', fn () => phpinfo());
