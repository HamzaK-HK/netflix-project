<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MyListController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\API\SessionController;
use App\Http\Controllers\API\RegisteredController;
use App\Http\Controllers\AuthenticatedSessionController;

Route::get('/{any}', function () {
    return view('Welcome');
})->where('any', '^(?!api).*$');



// post routes
Route::post('/api/posts', [PostController::class, 'store'])->name('post.store');
Route::get('/api/getposts', [PostController::class, 'getposts'])->name('getposts');


// admin routes
Route::get('/admin', function () {
    return view('admin');
})->name('admin');

// category routes
Route::post('/category', [CategoryController::class, 'store'])->name('storecategory');
Route::get('/api/getcategory', [CategoryController::class, 'getcategory'])->name('getcategory');

// tv show routes
Route::get('/api/tvshows', [CategoryController::class, 'index'])->name('tvshow');


// moives routes
Route::get('/api/movies', [CategoryController::class, 'getmovies'])->name('movies');

// documentaries routes
Route::get('/api/documentaries', [CategoryController::class, 'getdocumentaries'])->name('getdocumentaries');


// mylist routes
Route::post('/api/mylist', [MyListController::class, 'store'])->name('mylist.store');
Route::get('/api/getmylist', [MyListController::class, 'getmylist'])->name('getmylist');


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
