<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrackingController;

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

Auth::routes();

Route::get('log', [TrackingController::class, 'store']);

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/add-user', [App\Http\Controllers\HomeController::class, 'addUser'])->name('add-user');
    Route::get('/edit-user/{user}', [App\Http\Controllers\HomeController::class, 'editUser'])->name('edit-user');
    Route::post('/user', [App\Http\Controllers\UserController::class, 'store']);
    Route::post('/user/{user}', [App\Http\Controllers\UserController::class, 'update']);
});
