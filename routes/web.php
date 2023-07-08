<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;

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


Route::get('/', [LinkController::class, 'index']);
Route::get('/shortened-links', [LinkController::class, 'shortenedlinks'])->name('shortened-links');
Route::post('/shorten', [LinkController::class, 'shorten'])->name('shorten');
Route::get('/{code}', [LinkController::class, 'redirect'])->name('redirect');

