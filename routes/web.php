<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;
use PhpParser\Node\Expr\List_;

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
Route::get('/listings/create', [ListingController::class, 'create']);

// single listing
Route::get('/listings/{id}', [ListingController::class, 'show']);

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
