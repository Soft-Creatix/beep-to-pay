<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Website\Auth\ForgotPasswordController;
use Carbon\Carbon;
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

Route::get('/date', function () {
    $date = '08-02-2022';
    $date = Carbon::parse($date);
    $date = $date->format('Y-m-d');
    return $date;
});

Route::get('/sms', function () {

    $MESSAGEBIRD_ACCESS_KEY = env('MESSAGEBIRD_ACCESS_KEY', '8BiBZvfIcRJM9XoZNzy2GKSUN');
    $MESSAGEBIRD_ORIGINATOR = env('MESSAGEBIRD_ORIGINATOR', 'BeeptoPay');

    $MessageBird = new \MessageBird\Client($MESSAGEBIRD_ACCESS_KEY);
    $Message = new \MessageBird\Objects\Message();
    $Message->originator = $MESSAGEBIRD_ORIGINATOR;
    $Message->recipients = array('+923335806128');
    $Message->body = 'This is a test message';

    $MessageBird->messages->create($Message);
    return 'true';
});

/**Playing with master card OAuth */
Route::get('master-card', [PaymentController::class, 'index']);

Route::get('/', function () {
    return redirect(route('website.login'));
});

// Registration Routes...
Route::get('register', [App\Http\Controllers\Website\Auth\RegisterController::class, 'showRegistrationForm'])->name('website.register.show');
Route::post('register', [App\Http\Controllers\Website\Auth\RegisterController::class, 'register'])->name('website.register');

// Authentication Routes...
Route::get('login', [App\Http\Controllers\Website\Auth\LoginController::class, 'showLoginForm'])->name('website.login.show');
Route::post('login', [App\Http\Controllers\Website\Auth\LoginController::class, 'login'])->name('website.login');

// Logout Route
Route::get('logout', [App\Http\Controllers\Website\Auth\LoginController::class, 'logout'])->name('website.logout');

Route::get('change-password', [App\Http\Controllers\Website\UserController::class, 'changePassword'])->name('website.change-password');

// Reset Password Route
Route::get('password/reset', [App\Http\Controllers\Website\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

// Website Controller Routes.....
Route::get('verification', [App\Http\Controllers\Website\VerificationController::class, 'verification'])->name('website.verification');
Route::post('verifyOTP', [App\Http\Controllers\Website\VerificationController::class, 'verifyOTP'])->name('website.verifyOTP');
Route::get('resendOTP', [App\Http\Controllers\Website\VerificationController::class, 'resendOTP'])->name('website.resendOTP');
Route::get('dashboard', [App\Http\Controllers\Website\WebsiteController::class, 'dashboard'])->name('website.dashboard');
Route::get('success', [App\Http\Controllers\Website\WebsiteController::class, 'success'])->name('website.success');
Route::get('payment-card', [App\Http\Controllers\Website\WebsiteController::class, 'paymentCard'])->name('website.payment-card');
Route::post('payment-card', [App\Http\Controllers\Website\WebsiteController::class, 'addpaymentCard'])->name('website.add-payment-card');
Route::get('remove-card/{id}', [App\Http\Controllers\Website\WebsiteController::class, 'removeCard'])->name('website.remove-card');
Route::get('delete-card/{id}', [App\Http\Controllers\Website\WebsiteController::class, 'deleteCard'])->name('website.delete-card');
Route::get('receipt/{transaction_id}', [App\Http\Controllers\Website\WebsiteController::class, 'receipt'])->name('website.receipt');
Route::get('spinner', [App\Http\Controllers\Website\WebsiteController::class, 'spinner'])->name('website.spinner');

Route::get('payment-pin', [App\Http\Controllers\Website\UserController::class, 'paymentPin'])->name('website.payment-pin');
Route::post('payment-pin', [App\Http\Controllers\Website\UserController::class, 'setPaymentPin'])->name('website.payment-pin.set');

/* Portal Routes */
Route::group(['prefix' => 'portal'], function () {
    Auth::routes();
    Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/dashboard', [App\Http\Controllers\Admin\HomeController::class, 'dashboard'])->name('admin.dashboard');

    Route::group(['middleware' => ['role:Super Admin']], function () {
        //Manage Access Routes
        Route::resource('role', App\Http\Controllers\Admin\RoleController::class)->except(['show']);
        Route::resource('permission', App\Http\Controllers\Admin\PermissionController::class)->except(['show']);
        Route::resource('role-permissions', App\Http\Controllers\Admin\RolePermissionsController::class)->except(['create', 'store', 'show', 'destroy']);
        Route::resource('user-role', App\Http\Controllers\Admin\UserRoleController::class)->except(['create', 'store', 'show', 'destroy']);
        Route::resource('user-permissions', App\Http\Controllers\Admin\UserPermissionsController::class)->except(['create', 'store', 'show', 'destroy']);
        Route::resource('user', App\Http\Controllers\Admin\UserController::class)->except(['show']);
    });
});
