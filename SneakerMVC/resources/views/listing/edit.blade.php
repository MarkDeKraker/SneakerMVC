@extends('layouts.app')
@section('content')

<div class="container mx-auto flex justify-center m-5">
  <form class="w-[500px] shadow-lg p-5" action="{{ route('listing.update', $listing) }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf    
    <input value="{{ $listing->id }}" type="hidden" name="sneakerid" id="sneakerid" class="bg-gray-50 border border-gray-300" required>
    <p class="font-bold text-xl text-center mt-2">Update your listing</p>
    <div class="mb-6">
        <label for="listingtitle" class="block mb-2 text-sm font-medium">Title</label>
        <input value="{{ $listing->listing_title }}" type="text" name="listingtitle" id="listingtitle" class="bg-gray-50 border border-gray-300" required>
        @error('listingtitle')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-6">
        <label for="listingdescription" class="block mb-2 text-sm font-medium">Description</label>
        <textarea name="listingdescription" id="listingdescription" class="bg-gray-50 border border-gray-300" required>{{ $listing->listing_description }}</textarea>
        @error('listingdescription')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-6">
        <label for="listingprice" class="block mb-2 text-sm font-medium">Price</label>
        <input value="{{ $listing->listing_price }}" type="number" name="listingprice" id="listingprice" class="bg-gray-50 border border-gray-300" required>
        @error('listingprice')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-6">
        <label for="listingcondition" class="block mb-2 text-sm font-medium">Type</label>
        <select name="listingcondition" class="rounded-md" required>
            <option value="unworn" {{ $listing->listing_condition === "unworn" ? "selected" : "" }}>Unworn</option>
            <option value="worn" {{ $listing->listing_condition === "worn" ? "selected" : "" }}>Worn</option>
        </select>
        @error('listingcondition')
            <p class="text-red-500 text-sm">{{ $message }}</p>
        @enderror
    </div>
    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
</form>
    </div>



@endsection