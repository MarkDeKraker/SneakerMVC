@extends('layouts.app')
@section('content')

<div class="container mx-auto flex justify-center m-5">
<form class="w-[500px] shadow-lg p-5" action="{{ route('sneaker.create') }}" method="POST" enctype="multipart/form-data">
    @csrf    
<p class="font-bold text-xl text-center">Add a new sneaker</p>
  <div class="mb-6">
    <label for="sneakerbrand" class="block mb-2 text-sm font-medium">Brand</label>
    <input type="text" name="sneakerbrand" id="sneakerbrand" class="bg-gray-50 border border-gray-300"  required>
  </div>
  <div class="mb-6">
    <label for="sneakermodel" class="block mb-2 text-sm font-medium">Model</label>
    <input type="text" name="sneakermodel" id="sneakermodel" class="bg-gray-50 border border-gray-300 " required>
  </div>
  <div class="mb-6">
    <label for="sneakercolor" class="block mb-2 text-sm font-medium">Color</label>
    <input type="text" name="sneakercolor" id="sneakercolor" class="bg-gray-50 border border-gray-300 " required>
  </div>
  <div class="mb-6">
    <label for="sneakersize" class="block mb-2 text-sm font-medium">Size</label>
    <input type="number" name="sneakersize" id="sneakersize" class="bg-gray-50 border border-gray-300 " required>
  </div>
  <div class="mb-6">
    <label for="sneakerreleasedate" class="block mb-2 text-sm font-medium">Release date</label>
    <input type="date" name="sneakerreleasedate" id="sneakerreleasedate" class="bg-gray-50 border border-gray-300 " required>
  </div>
  <div class="mb-6">
    <label for="sneakerstylecode" class="block mb-2 text-sm font-medium">Stylecode</label>
    <input type="text" name="sneakerstylecode" id="sneakerstylecode" class="bg-gray-50 border border-gray-300 " required>
  </div>
  <div class="mb-6">
    <label for="sneakerpaidprice" class="block mb-2 text-sm font-medium">Paid price</label>
    <input type="number" name="sneakerpaidprice" id="sneakerpaidprice" class="bg-gray-50 border border-gray-300 " required>
  </div>
  <div class="mb-6">
    <label for="sneakerpicture" class="block mb-2 text-sm font-medium">Picture</label>
    <input type="file" name="sneakerpicture" id="sneakerpicture" class="bg-gray-50 border border-gray-300 " required>
  </div>
  <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
</form>
</div>



@endsection