<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Listing;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all listing that are not approved by an admin
        $listings = Listing::where('listing_approved', false )->where('listing_sold', false)->get();

        return view('admin-dashboard', compact('listings'));
    }

    /**
     * Approved the listing by an admin account
     */
    public function approve_listing(Listing $listing)
    {
        // Set listing to approved and active
        $listing->listing_approved = true;
        $listing->listing_active = true;
        $listing->save();
    
        return redirect('/admin-dashboard');
    }
    
    /**
     * Declines the listing by an admin account
     */
    public function decline_listing(Listing $listing)
    {
        // Delete listing that declines it automatically
        $listing->delete();
    
        return redirect('/admin-dashboard');
    }
}
