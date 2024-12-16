@extends('layouts.app2')

@section('title', 'My Loans')

@section('content')
<section class="bg-[#FCF8F1] bg-opacity-30 py-10 sm:py-16 lg:py-24">
   <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
       <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">My Loans</h1>
       
       @if ($loans->isEmpty())
           <p class="text-center text-gray-600">You currently have no active loans.</p>
       @else
           <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4">
               @foreach ($loans as $loan)
                   <div class="p-6 bg-white border rounded-lg shadow-md flex flex-col h-full">
                        <div class="mb-4 h-96 overflow-hidden rounded-md">
                            @if ($loan->book->image)
                                @if (file_exists(public_path('storage/img/' . $loan->book->image)))
                                    <img class="w-full h-full object-cover" 
                                        src="{{ asset('storage/img/' . $loan->book->image) }}" 
                                        alt="{{ $loan->book->title }}">
                                @else
                                    <div class="w-full h-full bg-gray-200 rounded-md flex items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                            @else
                                <div class="w-full h-full bg-gray-200 rounded-md flex items-center justify-center">
                                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            @endif
                        </div>

                       <h3 class="text-lg font-semibold text-gray-800 text-center mb-2">{{ $loan->book->title }}</h3>
                       <div class="space-y-2 mb-4 text-center">
                           <p class="text-sm text-gray-600">Loan Date: {{ $loan->loan_date }}</p>
                           <p class="text-sm text-gray-600">Due Date: {{ $loan->due_date }}</p>
                           <p class="text-sm text-gray-600">Status: 
                               <span class="font-medium
                                   @if ($loan->status === 'Dipinjam') text-yellow-600 
                                   @elseif ($loan->status === 'Dikembalikan') text-green-600 
                                   @else text-red-600 @endif
                               ">
                                   {{ $loan->status }}
                               </span>
                           </p>
                       </div>

                       @if ($loan->status === 'Dipinjam')
                           <div class="mt-auto">
                               <a href="{{ $loan->book->gdrive_link }}" 
                                  target="_blank" 
                                  class="block w-full bg-blue-600 text-white py-2 px-4 rounded-md text-center hover:bg-blue-800 transition duration-300">
                                   Baca
                               </a>
                           </div>
                       @endif
                   </div>
               @endforeach
           </div>
       @endif
   </div>
</section>
@endsection