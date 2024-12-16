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
                   @if (file_exists(public_path('storage/img/' . $book->image)))
                       <div class="aspect-[3/4] mb-4">
                           <img class="w-full h-full object-cover rounded-md" 
                               src="{{ asset('storage/img/' . $book->image) }}" 
                               alt="{{ $book->title }}">
                       </div>
                   @else
                       <div class="aspect-[3/4] bg-gray-200 rounded-md flex items-center justify-center mb-4">
                           <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                           </svg>
                       </div>
                   @endif
                   @else
                       <div class="aspect-[3/4] bg-gray-200 rounded-md flex items-center justify-center mb-4">
                           <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                               <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                           </svg>
                       </div>
                   @endif

                   <h3 class="text-lg font-semibold text-gray-800 text-center mb-2">{{ $book->title }}</h3>
                   <p class="text-sm text-gray-600 text-center mb-4">{{ $book->description }}</p>

                   <div class="mt-auto">
                       <a href="{{ route('loans.create', ['id' => $book->id]) }}" 
                          class="block w-full bg-blue-600 text-white py-2 px-4 rounded-md text-center hover:bg-blue-800 transition duration-300">
                           Pinjam
                       </a>
                   </div>
               </div>
           @endforeach
       </div>
   </div>
</section>
@endsection