@extends('layouts.app')
@section('content')
<div class="container mx-auto shadow-lg mt-10 p-2">
    <p class="font-medium text-xl">Your sneakers</p>
<div class="bg-white grid grid-cols-4 gap-2">

@if (count($sneakers) == 0)
    <p class="">You have no sneakers yet</p>
@else
    @foreach ($sneakers as $sneaker)
    <div class="border-2 max-w-xs rounded-lg p-2">
        <div class="grid grid-cols-2">
            <div>
                <p>Brand: {{ $sneaker->sneaker_brand }}</p>
                <p>Model: {{ $sneaker->sneaker_model }}</p>
                <p>Color: {{ $sneaker->sneaker_color }}</p>
            </div>
        </div>
        <div class="my-2">
            <a class="bg-black text-white p-2 rounded-lg" href="{{ route("sneaker.show", $sneaker)}}">Details</a>
        </div>
    </div>
    @endforeach
@endif
</div>
   
</div>
</div>


@endsection