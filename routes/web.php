<?php

use App\Http\Controllers\MasterCardPaymentController;
use App\Http\Controllers\Website\Auth\ForgotPasswordController;
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

Route::get('/', function () {
    return view('welcome');
});


/**Playing with master card OAuth */
Route::get('master-card', [MasterCardPaymentController::class, 'index']);


Route::get('/', function () {
    return redirect(route('website.login'));
});

// Registration Routes...
Route::get('register', [App\Http\Controllers\Website\Auth\RegisterController::class, 'showRegistrationForm'])->name('website.register');
Route::post('register', [App\Http\Controllers\Website\Auth\RegisterController::class, 'register'])->name('website.register');

// Authentication Routes...
Route::get('login', [App\Http\Controllers\Website\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [App\Http\Controllers\Website\Auth\LoginController::class, 'login'])->name('website.login');

// Logout Route
Route::get('logout', [App\Http\Controllers\Website\Auth\LoginController::class, 'logout'])->name('website.logout');

// Reset Password Route
Route::get('password/reset', [App\Http\Controllers\Website\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

// Website Controller Routes.....
Route::get('dashboard', [App\Http\Controllers\Website\WebsiteController::class, 'index'])->name('website.index');
Route::get('hurray', [App\Http\Controllers\Website\WebsiteController::class, 'hurray'])->name('website.hurray');
Route::get('payment-card', [App\Http\Controllers\Website\WebsiteController::class, 'paymentCard'])->name('website.payment-card');
Route::get('remove-card', [App\Http\Controllers\Website\WebsiteController::class, 'removeCard'])->name('website.remove-card');
Route::get('receipt', [App\Http\Controllers\Website\WebsiteController::class, 'receipt'])->name('website.receipt');
Route::get('spinner', [App\Http\Controllers\Website\WebsiteController::class, 'spinner'])->name('website.spinner');
Route::get('confirm-info', [App\Http\Controllers\Website\WebsiteController::class, 'confirmInfo'])->name('website.confirm-info');
