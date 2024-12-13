<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-Book</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
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
                    <div class="hidden lg:flex lg:items-center lg:justify-center lg:space-x-10">
                        <a href="{{ route('welcome') }}" title="Explore Books" class="text-base text-black transition-all duration-200 hover:text-opacity-80"> Home </a>
                        <a href="{{ route('user.books') }}" title="Explore Books" class="text-base text-black transition-all duration-200 hover:text-opacity-80"> Explore Books </a>
                        <a href="{{ route('user.categories') }}" title="Categories" class="text-base text-black transition-all duration-200 hover:text-opacity-80"> Categories </a>
                        @auth
                            <a href="{{ route('user.loans') }}" title="My Loans" class="text-base text-black transition-all duration-200 hover:text-opacity-80"> My Loans </a>
                        @endauth
                    </div>
    
                    @auth
                        <div class="hidden lg:flex lg:items-center lg:space-x-3">
                            <div class="relative">
                                <button onclick="toggleDropdown()" class="flex items-center space-x-2 text-black hover:text-opacity-80">
                                    <span class="text-base font-semibold">{{ auth()->user()->name }}</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                                <!-- Dropdown menu -->
                                <div id="profileDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1">
                                    <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                            Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <form action="{{ route('login') }}" method="GET" class="hidden lg:inline-flex">
                            @csrf
                            <button type="submit" class="items-center justify-center px-5 py-2.5 text-base transition-all duration-200 hover:bg-yellow-400 hover:text-black focus:text-black focus:bg-yellow-400 font-semibold text-black bg-yellow-500 rounded-full" role="button">
                                Login
                            </button>
                        </form>
                    @endauth
                </div>
            </div>
        </header>
    
        <!-- Main Section -->
        <section class="bg-[#FCF8F1] bg-opacity-30 py-10 sm:py-16 lg:py-24">
            <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="grid items-center grid-cols-1 gap-12 lg:grid-cols-2">
                    <div>
                        <p class="text-base font-semibold tracking-wider text-blue-600 uppercase">Welcome to your eBook Dashboard</p>
                        <h1 class="mt-4 text-4xl font-bold text-black lg:mt-8 sm:text-6xl xl:text-8xl">Discover & Manage your Library</h1>
                        <p class="mt-4 text-base text-black lg:mt-8 sm:text-xl">Explore a vast collection of eBooks and manage your library effortlessly.</p>
    
                        <a href="{{ route('user.books') }}" title="Explore eBooks" class="inline-flex items-center px-6 py-4 mt-8 font-semibold text-black transition-all duration-200 bg-yellow-300 rounded-full lg:mt-16 hover:bg-yellow-400 focus:bg-yellow-400" role="button">
                            Explore Books
                            <svg class="w-6 h-6 ml-8 -mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('profileDropdown');
            dropdown.classList.toggle('hidden');
        }

        // Close dropdown when clicking outside
        window.onclick = function(event) {
            if (!event.target.matches('button')) {
                const dropdowns = document.getElementsByClassName('absolute');
                for (let i = 0; i < dropdowns.length; i++) {
                    const openDropdown = dropdowns[i];
                    if (!openDropdown.classList.contains('hidden')) {
                        openDropdown.classList.add('hidden');
                    }
                }
            }
        }
    </script>
</body>
</html>