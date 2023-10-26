<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use App\Models\Sneaker;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listings = Listing::where('listing_approved', false )->where('listing_sold', false)->get();

        return view('admin-dashboard', compact('listings'));
    }

    public function approve_listing(Listing $listing)
    {
        $listing->listing_approved = true;
        $listing->listing_active = true;
        $listing->save(); // Gebruik save() om het model op te slaan
    
        return redirect('/admin-dashboard');
    }
    
    public function decline_listing(Listing $listing)
    {
        $listing->delete();
    
        return redirect('/admin-dashboard');
    }
}
