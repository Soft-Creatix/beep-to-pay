<?php

use App\Http\Controllers\MasterCardPaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/curl', [MasterCardPaymentController::class, 'curlRequest']);


Route::post('/tokenize', [MasterCardPaymentController::class, 'tokenize']);
Route::post('/authorizePayment', [MasterCardPaymentController::class, 'authorizePayment']);

// Testing Routes
// Route::get('/header', [MasterCardPaymentController::class, 'authHeaderGenerator']);
// Route::get('/encrypt-api', [MasterCardPaymentController::class, 'encryptData']);
/* MDES MasterCard Routes */
// Route::post('/tokenize', [MasterCardPaymentController::class, 'tokenize']);
// Route::post('/notifyTokenUpdated', [MasterCardPaymentController::class, 'notifyTokenUpdated']);
// Route::post('/transact', [MasterCardPaymentController::class, 'transact']);
// Route::get('/getAsset', [MasterCardPaymentController::class, 'getAsset']);
// Route::post('/suspend', [MasterCardPaymentController::class, 'suspend']);
// Route::post('/unSuspend', [MasterCardPaymentController::class, 'unSuspend']);
// Route::post('/delete', [MasterCardPaymentController::class, 'delete']);
// Route::post('/getTaskStatus', [MasterCardPaymentController::class, 'getTaskStatus']);
// Route::post('/searchTokens', [MasterCardPaymentController::class, 'searchTokens']);
// Route::post('/getToken', [MasterCardPaymentController::class, 'getToken']);

