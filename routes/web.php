<?php

use App\Http\Controllers\AlbumsController;
use App\Http\Controllers\PhotosController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;


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
    return view('auth.login');
});


// Path: routes\web.php

Route::get('/albums', [AlbumsController::class, 'index']);
Route::get('/albums/create', [AlbumsController::class, 'create'])->name('albums.create');
Route::get('/albums/{album}', [AlbumsController::class, 'show'])->name('albums.show');
Route::post('/albums', [AlbumsController::class, 'store'])->name('albums.store');
Route::delete('/albums/{id}', [AlbumsController::class, 'destroy'])->name('albums.destroy');


Route::get('/photo/upload/{album_id}', [PhotosController::class, 'create'])->name('photos.create');
Route::post('/photo/upload', [PhotosController::class, 'store'])->name('photos.store');
Route::get('/photo/{photo}', [PhotosController::class, 'show'])->name('photos.show');
Route::delete('/photo/{id}', [PhotosController::class, 'destroy'])->name('photos.destroy');


// Rute untuk toggle like
Route::post('/albums/{photo}/toggle-like', [LikeController::class, 'toggle'])->name('likes.toggle');

// Rute untuk memeriksa status like
Route::get('/albums/{photo}/check-like', [LikeController::class, 'checkLike'])->name('likes.check');


// rute login logout
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// rute register
Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/register', [AuthController::class, 'store'])->name('auth.store');

// Route::post('/photos/{photo}/like', [LikeController::class, 'toggle'])->name('likes.toggle');
Route::post('/photos/{photo}/comments', [CommentController::class, 'store'])->name('comments.store');

Route::get('/liked-photos', 'LikedPhotoController@index')->name('liked_photos.index');
