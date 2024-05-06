<?php

use App\Models\DroneMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use bApp\Http\Middleware\Authenticate;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\DroneMediaController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\PasswordResetRequestController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
     return $request->user();
});
Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::get('userProfile', 'userProfile');
    Route::post('refresh', 'refresh');


});
Route::controller('auth'::class)->group(function () {
    Route::post('change_password', [PasswordController::class,'ChangeUserPassword']);
    Route::post('sendPasswordResetLink', [PasswordResetRequestController::class,'sendEmail']);
    Route::post('resetPassword', [ResetPasswordController::class,'passwordResetProcess']);
    Route::post('receive_image', [DroneMediaController::class,'storeImage']);
    Route::get('storage', [DroneMediaController::class,'getAllImages']);

});


