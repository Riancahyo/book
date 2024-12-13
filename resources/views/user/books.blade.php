@extends('layouts.app2')

@section('title', 'Books')

@section('content')
<section class="bg-[#FCF8F1] bg-opacity-30 py-10 sm:py-16 lg:py-24">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Books</h1>
        <div class="grid items-stretch grid-cols-1 gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5">
            @foreach ($books as $book)
                <div class="p-6 bg-white border rounded-lg shadow-md flex flex-col h-full">
                    @if ($book->image)
                        <img class="w-full h-40 object-cover rounded-md mb-4" src="{{ asset('storage/img/' . $book->image) }}" alt="{{ $book->title }}">
                    @else
                        <div class="w-full h-40 bg-gray-200 rounded-md flex items-center justify-center mb-4">
                            <span class="text-gray-500">No Image Available</span>
                        </div>
                    @endif

                    <h3 class="text-lg font-semibold text-gray-800 text-center">{{ $book->title }}</h3>
                    <p class="mt-2 text-sm text-gray-600 text-center">{{ $book->description }}</p>

                    <!-- Tombol Pinjam di tengah bawah -->
                    <a href="{{ route('loans.create', ['id' => $book->id]) }}" class="mt-auto inline-block bg-blue-600 text-white py-2 px-4 rounded-md text-center hover:bg-blue-800">Pinjam</a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
