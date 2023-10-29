<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use App\Models\Sneaker;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all listings from the database that are not sold, that are active and approved by an admin
        $listings = Listing::where('listing_sold', false)->where('listing_active', true)->where('listing_approved', true)->get();
    
        return view('home', compact('listings'));
    }

    public function search(Request $request)
    {
        // Inputs from the search form
        $query = $request->input('query');
        $condition = $request->input('condition');

        // Filter all listing by the query
        $listings = Listing::where('listing_sold', false)
        ->where('listing_active', true)
        ->where('listing_approved', true)
        ->where(function($q) use ($query) {
            $q->whereRaw('LOWER(listing_title) ILIKE  ?', ["%$query%"])
                ->orWhereRaw('LOWER(listing_description) ILIKE  ?', ["%$query%"]);
        });

        // Filter all listing by the condition if it is not all
        if ($condition !== 'all' && $condition !== null) {
            $listings->where('listing_condition', $condition);
        }

        // Get all listings
        $listings = $listings->get();

        return view('home', compact('listings', 'query', 'condition'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        // Check if user is verified
        if (auth()->user()->is_verified == false){
            return redirect()->route('dashboard');
        }

        $sneaker = Sneaker::find($id);
    
        return view('listing.create', compact('sneaker'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {        
        // Validate data
        $validatedData = $request->validate([
            'listingtitle' => ['required', 'string', 'max:255'],
            'listingdescription' => ['required', 'string', 'max:255'],
            'listingprice' => ['required', 'integer', 'max:10000'],
            'listingcondition' => ['required', 'string', 'max:255'],
        ]);

        $user = auth()->user();

        $sneakerid = $request->sneakerid;

        $sneaker = $user->sneakers->find($sneakerid);

        // Add sneaker
        $sneaker->listing()->create([
            'listing_title' => $validatedData['listingtitle'],
            'listing_description' => $validatedData['listingdescription'],
            'listing_price' => $validatedData['listingprice'],
            'listing_originalprice' => $sneaker->sneaker_paidprice,
            'seller_id' => $user->id,
            'listing_sold' => false,
            "listing_active" => false,
            "listing_approved" => false,
            "listing_condition" => $validatedData["listingcondition"]
        ]);

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $listing = Listing::find($id);

        // Check if listing is approved by an admin and is active
        if ($listing-> listing_approved == false || $listing->listing_active == false){
            return redirect()->route('dashboard');
        }
    
        return view('listing.details', compact('listing'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $listing = Listing::find($id);

        // Check if user is the owner of the listing
        if (auth()->user()->id != $listing->seller_id){
            return redirect()->route('dashboard');
        }

        if ($listing-> listing_approved == false || $listing->listing_active == false){
            return redirect()->route('dashboard');
        }
    
        return view('listing.edit', compact('listing'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $listing = Listing::find($id);

        // Check if user is the owner of the listing
        if (auth()->user()->id != $listing->seller_id){
            return redirect()->route('dashboard');
        }

        // Validate data
        $validatedData = $request->validate([
            'listingtitle' => ['required', 'string', 'max:255'],
            'listingdescription' => ['required', 'string', 'max:255'],
            'listingprice' => ['required', 'integer', 'max:10000'],
            'listingcondition' => ['required', 'string', 'max:255'],
        ]);

        $listing->listing_title = $validatedData['listingtitle'];
        $listing->listing_description = $validatedData['listingdescription'];
        $listing->listing_price = $validatedData['listingprice'];
        $listing->listing_condition = $validatedData['listingcondition'];

        $listing->update();  

        return redirect('/dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $listing = Listing::find($id);

        $listing->delete();

        return redirect('/dashboard');
    }

    /**
     * Buy the specified listing by a other user
     */
    public function buy(string $id)
    {
        $listing = Listing::find($id);
        $userid = auth()->user()->id;

        // Makes the listing sold and adds the buyer id
        $listing->listing_sold = true;
        $listing->buyer_id = $userid;

        $listing->update();

        return redirect('/dashboard');
    }

    /**
     * Change the status of the listing to active or inactive
     */
    public function change_active(string $id)
    {
        $listing = Listing::find($id);

        // Sets the status of the listing to active or inactive
        if ($listing->listing_active == true) {
            $listing->listing_active = false;
        } else {
            $listing->listing_active = true;
        }

        $listing->update();

        return redirect('/dashboard');
    }

}
