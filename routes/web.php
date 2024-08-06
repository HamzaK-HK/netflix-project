<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MyListController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\PaymentController;
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


// post plan
Route::post('/api/plans', [PlanController::class, 'store'])->name('plans.store');
Route::get('/api/getplans', [PlanController::class, 'getplans'])->name('getplans');



Route::post('/api/create-payment-intent', [StripeController::class, 'createPaymentIntent']);

Route::get('/api/getplansdetails', [StripeController::class, 'getplans'])->name('getplans');


Route::post('/webhooks/stripe', [StripeController::class, 'get']);



Route::post('/payments', [PaymentController::class, 'store'])->name('payment.store');

Route::get('/api/getproduct/{priceId}', [PaymentController::class, 'getProduct'])->name('getproduct');



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
