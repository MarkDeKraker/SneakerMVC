@extends('layouts.app')
@section('content')
<div class="container mx-auto shadow-lg mt-10 p-2">
    <p class="font-medium text-xl">Your sneakers</p>
<div class="bg-white grid grid-cols-4 gap-2">

@foreach ($sneakers as $sneaker)
<div class="border-2 max-w-xs rounded-lg p-2">
    <p>Model: {{ $sneaker->sneaker_model }}</p>
    <p>Size: {{ $sneaker->sneaker_size }}</p>
    <p>Color: {{ $sneaker->sneaker_color }}</p>
    <div>
    <a class="bg-black text-white p-2 rounded-lg" href="sneaker/details/{{$sneaker->id}}">Details</a>
    </div>
</div>
@endforeach
</div>
   
</div>
</div>


@endsection