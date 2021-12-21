<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Dashboard\AdminCategoryController;
use App\Http\Controllers\Dashboard\DashboardPostController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

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
    return view('home');
});

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');

Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
// Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');

// Route::get('/authors/{author:username}', [AuthorController::class, 'show'])->name('authors.show');

Route::get('/about', function () {
    return view('about');
});

Route::get('/login', [AuthController::class, 'login'])->name('login.index');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout.store');
Route::get('/register', [AuthController::class, 'register'])->name('register.index');
Route::post('/register', [AuthController::class, 'store'])->name('register.store');

Route::post('/check-username', [AuthController::class, 'checkUsername'])->name('check.username');
Route::post('/check-email', [AuthController::class, 'checkEmail'])->name('check.email');

Route::get('/dashboard', function() {
    return view('dashboard.index');
    })->name('dashboard.index')->middleware('auth');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/dashboard/posts', [DashboardPostController::class, 'index'])->name('DPosts.index');
    Route::get('/dashboard/posts/{post:slug}', [DashboardPostController::class, 'show'])->name('DPosts.show');
    Route::get('/dashboard/post/create', [DashboardPostController::class, 'create'])->name('DPosts.create');
    Route::post('/dashboard/posts', [DashboardPostController::class, 'store'])->name('DPosts.store');
    Route::get('/dashboard/post/check_slug', [DashboardPostController::class, 'checkSlug'])->name('DPosts.checkSlug');
    Route::get('/dashboard/posts/{post:slug}/edit', [DashboardPostController::class, 'edit'])->name('DPosts.edit');
    Route::put('/dashboard/posts/{post:slug}', [DashboardPostController::class, 'update'])->name('DPosts.update');
    Route::delete('/dashboard/posts/{post:slug}', [DashboardPostController::class, 'destroy'])->name('DPosts.destroy');
});

Route::group(['middleware' => 'admin'], function() {
    Route::get('/dashboard/categories', [AdminCategoryController::class, 'index'])->name('DCategories.index');
});
