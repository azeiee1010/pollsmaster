<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PollController;
use App\Http\Controllers\Api\VoteController;


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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:api')->group(function () {
    Route::get('/user', [AuthController::class, 'getUser']);
    Route::post('/logout', [AuthController::class, 'logout']);
});


Route::middleware('auth:api')->group(function () {
    Route::post('/polls', [PollController::class, 'store']);
    Route::post('/polls/{id}/close', [PollController::class, 'closePoll']);
});


Route::get('/polls', [PollController::class, 'index']);
Route::get('/polls/active', [PollController::class, 'active']);
Route::get('/polls/{id}', [PollController::class, 'show']);

Route::post('/polls/vote', [VoteController::class, 'store']);

// Route::get('/polls/{id}/results', [PollController::class, 'pollResults']);
Route::get('/polls/public/{public_id}', [PollController::class, 'publicPoll']);
Route::get('/polls/{poll}/results', [PollController::class, 'results']);
Route::post('/polls/{public_id}/vote', [VoteController::class, 'vote']);
Route::get('/polls/category/{id}', [PollController::class, 'getByCategory']);
