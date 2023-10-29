@extends('layouts.app')
@section('content')

<div class="container mx-auto shadow-lg max-w-sm border-2 rounded-lg mt-5">
<div class="grid grid-cols-2 p-2">
    <div>                    
        <div class="font-medium">Title:</div>      
        <div class="font-medium">Description:</div>
        <div class="font-medium">Price:</div>
        <div class="font-medium">Condition:</div>                                       
    </div>
    <div >
        <p class="">{{ $listing->listing_title }}</p>
        <p class="">{{ $listing->listing_description }}</p>
        <p class="">{{ $listing->listing_price }}</p>
        <p>{{ $listing->listing_condition == "unworn" ? "Unworn" : "Worn" }}</p>        
    </div>
</div>          
<div class="border-2"></div>
    <div class="p-2 flex justify-center space-x-2">
        @guest
            <p class="text-center">You need to be authenticated to purchase an sneaker</p>
        @endguest

        @auth
        @if (Auth::user()->id == $listing->seller_id)
        <p class="text-center">You can't purchase your own sneaker</p>
        @endif

        @if (Auth::user()->id != $listing->seller_id)
        <form action="{{ route('listing.buy', $listing) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <button class="p-2 bg-black text-white rounded-lg">Buy sneaker</button>
        </form>
         @endif               
        @endauth
    </div>
</div>

@endsection