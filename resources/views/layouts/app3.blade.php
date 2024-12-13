<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <!-- Container -->
        <div class="bg-white shadow-md rounded-lg max-w-4xl w-full">
            <!-- Header -->
            @if (isset($header))
                <header class="bg-blue-600 text-white rounded-t-lg py-4 px-6 text-center">
                    <h1 class="text-xl font-semibold">
                        {{ $header }}
                    </h1>
                </header>
            @endif

            <!-- Main Content -->
            <main class="p-2">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
