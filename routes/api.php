<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CardController;
use App\Http\Controllers\Api\PaymentController;
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

Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    //Card Routes
    Route::get('cards', [CardController::class, 'cards']);
    Route::post('card/verify-pin', [CardController::class, 'verifyCardPin']);

    //Transaction Routes
    Route::post('make-payment', [PaymentController::class, 'makePayment']);
});


Route::get('/curl', [PaymentController::class, 'curlRequest']);

Route::post('/tokenize', [PaymentController::class, 'tokenize']);
Route::post('/authorizePayment', [PaymentController::class, 'authorizePayment']);

// Testing Routes
// Route::get('/header', [PaymentController::class, 'authHeaderGenerator']);
// Route::get('/encrypt-api', [PaymentController::class, 'encryptData']);
/* MDES MasterCard Routes */
// Route::post('/tokenize', [PaymentController::class, 'tokenize']);
// Route::post('/notifyTokenUpdated', [PaymentController::class, 'notifyTokenUpdated']);
// Route::post('/transact', [PaymentController::class, 'transact']);
// Route::get('/getAsset', [PaymentController::class, 'getAsset']);
// Route::post('/suspend', [PaymentController::class, 'suspend']);
// Route::post('/unSuspend', [PaymentController::class, 'unSuspend']);
// Route::post('/delete', [PaymentController::class, 'delete']);
// Route::post('/getTaskStatus', [PaymentController::class, 'getTaskStatus']);
// Route::post('/searchTokens', [PaymentController::class, 'searchTokens']);
// Route::post('/getToken', [PaymentController::class, 'getToken']);

