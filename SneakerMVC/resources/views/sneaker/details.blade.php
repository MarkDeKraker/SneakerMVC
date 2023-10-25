@extends('layouts.app')
@section('content')

<div class="container flex justify-center">
    <a href="{{ route('dashboard') }}" class="bg-black text-white p-2 rounded-lg">Back</a>	
    </div>
<div class="container mx-auto shadow-lg max-w-sm border-2 rounded-lg"> 
<img src="data:image/jpeg;base64,{{ $sneaker->sneaker_picture }}" alt="sneaker" class="w-full h-64 object-cover rounded-t-lg">
<div class="border-2"></div>

<div class="grid grid-cols-2 p-2">
    <div>                    
    <div class="font-medium">Brand:</div>      
        <div class="font-medium">Model:</div>
        <div class="font-medium">Size:</div> 
        <div class="font-medium">Paid price:</div>   
        <div class="font-medium">Color:</div>   
        <div class="font-medium">Stylecode:</div>    
        <div class="font-medium">Releasedate:</div>                              
    </div>
    <div >
    <p class="">{{ $sneaker->sneaker_brand }}</p>
        <p class="">{{ $sneaker->sneaker_model }}</p>
        <p class="">{{ $sneaker->sneaker_size }}</p>
        <p class="">€{{ $sneaker->sneaker_paidprice }}</p>
        <p class="">{{ $sneaker->sneaker_color }}</p>
        <p class="">{{ $sneaker->sneaker_stylecode }}</p>
        <p class="">{{ $sneaker->sneaker_releasedate }}</p>                
    </div>
</div>          
<div class="border-2"></div>
    <div class="p-2 flex justify-center space-x-2">
        <a class="p-2 bg-black text-white rounded-lg" href="{{ route("listing.create", $sneaker)}}">Create listing</a>
        <a class="bg-black text-white p-2 rounded-lg" href="{{ route("sneaker.edit", $sneaker)}}">Edit</a>
        <form action="{{ route('sneaker.destroy', $sneaker) }}" method="POST" enctype="multipart/form-data">
            @method('DELETE')
            @csrf
            <button class="bg-black text-white p-2 rounded-lg">Delete</button>
        </form>
        
    </div>
</div>

@endsection