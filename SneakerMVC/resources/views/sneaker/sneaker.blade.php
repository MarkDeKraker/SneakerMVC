@extends('layouts.app')
@section('content')

<a href="{{ route('dashboard') }}" class="bg-black text-white p-2 rounded-lg">Back</a>	
<div class="container mx-auto shadow-lg max-w-sm"> 
<p class="font-bold text-xl text-center">{{ $sneaker->id }}</p>
<p class="font-bold text-xl text-center">{{ $sneaker->sneaker_model }}</p>
<p class="font-bold text-xl text-center">{{ $sneaker->sneaker_size }}</p>
<p class="font-bold text-xl text-center">{{ $sneaker->sneaker_brand }}</p>
<p class="font-bold text-xl text-center">{{ $sneaker->sneaker_paidprice }}</p>
<p class="font-bold text-xl text-center">{{ $sneaker->sneaker_color }}</p>
<p class="font-bold text-xl text-center">{{ $sneaker->sneaker_stylecode }}</p>
<p class="font-bold text-xl text-center">{{ $sneaker->sneaker_releasedate }}</p>
<p class="font-bold text-xl text-center">IMAGE</p>

</div>

@endsection