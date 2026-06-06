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
    <body class="font-sans antialiased">
        <div class="min-h-screen flex flex-col bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="flex-1">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="bg-gray-900 text-white py-8">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                        <div>
                            <h5 class="font-bold mb-3">SkillMe</h5>
                            <p class="text-gray-400 text-sm">Your trusted partner for studying abroad in the UK.</p>
                        </div>
                        <div>
                            <h5 class="font-bold mb-3">Quick Links</h5>
                            <ul class="text-gray-400 text-sm space-y-2">
                                <li><a href="/universities" class="hover:text-white">Universities</a></li>
                                <li><a href="/posts" class="hover:text-white">Blog</a></li>
                            </ul>
                        </div>
                        <div>
                            <h5 class="font-bold mb-3">Support</h5>
                            <ul class="text-gray-400 text-sm space-y-2">
                                <li><a href="#" class="hover:text-white">FAQ</a></li>
                                <li><a href="#" class="hover:text-white">Contact</a></li>
                                <li><a href="#" class="hover:text-white">Terms</a></li>
                            </ul>
                        </div>
                        <div>
                            <h5 class="font-bold mb-3">Follow Us</h5>
                            <ul class="text-gray-400 text-sm space-y-2">
                                <li><a href="#" class="hover:text-white">Facebook</a></li>
                                <li><a href="#" class="hover:text-white">Twitter</a></li>
                                <li><a href="#" class="hover:text-white">LinkedIn</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="border-t border-gray-700 pt-6 text-center text-gray-400 text-sm">
                        <p>&copy; 2026 SkillMe Agency. All rights reserved.</p>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
