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
        $listings = Listing::where('listing_sold', false)->where('listing_active', true)->get();
    
        return view('home', compact('listings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
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
            'listingprice' => ['required', 'integer', 'max:255'],
        ]);

        // $sneakerimage = base64_encode(file_get_contents($request->file('sneakerpicture')->getRealPath()));

        // De ingelogde gebruiker ophalen
        $user = auth()->user();

        $sneakerid = $request->sneakerid;

        // Vind de juiste sneaker van de gebruiker, bijvoorbeeld op basis van een sneaker-id
        $sneaker = $user->sneakers->find($sneakerid);

        if ($sneaker) {
            // Een nieuwe listing aanmaken voor de gevonden sneaker
            $sneaker->listing()->create([
                'listing_title' => $validatedData['listingtitle'],
                'listing_description' => $validatedData['listingdescription'],
                'listing_price' => $validatedData['listingprice'],
                'listing_originalprice' => $sneaker->sneaker_paidprice,
                'seller_id' => $user->id,
                'listing_sold' => false,
                "listing_active" => true,
            ]);
        } else {
            // Handel het geval af waarin de opgegeven sneaker niet bestaat
        }


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
    
        return view('listing.edit', compact('listing'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $listing = Listing::find($id);

        $validatedData = $request->validate([
            'listingtitle' => ['required', 'string', 'max:255'],
            'listingdescription' => ['required', 'string', 'max:255'],
            'listingprice' => ['required', 'integer', 'max:255'],
        ]);

        $listing->listing_title = $validatedData['listingtitle'];
        $listing->listing_description = $validatedData['listingdescription'];
        $listing->listing_price = $validatedData['listingprice'];

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
