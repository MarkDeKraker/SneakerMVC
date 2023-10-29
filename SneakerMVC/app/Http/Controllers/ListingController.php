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
        $listings = Listing::where('listing_sold', false)->where('listing_active', true)->where('listing_approved', true)->get();
    
        return view('home', compact('listings'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $condition = $request->input('condition');

        $listings = Listing::where('listing_sold', false)
        ->where('listing_active', true)
        ->where('listing_approved', true)
        ->where(function($q) use ($query) {
            $q->whereRaw('LOWER(listing_title) ILIKE  ?', ["%$query%"])
                ->orWhereRaw('LOWER(listing_description) ILIKE  ?', ["%$query%"]);
        });

        if ($condition !== 'all' && $condition !== null) {
            $listings->where('listing_condition', $condition);
        }

        $listings = $listings->get();

        return view('home', compact('listings', 'query', 'condition'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
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
        $validatedData = $request->validate([
            'listingtitle' => ['required', 'string', 'max:255'],
            'listingdescription' => ['required', 'string', 'max:255'],
            'listingprice' => ['required', 'integer', 'max:10000'],
            'listingcondition' => ['required', 'string', 'max:255'],
        ]);

        $user = auth()->user();

        $sneakerid = $request->sneakerid;

        $sneaker = $user->sneakers->find($sneakerid);

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
    
        return view('listing.details', compact('listing'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $listing = Listing::find($id);

        if (auth()->user()->id != $listing->seller_id){
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

        if (auth()->user()->id != $listing->seller_id){
            return redirect()->route('dashboard');
        }

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

    public function buy(string $id)
    {
        $listing = Listing::find($id);
        $userid = auth()->user()->id;

        $listing->listing_sold = true;
        $listing->buyer_id = $userid;

        $listing->update();

        return redirect('/dashboard');
    }

    public function change_active(string $id)
    {
        $listing = Listing::find($id);

        if ($listing->listing_active == true) {
            $listing->listing_active = false;
        } else {
            $listing->listing_active = true;
        }

        $listing->update();

        return redirect('/dashboard');
    }

}
