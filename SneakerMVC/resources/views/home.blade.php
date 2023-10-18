@extends('layouts.app')
@section('content')

<div class="mt-20">
    <div class="">
    <p class="text-center font-medium text-4xl">Welcome to SneakerMVC</p>
    <p class="text-center font-medium text-xl">The place to keep track of your sneakers</p>
    <div class="flex justify-center mt-2 space-x-2">
        <a href="{{ route('register') }}" class="bg-black text-white p-2 rounded-lg">Register</a>
        <a href="{{ route('login') }}" class="bg-black text-white p-2 rounded-lg">Login</a>
    </div>
    </div>
</div>

@endsection