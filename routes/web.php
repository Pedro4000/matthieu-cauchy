<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{PhotoController, AlbumController, TypeController, DashboardController, CauchyController, AProposController, UserController};

/* |-------------------------------------------------------------------------- | Web Routes |-------------------------------------------------------------------------- | | Here is where you can register web routes for your application. These | routes are loaded by the RouteServiceProvider within a group which | contains the "web" middleware group. Now create something great! | */


Route::get('/', [CauchyController::class , 'home'])->name('home');

Route::get('/index', [CauchyController::class , 'index'])->name('index');

Route::get('/ajax-all', [CauchyController::class , 'ajax'])->name('ajax-gngn');

Route::get('/ccs/{album_nom}', [CauchyController::class , 'album'])
    ->name('album');

Route::get('/contact-store', [CauchyController::class , 'contact'])
    ->name('contact.form');

Route::get('/getcauchyimages', [CauchyController::class , 'getImages']);

Route::get('/welcome', function () {
    return view('welcome');
});


Route::middleware(['auth'])
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {

        Route::get('/', [DashboardController::class , 'dashboard'])
            ->name('dashboard');



        Route::get('photo-index/{album_id?}', [PhotoController::class , 'index'])
            ->name('photo.index');

        Route::get('photo-creer', [PhotoController::class , 'create'])
            ->name('photo.create');

        Route::post('photo-store', [PhotoController::class , 'store'])
            ->name('photo.store');

        Route::get('photo-show/{id}', [PhotoController::class , 'show'])
            ->name('photo.show');

        Route::get('photo-edit/{id}', [PhotoController::class , 'edit'])
            ->name('photo.edit');

        Route::post('photo-update', [PhotoController::class , 'update'])
            ->name('photo.update');

        Route::post('photo-destroy', [PhotoController::class , 'destroy'])
            ->name('photo.destroy');

        Route::post('photo-mass-edit', [PhotoController::class , 'massEdit'])
            ->name('photo.mass_edit');




        Route::get('/createfromstorage', [PhotoController::class , 'createFromStorage'])
            ->name('create_from_storage');




        Route::get('album-index', [AlbumController::class , 'index'])
            ->name('album.index');

        Route::get('album-creer', [AlbumController::class , 'create'])
            ->name('album.create');

        Route::post('album-store', [AlbumController::class , 'store'])
            ->name('album.store');

        Route::get('album-edit/{id}', [AlbumController::class , 'edit'])
            ->name('album.edit');

        Route::post('album-update', [AlbumController::class , 'update'])
            ->name('album.update');

        Route::post('album-destroy', [AlbumController::class , 'destroy'])
            ->name('album.destroy');




        Route::get('type-index', [TypeController::class , 'index'])
            ->name('type.index');

        Route::get('type-creer', [TypeController::class , 'create'])
            ->name('type.create');

        Route::post('store', [TypeController::class , 'store'])
            ->name('type.store');

        Route::get('type-edit/{id}', [TypeController::class , 'edit'])
            ->name('type.edit');

        Route::post('type-update', [TypeController::class , 'update'])
            ->name('type.update');

        Route::post('type-destroy', [TypeController::class , 'destroy'])
            ->name('type.destroy');




        Route::get('a-propos-index', [AProposController::class , 'index'])
            ->name('a_propos.index');

        Route::get('a-propos-create', [AProposController::class , 'create'])
            ->name('a_propos.create');

        Route::get('a-propos-edit/{id}', [AProposController::class , 'edit'])
            ->name('a_propos.edit');

        Route::post('a-propos-update', [AProposController::class , 'update'])
            ->name('a_propos.update');

        Route::post('a-propos-destroy', [AProposController::class , 'destroy'])
            ->name('a_propos.destroy');

        Route::post('a-propos-store', [AProposController::class , 'store'])
            ->name('a_propos.store');


        Route::resource('users', UserController::class);


});

require __DIR__ . '/auth.php';
