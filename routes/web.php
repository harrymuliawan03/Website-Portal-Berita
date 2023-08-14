<?php

use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryDetailController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\DashboardTrafficController;
use App\Http\Controllers\HomeController;

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

Route::get('/', [HomeController::class, 'index']);

Route::get('/about', function () {
    return view('about', [
        "title" => "About",
        "active" => "about",
        "name" => "Harry Muliawan",
        "email" => "harrymuliawan@gmail.com",
        "image" => "harry.jpg"
    ]);
});

// Halaman single Post
Route::get('posts/{post:slug}', [PostController::class, 'show']);
Route::get('/posts', [PostController::class, 'index']);


// Halaman Postingan berdasarkan Category
Route::get('category/{category:category_name}', [CategoryController::class, 'show']);

// Halaman Postingan berdasarkan Sub-Category
Route::get('sub_category/{categoryDetail:category_detail_name}', [CategoryDetailController::class, 'show']);


Route::get('/category', function () {
    return view('categories', [
        'title' => 'Post Categories',
        "active" => "category",
        'categories' => Category::all()
    ]);
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);

Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::resource('/user', DashboardUserController::class)->middleware('auth');

Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug'])->middleware('auth');
Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');

Route::get('/categories', [CategoryDetailController::class, 'category'])->name('category.index')->middleware('auth');
Route::get('/subcategory/{id}', [CategoryDetailController::class, 'category_detail'])->middleware('auth');


Route::get('/dashboard/traffic', [DashboardTrafficController::class, 'index'])->middleware('auth');

Route::get('/dashboard/categories/checkSlug', [AdminCategoryController::class, 'checkSlug'])->middleware('admin');
Route::resource('/dashboard/categories', AdminCategoryController::class)->middleware('admin');

// Halaman category
// Route::get('/categories/{category:slug}', function (Category $category) {
//     return view('posts', [
//         'title' => "Post by Category $category->name",
//         "active" => "category",
//         'posts' => $category->posts->load('category', 'author'),
//     ]);
// });

// Halaman Author 
// Route::get('/authors/{author:username}', function (User $author) {
//     return view('posts', [
//         'title' => "Post By Author : $author->name",
//         "active" => "blog",
//         'posts' => $author->posts->load('category', 'author'),
//     ]);
// });