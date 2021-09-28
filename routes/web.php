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

    Route::get('photo-index/{album_id?}', [PhotoController::class, 'index'])
        ->name('photo.index');

    Route::get('photo-creer', [PhotoController::class, 'create'])
        ->name('photo.create');

    Route::post('/photo-store', [PhotoController::class, 'store'])
        ->name('photo.store');

    Route::get('photo-show/{id}', [PhotoController::class, 'show'])
        ->name('photo.show');

    Route::get('photo-edit/{id}', [PhotoController::class, 'edit'])
        ->name('photo.edit');

    Route::post('photo-update', [PhotoController::class, 'update'])
        ->name('photo.update');

    Route::post('photo-destroy', [PhotoController::class, 'destroy'])
        ->name('photo.destroy');



    Route::get('album-index', [AlbumController::class, 'index'])
        ->name('album.index');

    Route::get('album-creer', [AlbumController::class, 'create'])
        ->name('album.create');

    Route::post('album-store', [AlbumController::class, 'store'])
        ->name('album.store');

    Route::get('album-edit/{id}', [AlbumController::class, 'edit'])
        ->name('album.edit');

    Route::post('album-update', [AlbumController::class, 'update'])
        ->name('album.update');

    Route::get('album-destroy', [AlbumController::class, 'destroy'])
        ->name('album.destroy');



    Route::get('Type-index', [TypeController::class, 'index'])
        ->name('type.index');

    Route::get('Type-creer', [TypeController::class, 'create'])
        ->name('type.create');

    Route::post('store', [TypeController::class, 'store'])
        ->name('type.store');

    Route::get('Type-show', [TypeController::class, 'show'])
        ->name('type.show');

    Route::get('Type-edit', [TypeController::class, 'edit'])
        ->name('type.edit');

    Route::post('Type-update', [TypeController::class, 'update'])
        ->name('type.update');

    Route::get('Type-destroy', [TypeController::class, 'destroy'])
        ->name('type.destroy');

                             

    Route::get('/createFromStorage', [PhotoController::class, 'createFromStorage'])
        ->name('create_from_storage');


});

require __DIR__.'/auth.php';

