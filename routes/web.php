<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AlbumController, 
    AProposController, 
    CauchyController, 
    CommissionController,
    ContactController, 
    DashboardController, 
    PhotoController, 
    TypeController, 
    UserController
};

/* |-------------------------------------------------------------------------- | Web Routes |-------------------------------------------------------------------------- | | Here is where you can register web routes for your application. These | routes are loaded by the RouteServiceProvider within a group which | contains the "web" middleware group. Now create something great! | */


Route::get('/', [CauchyController::class , 'home'])
    ->name('home');
Route::get('/index', [CauchyController::class , 'index'])
    ->name('index');
Route::get('/ajax-all', [CauchyController::class , 'ajax'])
    ->name('ajax-gngn');
Route::get('/ccs/{albumName}', [CauchyController::class , 'album'])
    ->name('album');
Route::get('/contact-store', [CauchyController::class , 'contact'])
    ->name('contact.form');
Route::get('/getcauchyimages', [CauchyController::class , 'getImages']);
Route::get('/commissions', [CommissionController::class , 'show'])
    ->name('commissions');

Route::view('/gallery', 'gallery');
Route::view('/gallerybis', 'gallerybis');
Route::view('/galleryter', 'galleryter');

Route::middleware(['auth'])
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {

        Route::get('/', [DashboardController::class , 'dashboard'])
            ->name('dashboard');

        Route::get('photo-index/{album_id}', [PhotoController::class , 'index'])
            ->name('photo.index');
        Route::post('photo/upload', [PhotoController::class , 'upload'])
            ->name('photo.upload');
        Route::post('photo/delete', [PhotoController::class , 'delete'])
            ->name('photo.delete');
        Route::post('photo/cover-album', [PhotoController::class , 'coverAlbum'])
            ->name('photo.coverAlbum');
        Route::post('photo/cover-site', [PhotoController::class , 'coverSite'])
            ->name('photo.coverSite');
        Route::post('photo/save-order', [PhotoController::class , 'saveOrder'])
            ->name('photo.saveOrder');
        Route::post('photo/hide-photo', [PhotoController::class , 'hidePhoto'])
            ->name('photo.hidePhoto');

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
        Route::post('album-update/{id}', [AlbumController::class , 'update'])
            ->name('album.update');
        Route::post('album-destroy', [AlbumController::class , 'destroy'])
            ->name('album.destroy');
        Route::post('/albums/reorder', [AlbumController::class, 'reorder'])
            ->name('album.reorder');


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

        Route::get('/commission/index', [CommissionController::class, 'index'])
            ->name('commission.index');
        Route::post('/commission/upload', [CommissionController::class, 'upload'])
            ->name('commission.upload');
        Route::post('/commission/reorder', [CommissionController::class, 'reorder'])
            ->name('commission.reorder');
        Route::post('/commission/delete', [CommissionController::class, 'delete'])
            ->name('commission.delete');

        Route::get('/contact/edit', [ContactController::class, 'edit'])
            ->name('contact.edit');
        Route::put('/contact/update', [ContactController::class, 'update'])
            ->name('contact.update');
        Route::post('/contact/upload-image', [ContactController::class, 'uploadImage'])
            ->name('contact.upload-image');


        Route::resource('users', UserController::class);


});

require __DIR__ . '/auth.php';
