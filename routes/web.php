<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

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

/** 
 * Common Resource Routes - Naming convention
 * index - show all entries
 * show  - show single entry
 * create - show form to create entry
 * store - store new entry
 * edit - show form to edit entry
 * update - update the entry
 * destroy - delete an entry
*/

// all listings
Route::get('/', [ListingController::class, 'index']);

// show create listing form
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

// store new listing
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

// show edit form
Route::get('/listings/{id}/edit', [ListingController::class, 'edit'])->middleware('auth');

// update listing
Route::put('/listings/{id}', [ListingController::class, 'update'])->middleware('auth');

// delete listing
Route::delete('/listings/{id}/delete', [ListingController::class, 'destroy'])->middleware('auth');

// manage listing
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');

// single listing
Route::get('/listings/{id}', [ListingController::class, 'show']);

// show register form
Route::get('/users/register', [UserController::class, 'register'])->middleware('guest');

// store new user
Route::post('/users', [UserController::class, 'store']);

// logout
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// show login form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');

// login user
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

/* 
// Route Model binding - same as above
Route::get('/listings/{listing}', function(Listing $listing) {
    return view('listing', [
        'listing' => $listing,
    ]);
});
*/

/* 
// returning strings, manipulating status codes and headers
Route::get("hello", function () {
    return response("<h1>Hello World</h1>", 200)
        ->header("content-type", "text/plain")
        ->header("foo", "bar");
});

// passing params and adding some constraints
Route::get("/posts/{id}", function ($id) {
    return response("Post $id");
})->where("id", "[0-9]+");

// dealing with search params
Route::get("/search", function (Request $request) {
    return response("$request->name $request->age");
});
*/
