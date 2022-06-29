<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    // get and show all listings
    public function index() {
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->get()
        ]);
    }

    // get and show single listing
    public function show($id) {
        $listing = Listing::find($id);
        if (!$listing) abort(404);
        return view('listings.show', [
            'listing' => $listing,
        ]);       
    }

    // show create form
    public function create() {
        return view('listings.create');
    }
}
