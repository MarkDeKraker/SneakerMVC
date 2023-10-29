@extends('layouts.app')
@section('content')

<div class="container mx-auto shadow-lg mt-10 p-2">
    <p class="font-medium text-xl">Marketplace</p>
    <div class="mt-4 mb-4">
        <form action="{{ route('listing.search') }}" method="GET">
            <select name="condition" class="rounded-md">
                <option value="all" {{ $condition == 'all' ? 'selected' : '' }}>All</option>
                <option value="unworn" {{ $condition == 'unworn' ? 'selected' : '' }}>Unworn</option>
                <option value="worn" {{ $condition == 'worn' ? 'selected' : '' }}>Worn</option>
            </select>
            <input class="rounded-md" type="text" name="query" placeholder="Search listings..." value="{{ $query == "" ? "" : $query }}">
            <button type="submit" class="bg-black text-white p-2 rounded-lg" >Search</button>
            <a href="/" class="bg-black text-white p-2.5 rounded-lg">Clear</a>
        </form>
    </div>

    <div class="bg-white grid grid-cols-4 gap-2">
        @if (count($listings) == 0)
            <p class="">There are no listings</p>
        @else
            @foreach ($listings as $listing)
            <div class="border-2 max-w-xs rounded-lg p-2">
                <div class="grid grid-cols-4">
                    <div class="col-span-2">
                        <p class="font-medium">Title: </p>
                        <p class="font-medium">Description: </p>
                        <p class="font-medium">Condition: </p>
                        <p class="font-medium">Price: </p>
                    </div>
                    <div class="col-span-2">
                        <p>{{ $listing->listing_title }}</p>
                        <p>{{ $listing->listing_description }}</p>
                        <p>{{ $listing->listing_condition == "unworn" ? "Unworn" : "Worn" }}</p>
                        <p>€{{ $listing->listing_price }}</p>
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