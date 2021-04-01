<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Models\User;

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

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/search', [SearchController::class, 'search'])->name('auction.search');

// guest (not login)
Route::middleware(['guest'])->group(function () {
    Route::get('/register', [AuthController::class, 'getSignup'])->name('register');
    Route::post('/register', [AuthController::class, 'postSignup'])->name('register');
    Route::get('/login', [AuthController::class, 'getSignin'])->name('login');
    Route::post('/login', [AuthController::class, 'postSignin'])->name('login');
    Route::get('/login/passwordResetForm', [AuthController::class, 'passwordResetForm'])->name('password.email');
    Route::post('/login/passwordReset', [AuthController::class, 'passwordReset'])->name('password.reset');
});



// general  Content
Route::get('/{pageContent}',  [HomeController::class, 'content'])->name('content');
/*
Route::get('/testpusher', function () {
    return view('test.pusher');
});


Route::get('/testpusher_privat', function () {
    auth()->login(User::first());
    return view('test.pusher_privat');
});


/*
Route::get('/testpusher', [TestController::class, 'testpusher']);


Route::get('/testpusher_privat', function () {
    auth()->login(User::first());
    return view('test.pusher_privat');
});
*/
