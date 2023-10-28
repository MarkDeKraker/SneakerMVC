<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use App\Models\Sneaker;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SneakerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sneakers = Sneaker::where('user_id', auth()->user()->id)->get();
        $listings = Listing::where('seller_id', auth()->user()->id, )->where('listing_sold', false)->get();
        $sales = Listing::where('listing_sold', true)->where('seller_id', auth()->user()->id, )->get();
        $purchases = Listing::where('buyer_id', auth()->user()->id)->get();

        return view('dashboard', compact('sneakers', 'listings', 'sales', 'purchases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sneaker.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'sneakerbrand' => ['required', 'string', 'max:255'],
            'sneakermodel' => ['required', 'string', 'max:255'],
            'sneakercolor' => ['required', 'string', 'max:255'],
            'sneakersize' => ['required', 'integer', 'max:255'],
            'sneakerreleasedate' => ['required', 'date', 'max:255'],
            'sneakerstylecode' => ['required', 'string', 'max:255'],
            'sneakerpaidprice' => ['required', 'integer', 'max:255'],
            'sneakerpicture' => ['required', 'file', 'max:255'],   
        ]);

        $sneakerimage = base64_encode(file_get_contents($request->file('sneakerpicture')->getRealPath()));

        auth()->user()->sneakers()->create([
            'sneaker_brand' => $validatedData['sneakerbrand'],
            'sneaker_model' => $validatedData['sneakermodel'],
            'sneaker_color' => $validatedData['sneakercolor'],
            'sneaker_size' => $validatedData['sneakersize'],
            'sneaker_releasedate' => $validatedData['sneakerreleasedate'],
            'sneaker_stylecode' => $validatedData['sneakerstylecode'],
            'sneaker_paidprice' => $validatedData['sneakerpaidprice'],
            'sneaker_picture' => $sneakerimage,
        ]);

        // Verify user if 5 sneakers are added to their account, this enabled creating listings.
        $sneakerCount = Sneaker::where('user_id', auth()->user()->id)->count();

        if (auth()->user()->is_verified === false && $sneakerCount === 5) {
            $user = User::find(auth()->user()->id);
            $user->is_verified = true;
            $user->save();
        }

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sneaker = Sneaker::find($id);

        if (auth()->user()->id != $sneaker->user_id){
            return redirect()->route('dashboard');
        }
    
        return view('sneaker.details', compact('sneaker'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sneaker = Sneaker::find($id);
    
        if (auth()->user()->id != $sneaker->user_id){
            return redirect()->route('dashboard');
        }

        return view('sneaker.edit', compact('sneaker'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sneaker = Sneaker::find($id);

        if (auth()->user()->id != $sneaker->user_id){
            return redirect()->route('dashboard');
        }

        $validatedData = $request->validate([
            'sneakerbrand' => ['required', 'string', 'max:255'],
            'sneakermodel' => ['required', 'string', 'max:255'],
            'sneakercolor' => ['required', 'string', 'max:255'],
            'sneakersize' => ['required', 'integer', 'max:255'],
            'sneakerreleasedate' => ['required', 'date', 'max:255'],
            'sneakerstylecode' => ['required', 'string', 'max:255'],
            'sneakerpaidprice' => ['required', 'integer', 'max:255'],
            'sneakerpicture' => ['required', 'file', 'max:255'],   
        ]);

        $sneakerimage = base64_encode(file_get_contents($request->file('sneakerpicture')->getRealPath()));

        $sneaker->sneaker_brand = $validatedData['sneakerbrand'];
        $sneaker->sneaker_model = $validatedData['sneakermodel'];
        $sneaker->sneaker_color = $validatedData['sneakercolor'];
        $sneaker->sneaker_size = $validatedData['sneakersize'];
        $sneaker->sneaker_releasedate = $validatedData['sneakerreleasedate'];
        $sneaker->sneaker_stylecode = $validatedData['sneakerstylecode'];
        $sneaker->sneaker_paidprice = $validatedData['sneakerpaidprice'];
        $sneaker->sneaker_picture = $sneakerimage;
    
        $sneaker->update();  

        return redirect('/dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sneaker = Sneaker::find($id);

        if (auth()->user()->id != $sneaker->user_id){
            return redirect()->route('dashboard');
        }

        $sneaker->delete();

        return redirect('/dashboard');
    }
}
