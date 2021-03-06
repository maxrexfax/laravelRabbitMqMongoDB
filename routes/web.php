<?php

use App\Http\Controllers\MessageController;
use App\Http\Controllers\RabbitController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('rabbitMessage/send', [RabbitController::class, 'sendText']);
Route::post('rabbitMessage/sendPost', [RabbitController::class, 'sendPost'])->name('rabbit.send.post');


Auth::routes();
Route::get('rabbitMessage/index', [RabbitController::class, 'index'])->name('rabbit.create.message');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/messages/index', [MessageController::class, 'index'])->name('messages.index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
