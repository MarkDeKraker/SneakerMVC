<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sneaker; 

class SneakerController extends Controller
{

    public function sneaker($id)
    {
        $sneaker = Sneaker::find($id);
    
        return view('sneaker.sneaker', compact('sneaker'));
    }

    public function sneakers()
    {
        $sneakers = Sneaker::where('user_id', auth()->user()->id)->get();
    
        return view('dashboard', compact('sneakers'));
    }

    public function create(Request $request)
    {
        $sneakerimage = base64_encode(file_get_contents($request->file('sneakerpicture')->getRealPath()));


        error_log($request);

        auth()->user()->sneakers()->create([
            'sneaker_brand' => $request['sneakerbrand'],
            'sneaker_model' => $request['sneakermodel'],
            'sneaker_color' => $request['sneakercolor'],
            'sneaker_size' => $request['sneakersize'],
            'sneaker_releasedate' => $request['sneakerreleasedate'],
            'sneaker_stylecode' => $request['sneakerstylecode'],
            'sneaker_paidprice' => $request['sneakerpaidprice'],
            'sneaker_picture' => $sneakerimage,
        ]);

        return redirect()->route('dashboard');
    }

    
}
