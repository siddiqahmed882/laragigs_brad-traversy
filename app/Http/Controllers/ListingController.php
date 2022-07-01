<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // get and show all listings
    public function index() {
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)
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

    // store new listing
    public function store(Request $request) {
        /**
         * $request->validate check for errors.
         *  if errors are found they are sent back to the view otherwise execution proceeds
         * you cal also use request function. request()->validate()
         */
        $formFields = $request->validate([
            'company' => ['required', Rule::unique('listings', 'company')],
            'title' => 'required',
            'location' => 'required',
            'email' => ['required', 'email'],
            'website' => 'required',
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->user()->id;

        Listing::create($formFields);
        return redirect('/', 201)->with('message', 'Listing successfully created');
    }

    // show edit form
    public function edit($id) {
        $listing = Listing::find($id);
        if(!$listing) abort(404);
        return view('listings.edit', [
            'listing' => $listing,
        ]);
    }

    // update the fields
    public function update($id, Request $request) {
        $listing = Listing::find($id);
        // make sure logged in user is owner'
        if($listing->user_id != auth()->id()) {
            abort(403, 'unauthorized action');
        }

        $formFields = $request->validate([
            'company' => ['required'],
            'title' => 'required',
            'location' => 'required',
            'email' => ['required', 'email'],
            'website' => 'required',
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formFields);

        return back()->with('message', 'updated successfully');
    }

    // delete listing
    public function destroy($id) {
        $listing = Listing::find($id);

        // make sure logged in user is owner'
        if($listing->user_id != auth()->id()) {
            abort(403, 'unauthorized action');
        }

        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted successfully');
    }

    // manage listings
    public function manage() {
        $user = auth()->user();
        $listings = $user->listings()->get();

        return view('listings.manage', [
            'listings' => $listings,
        ]);
    }
}
