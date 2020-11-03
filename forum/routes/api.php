<?php

use App\Http\Controllers\Auth\MeController;
use App\Http\Controllers\Auth\SignInController;
use App\Http\Controllers\Auth\SignOutController;
use App\Http\Controllers\Auth\SignUpController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ReplyController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



/********************* QUESTIONS *************************/
Route::get('questions', [QuestionController::class, 'index']);
Route::get('questions/{question}', [QuestionController::class, 'show']);
Route::post('questions', [QuestionController::class, 'store']);
Route::patch('questions/{question}', [QuestionController::class, 'update']);
Route::delete('questions/{question}', [QuestionController::class, 'destroy']);




/********************* Categories *************************/


Route::get('categories', [CategoryController::class, 'index']);
Route::get('categories/{category}', [CategoryController::class, 'show']);
Route::post('categories', [CategoryController::class, 'store']);
Route::patch('categories/{category}', [CategoryController::class, 'update']);
Route::delete('categories/{category}', [CategoryController::class, 'destroy']);



/********************* Replies *************************/


Route::get('questions/{question}/replies', [ReplyController::class, 'index']);
Route::get('questions/{question}/replies/{reply}', [ReplyController::class, 'show']);
Route::post('questions/{question}/replies', [ReplyController::class, 'store']);
Route::patch('questions/{question}/replies/{reply}', [ReplyController::class, 'update']);
Route::delete('questions/{question}/replies/{reply}', [ReplyController::class, 'destroy']);





/********************* Like *************************/


Route::post('like/{reply}', [LikeController::class, 'likeIt']);
Route::delete('like/{reply}', [LikeController::class, 'unlikeIt']);




/* ********************************* Auth ********************************/



Route::prefix('auth')->group(function() {
    Route::post('signup', SignUpController::class);
    Route::post('signin', SignInController::class);
    Route::get('me', MeController::class);
    Route::post('signout', SignOutController::class);
});





Route::post('/notifications', [NotificationController::class, 'index']);
Route::post('/notifications/markAsRead', [NotificationController::class, 'markAsRead']);
