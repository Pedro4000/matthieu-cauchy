<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CauchyController;


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
Route::get('/', [CauchyController::class, 'home'])
    ->name('home');

Route::get('/index', [CauchyController::class, 'index'])
    ->name('index');

Route::get('/works', [CauchyController::class, 'works'])
    ->name('works');

Route::get('/works/{work}', [CauchyController::class, 'work'])
    ->name('work');

Route::get('/ajax-all', [CauchyController::class, 'ajax'])
    ->name('ajax-gngn');

Route::get('/getcauchyimages', [CauchyController::class, 'getImages']);



