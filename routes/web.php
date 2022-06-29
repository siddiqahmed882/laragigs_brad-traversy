<?php

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
    return view('listings', [
        'listings' => Listing::all()
    ]);
});

// single listing
Route::get('/listings/{id}', function($id) {
    $listing = Listing::find($id);
    if ($listing) {
        return view('listing', [
            'listing' => $listing,
        ]);
    }
    abort(404);
});

/* 
// Route Model binding
// same as above
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
