@extends('layouts.app')

@section('content')
    <div class="bg-white shadow-lg rounded p-6 max-w-md mx-auto mt-5">
        <h1 class="text-2xl font-semibold mb-4">Edit profile</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="space-y-2">
                <label for="name" class="block text-sm font-medium">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" class="w-full border border-gray-300 rounded p-2">
                @error('name')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="space-y-2">
                <label for="email" class="block text-sm font-medium">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" class="w-full border border-gray-300 rounded p-2">
                @error('email')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <button type="submit" class="bg-blue-500 text-white rounded p-2 hover:bg-blue-600">Update</button>
            </div>
        </form>
    </div>
@endsection
