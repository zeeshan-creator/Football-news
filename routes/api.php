<?php

use App\Models\news;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API_userController;
use App\Http\Controllers\API_newsController;
use App\Http\Controllers\API_promotionController;
use App\Http\Controllers\API_forgetPasswordController;

use App\Http\Controllers\DataController;
use App\Http\Controllers\testController;

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


// Api routes for Users with custom authentication;
// Route::middleware('auth:api')->get('user', [API_userController::class, 'index']);
Route::post('userLogin', [API_userController::class, 'authenticate']); // Login
Route::post('user', [API_userController::class, 'register']); // Registration
Route::put('user', [API_userController::class, 'update']); //Update
// Route::middleware('auth:api')->delete('user/{id}', [API_userController::class, 'destroy']);

// Auth login & registration 
Route::post('register', [API_userController::class, 'register']);
Route::post('login', [API_userController::class, 'authenticate']);

Route::get('news', [API_newsController::class, 'index']);
Route::get('promotion', [API_promotionController::class, 'index']);

Route::group(['middleware' => ['jwt.verify']], function () {
    // get current user
    Route::get('user', [API_userController::class, 'getAuthenticatedUser']);

    // Api routes for News 
    Route::get('news/{id}', [API_newsController::class, 'show']);
    Route::post('news', [API_newsController::class, 'store']);
    Route::put('news/{id}', [API_newsController::class, 'update']);
    Route::delete('news/{id}', [API_newsController::class, 'destroy']);

    // Api routes for Promotions 
    Route::get('promotion/{id}', [API_promotionController::class, 'show']);
    Route::post('promotion', [API_promotionController::class, 'store']);
    Route::post('updatepromotion/{id}', [API_promotionController::class, 'update']);
    Route::delete('promotion/{id}', [API_promotionController::class, 'destroy']);
});


Route::post(
    'forget-password',
    [API_forgetPasswordController::class, 'forget_password']
); // Forget password

Route::post(
    'reset-password',
    [API_forgetPasswordController::class, 'reset_password']
); // reset password
