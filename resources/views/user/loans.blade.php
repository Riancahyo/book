@extends('layouts.app2')

@section('title', 'My Loans')

@section('content')
<section class="bg-[#FCF8F1] bg-opacity-30 py-10 sm:py-16 lg:py-24">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">My Loans</h1>
        
        @if ($loans->isEmpty())
            <p class="text-center text-gray-600">You currently have no active loans.</p>
        @else
            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($loans as $loan)
                    <div class="p-6 bg-white border rounded-lg shadow-md flex flex-col h-full">
                        @if ($loan->book->image)
                            <img class="w-full h-40 object-cover rounded-md mb-4" src="{{ asset('storage/img/' . $loan->book->image) }}" alt="{{ $loan->book->title }}">
                        @else
                            <div class="w-full h-40 bg-gray-200 rounded-md flex items-center justify-center mb-4">
                                <span class="text-gray-500">No Image Available</span>
                            </div>
                        @endif

                        <h3 class="text-lg font-semibold text-gray-800 text-center">{{ $loan->book->title }}</h3>
                        <p class="mt-2 text-sm text-gray-600 text-center">Loan Date: {{ $loan->loan_date }}</p>
                        <p class="text-sm text-gray-600 text-center">Due Date: {{ $loan->due_date }}</p>
                        <p class="text-sm text-gray-600 text-center">Status: 
                            <span class="
                                @if ($loan->status === 'Dipinjam') text-yellow-600 
                                @elseif ($loan->status === 'Dikembalikan') text-green-600 
                                @else text-red-600 @endif
                            ">
                                {{ $loan->status }}
                            </span>
                        </p>

                        @if ($loan->status === 'Dipinjam')
                            <a href="{{ $loan->book->gdrive_link }}" target="_blank" class="mt-4 inline-block bg-blue-600 text-white py-2 px-4 rounded-md text-center hover:bg-blue-800">Baca</a>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection
