@extends('layouts.app2')

@section('title', 'Categories')

@section('content')
<section class="bg-[#FCF8F1] bg-opacity-30 py-10 sm:py-16 lg:py-24">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Categories</h1>
        <div class="grid items-start grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">
            @foreach ($categories as $category)
                <div class="p-6 bg-white border rounded-lg shadow-md flex flex-col space-y-2 h-full">
                    <h3 class="text-lg font-semibold text-gray-800 text-center">{{ $category->name }}</h3>
                    <p class="text-sm text-gray-600 text-center">{{ $category->description }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
