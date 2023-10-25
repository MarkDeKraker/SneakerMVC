@extends('layouts.app')
@section('content')

<div class="container mx-auto shadow-lg mt-10 p-2">
    <p class="font-medium text-xl">Marketplace</p>
    <div class="bg-white grid grid-cols-4 gap-2">
        @if (count($listings) == 0)
            <p class="">There are no listings</p>
        @else
            @foreach ($listings as $listing)
            <div class="border-2 max-w-xs rounded-lg p-2">
                <div class="grid grid-cols-2">
                    <div>
                        <p>Title: {{ $listing->listing_title }}</p>
                        <p>Description: {{ $listing->listing_description }}</p>
                        <p>Price: {{ $listing->listing_price }}</p>
                    </div>
                </div>
                <div class="my-2">
                    <a class="bg-black text-white p-2 rounded-lg" href="{{ route("listing.show", $listing)}}">Details</a>
                </div>
            </div>
            @endforeach
        @endif
        </div>

@endsection