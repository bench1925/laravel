<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\SongController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth'])->group(function () {
  Route::get('/', [SongController::class, 'getAllSongs'])->name('home');
  Route::get('/music/play/{id}', [SongController::class, 'play'])->name('play');
  Route::get('/music/random', [SongController::class, 'randomSong'])->name('random');
});


Route::get('/', [SongController::class, 'getAllSongs'])->name('home');
Route::get('/login', [AuthManager::class,  'login'])->name('login');
Route::post('/login', [AuthManager::class,  'loginPost'])->name('login.post');
Route::get('/registration',  [AuthManager::class,  'registration'])->name('registration');
Route::post('/registration',  [AuthManager::class,  'registrationPost'])->name('registration.post');
Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');

