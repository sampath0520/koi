<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;

// ── Public ──────────────────────────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contact', [HomeController::class, 'contact'])->name('contact');

Route::get('/products/{category}', [ProductController::class, 'show'])->name('products.show');

Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// ── Auth ─────────────────────────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login',  [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ── Admin ────────────────────────────────────────────────────────────────────
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');

    Route::post('/products',             [AdminController::class, 'storeProduct'])->name('products.store');
    Route::put('/products/{product}',    [AdminController::class, 'updateProduct'])->name('products.update');
    Route::delete('/products/{product}', [AdminController::class, 'destroyProduct'])->name('products.destroy');

    Route::post('/posts',          [AdminController::class, 'storePost'])->name('posts.store');
    Route::put('/posts/{post}',    [AdminController::class, 'updatePost'])->name('posts.update');
    Route::delete('/posts/{post}', [AdminController::class, 'destroyPost'])->name('posts.destroy');

    Route::post('/gallery',                     [AdminController::class, 'storeGalleryImage'])->name('gallery.store');
    Route::put('/gallery/{galleryImage}',        [AdminController::class, 'updateGalleryImage'])->name('gallery.update');
    Route::delete('/gallery/{galleryImage}',     [AdminController::class, 'destroyGalleryImage'])->name('gallery.destroy');

    Route::patch('/contacts/{submission}/read',  [AdminController::class, 'markContactRead'])->name('contacts.read');
    Route::delete('/contacts/{submission}',      [AdminController::class, 'destroyContact'])->name('contacts.destroy');
});
