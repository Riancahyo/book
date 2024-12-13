<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'E-Book Library')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white">
    <div class="bg-white">
        <!-- Header Section -->
        <header class="bg-[#FCF8F1] bg-opacity-30">
            <div class="px-4 mx-auto sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16 lg:h-20">
                    <div class="flex-shrink-0">
                        <a href="#" title="E-Book Library" class="flex">
                            <img class="w-auto h-10" src="{{ asset('storage/img/logo.png') }}" alt="E-Book Library" />
                        </a>
                    </div>

                    <button type="button" class="inline-flex p-2 text-black transition-all duration-200 rounded-md lg:hidden focus:bg-gray-100 hover:bg-gray-100">
                        <svg class="block w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path>
                        </svg>
                        <svg class="hidden w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>

                    <!-- Navigation Links -->
                    <div class="hidden lg:flex lg:items-center lg:justify-center lg:w-full">
                        <nav class="flex space-x-10 justify-center w-full">
                            <a href="{{ route('welcome') }}" title="Explore Books" class="text-base text-black transition-all duration-200 hover:text-opacity-80"> Home </a>
                            <a href="{{ route('user.books') }}" title="Explore Books" class="text-base text-black transition-all duration-200 hover:text-opacity-80"> Explore Books </a>
                            <a href="{{ route('user.categories') }}" title="Categories" class="text-base text-black transition-all duration-200 hover:text-opacity-80"> Categories </a>
                            @auth
                            <a href="{{ route('user.loans') }}" title="My Loans" class="text-base text-black transition-all duration-200 hover:text-opacity-80"> My Loans </a>
                            @endauth
                        </nav>
                    </div>
                </div>
            </div>
        </header>
    </div>
    <main>
        @yield('content')
    </main>
</body>
</html>
