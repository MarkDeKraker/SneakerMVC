@extends('layouts.app')
@section('content')

<div class="container mx-auto">
    <h1 class="font-medium text-2xl my-2">My Admin Dashboard</h1>
    </div>
    <div class="container mx-auto shadow-lg mt-10 p-2">
        <p class="font-medium text-xl">To approve</p>
    <div class="bg-white grid grid-cols-4 gap-2">
    
    @if (count($listings) == 0)
        <p class="">You have no listings to approve</p>
    @else
        @foreach ($listings as $listing)
        <div class="border-2 max-w-xs rounded-lg p-2">
    
            <div class="grid grid-cols-4">
                <div class="col-span-2">
                    <p class="font-medium">Title: </p>
                    <p class="font-medium">Description: </p>
                    <p class="font-medium">Listed for: </p>
                </div>
                <div class="col-span-2">
                    <p>{{ $listing->listing_title }}</p>
                    <p>{{ $listing->listing_description }}</p>
                    <p>€{{ $listing->listing_price }}</p>
                </div>
            </div>
            <div class="my-2">
                <div class="flex space-x-2">
                    <form action="{{ route('admin.approve_listing', $listing) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <button class="bg-black text-white p-2 rounded-lg">Approve</button>
                    </form>
                    <form action="{{ route('admin.decline_listing', $listing) }}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <button class="bg-black text-white p-2 rounded-lg">Decline</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    @endif
    </div>
    </div>
    </div>

@endsection