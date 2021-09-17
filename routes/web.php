<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CauchyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\TypeController;

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


Route::get('/welcome', function () {
    return view('welcome');
});


Route::middleware(['auth'])
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])
        ->name('dashboard');

    Route::resources([
    'photo' => PhotoController::class,
    'album' => PostController::class,
    'type' => TypeController::class,
    ]);

    Route::get('/createFromStorage', [PhotoController::class, 'createFromStorage'])
        ->name('create_from_storage');


});

require __DIR__.'/auth.php';

