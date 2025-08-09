<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PollController;
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


Route::middleware('guest')->group(function () {
    Route::view('/login', 'auth.login')->name('login');
    Route::view('/register', 'auth.register')->name('register');
});

Route::middleware(['web'])->group(function () {
    Route::get('', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::get('/polls/view/{public_id}', function ($public_id) {
    return view('polls.public_poll', ['public_id' => $public_id]);
});

Route::get('/polls/category/{id}', [PollController::class, 'categoryPage'])->name('polls.byCategory');
Route::get('/polls/user', [PollController::class, 'UserPollPage'])->name('polls.byUser');
Route::get('ping', function () {
    return 'Pong';
})->name('ping');