@extends('layouts.app')
@section('content')

<div class="container mx-auto">
<h1 class="font-medium text-2xl my-2">My Dashboard</h1>
</div>
<div class="container mx-auto shadow-lg mt-5 p-2">
    <p class="font-medium text-xl">Sneakers</p>
<div class="bg-white grid grid-cols-4 gap-2">
@if (count($sneakers) == 0)
    <p class="">You have no sneakers yet</p>
@else
    @foreach ($sneakers as $sneaker)
    <div class="border-2 max-w-xs rounded-lg p-2 hover:shadow-lg cursor-pointer">
        <div class="grid grid-cols-4">
            <div class="col-span-2">
                <p class="font-medium">Brand: </p>
                <p class="font-medium">Model: </p>
                <p class="font-medium">Color: </p>
            </div>
            <div class="col-span-2">
                <p>{{ $sneaker->sneaker_brand }}</p>
                <p>{{ $sneaker->sneaker_model }}</p>
                <p>{{ $sneaker->sneaker_color }}</p>
            </div>
        </div>
        <div class="my-2">
            @if (Auth::user()->is_verified == true)
                <a class="bg-black text-white p-2 rounded-lg" href="{{ route("listing.create", $sneaker)}}">Create listing</a>
            @endif
            <a class="bg-black text-white p-2 rounded-lg" href="{{ route("sneaker.show", $sneaker)}}">Details</a>
        </div>
    </div>
    @endforeach
@endif
</div>
   
</div>
<div class="container mx-auto shadow-lg mt-10 p-2">
    <p class="font-medium text-xl">Listings</p>
<div class="bg-white grid grid-cols-4 gap-2">

@if (Auth::user()->is_verified == false)
    <p class="text-red-500">Add 5 sneakers to your account sneakers before you can create listings.</p>
@elseif (count($listings) == 0)
    <p class="">You have no listings yet</p>
@else
    @foreach ($listings as $listing)
    <div class="border-2 max-w-xs rounded-lg p-2">

        <div class="grid grid-cols-4">
            <div class="col-span-2">
                <p class="font-medium">Title: </p>
                <p class="font-medium">Description: </p>
                <p class="font-medium">Listed for: </p>
                <p class="font-medium">Active: </p>
            </div>
            <div class="col-span-2">
                <p>{{ $listing->listing_title }}</p>
                <p>{{ $listing->listing_description }}</p>
                <p>€{{ $listing->listing_price }}</p>
                @if ($listing->listing_approved == true)
                <label class="relative my-auto items-center cursor-pointer">
                    <form action="{{ route('listing.change_active', $listing) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <input {{ $listing->listing_active ? 'checked' : '' }} onchange="this.form.submit()" type="checkbox" class="sr-only peer">
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:bg-green-400 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-400"></div>
                    </form>
                </label>
                @else
                <p class="text-red-500">Awaiting approval by a admin</p>
                @endif
            </div>
        </div>
        @if ($listing->listing_approved == true)
        <div class="my-2">
            <div class="flex space-x-2">
                <a class="bg-black text-white p-2 rounded-lg" href="{{ route("listing.show", $listing)}}">Show listing</a>
                <a class="bg-black text-white p-2 rounded-lg" href="{{ route("listing.edit", $listing)}}">Edit</a>
                <form action="{{ route('listing.destroy', $listing) }}" method="POST" enctype="multipart/form-data">
                    @method('DELETE')
                    @csrf
                    <button class="bg-black text-white p-2 rounded-lg">Delete</button>
                </form>
            </div>
        </div>
        @endif
    </div>
    @endforeach
@endif
</div>
   
</div>
<div class="container mx-auto shadow-lg mt-10 p-2">
    <p class="font-medium text-xl">Sales</p>
<div class="bg-white grid grid-cols-4 gap-2">

@if (count($sales) == 0)
    <p class="">You have no sales yet</p>
@else
    @foreach ($sales as $sale)
    <div class="border-2 max-w-xs rounded-lg p-2 hover:shadow-lg cursor-pointer">
        <div class="grid grid-cols-4">
            <div class="col-span-2">
                <p class="font-medium">Title: </p>
                <p class="font-medium">Description: </p>
                <p class="font-medium">Sold for: </p>
            </div>
            <div class="col-span-2">
                <p>{{ $sale->listing_title }}</p>
                <p>{{ $sale->listing_description }}</p>
                <p>€{{ $sale->listing_price }} <span class="text-green-400">+{{ number_format(($sale->listing_price - $sale->listing_originalprice) / $sale->listing_originalprice * 100, 2) }}%</span></p>
            </div>
        </div>
        {{-- <div class="my-2">
            <a class="bg-black text-white p-2 rounded-lg" href="{{ route("sneaker.show", $sale)}}">Details</a>
        </div> --}}
    </div>
    @endforeach
@endif
</div>
   
</div>
<div class="container mx-auto shadow-lg mt-10 p-2">
    <p class="font-medium text-xl">Purchases</p>
<div class="bg-white grid grid-cols-4 gap-2">

@if (count($purchases) == 0)
    <p class="">You have no purchases yet</p>
@else
    @foreach ($purchases as $purchase)
    <div class="border-2 max-w-xs rounded-lg p-2 hover:shadow-lg cursor-pointer">
        <div class="grid grid-cols-4">
            <div class="col-span-2">
                <p class="font-medium">Title: </p>
                <p class="font-medium">Description: </p>
                <p class="font-medium">Bought for: </p>
            </div>
            <div class="col-span-2">
                <p>{{ $purchase->listing_title }}</p>
                <p>{{ $purchase->listing_description }}</p>
                <p>€{{ $purchase->listing_price }}</p>
            </div>
        </div>
    </div>
    @endforeach
@endif
</div>
   
</div>
</div>


@endsection