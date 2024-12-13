<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6">Dashboard Summary</h3>
                    <div class="flex space-x-6">
                        <!-- Total Books -->
                        <div class="bg-blue-100 w-1/3 p-6 rounded shadow text-center">
                            <h4 class="text-lg font-semibold">Total Books</h4>
                            <p class="text-4xl font-bold mt-2">{{ $bookCount }}</p>
                            <a href="{{ route('books.index') }}" class="mt-4 inline-block px-4 py-2 text-sm text-black bg-blue-600 rounded hover:bg-blue-700">
                                View Books
                            </a>
                        </div>

                        <!-- Total Categories -->
                        <div class="bg-green-100 w-1/3 p-6 rounded shadow text-center">
                            <h4 class="text-lg font-semibold">Total Categories</h4>
                            <p class="text-4xl font-bold mt-2">{{ $categoryCount }}</p>
                            <a href="{{ route('categories.index') }}" class="mt-4 inline-block px-4 py-2 text-sm text-black bg-green-600 rounded hover:bg-green-700">
                                View Categories
                            </a>
                        </div>

                        <!-- Total Loans -->
                        <div class="bg-yellow-100 w-1/3 p-6 rounded shadow text-center">
                            <h4 class="text-lg font-semibold">Total Loans</h4>
                            <p class="text-4xl font-bold mt-2">{{ $loanCount }}</p>
                            <a href="{{ route('loans.index') }}" class="mt-4 inline-block px-4 py-2 text-sm text-black bg-yellow-600 rounded hover:bg-yellow-700">
                                View Loans
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
