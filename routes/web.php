<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\API\RegisteredController;
use App\Http\Controllers\API\SessionController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\CategoryController;

Route::get('/{any}', function () {
    return view('Welcome');
})->where('any', '.*');



Route::post('/posts', [PostController::class, 'store'])->name('post.store');

Route::get('/getposts', [PostController::class, 'getposts'])->name('getposts');


// admin routes
Route::get('/admin', function () {
    return view('admin');
})->name('admin');

Route::post('/category', [CategoryController::class, 'store'])->name('storecategory');
// Route::get('/getcategory', [CategoryController::class, 'index'])->name('getcategory');
// Route::get('/categoryFetch', [CategoryController::class, 'index'])->name('getcategory');

Route::get('/getcategory', [CategoryController::class])->name('getcategory');

// Route::get('/home', [PostController::class, 'index'])->name('home');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [RegisteredController::class, 'storeUser'])->name('register');

// Route::get('login', [AuthenticatedSessionController::class, 'create'])
// ->name('login');

Route::post('login', [SessionController::class, 'store']);

Route::post('logout', [SessionController::class, 'destroy'])
    ->name('logout');



// Route::get('/', function () {
//     return Inertia::render('Welcome');
// })->name('welcome');

// Route::get('/home', function () {
//     return Inertia::render('Home');
// })->middleware(['auth', 'verified'])->name('home');

// Route::get('/home', function () {
//     Inertia::render('Home');
// })->name('home');

// Route::get('/getposts', [PostController::class,'getposts'])->name('getposts');

// // admin routes
// Route::middleware('auth')->group(function () {
//     Route::get('/admin', function () {
//         return Inertia::render('Admin');
//     })->name('admin');

// });
