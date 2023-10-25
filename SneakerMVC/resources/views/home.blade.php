@extends('layouts.app')
@section('content')

<div class="container mx-auto shadow-lg mt-10 p-2">
    <p class="font-medium text-xl">Marketplace</p>
    <div class="bg-white grid grid-cols-4 gap-2">
    <div class="border-2 max-w-xs rounded-lg p-2">
        <div class="grid grid-cols-2">
            <div>
                <p>Brand: Nike</p>
                <p>Model: Air Jordan 1</p>
                <p>Color: Black/white</p>
            </div>
        </div>
        <div class="my-2">
            <a class="bg-black text-white p-2 rounded-lg">Details</a>
        </div>
    </div>
    <div class="border-2 max-w-xs rounded-lg p-2">
        <div class="grid grid-cols-2">
            <div>
                <p>Brand: Nike</p>
                <p>Model: Air Jordan 1</p>
                <p>Color: Black/white</p>
            </div>
        </div>
        <div class="my-2">
            <a class="bg-black text-white p-2 rounded-lg">Details</a>
        </div>
    </div>
    <div class="border-2 max-w-xs rounded-lg p-2">
        <div class="grid grid-cols-2">
            <div>
                <p>Brand: Nike</p>
                <p>Model: Air Jordan 1</p>
                <p>Color: Black/white</p>
            </div>
        </div>
        <div class="my-2">
            <a class="bg-black text-white p-2 rounded-lg">Details</a>
        </div>
    </div>

</div>

@endsection