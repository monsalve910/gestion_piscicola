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

        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.store('sidebar', {
                    open: localStorage.getItem('sidebarOpen') !== 'false',
                    mobileOpen: false,
                    toggle() {
                        this.open = !this.open;
                        localStorage.setItem('sidebarOpen', this.open);
                    },
                    toggleMobile() {
                        this.mobileOpen = !this.mobileOpen;
                        document.body.style.overflow = this.mobileOpen ? 'hidden' : '';
                    }
                });
            });
        </script>
    </head>
    <body class="font-sans antialiased bg-gray-100" x-data>
        @include('layouts.sidebar')

        <!-- Toast notifications (fixed top-right) -->
        <div class="fixed top-4 right-4 z-[100] flex flex-col gap-3 w-full max-w-sm">
            @if (session('success'))
                <x-toast type="success" :message="session('success')" />
            @endif

            @if (session('info'))
                <x-toast type="info" :message="session('info')" />
            @endif
        </div>

        <!-- Mobile hamburger (visible only on small screens) -->
        <div class="fixed top-4 left-4 z-30 md:hidden">
            <button @click="$store.sidebar.toggleMobile()"
                    class="flex items-center justify-center w-10 h-10 rounded-lg bg-white shadow-lg text-gray-600 hover:text-gray-900 border border-gray-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>

        <!-- Main content -->
        <div class="min-h-screen transition-all duration-300 ease-in-out"
             :class="$store.sidebar.open ? 'md:ml-64' : 'md:ml-16'">

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow-sm border-b border-gray-200">
                    <div class="px-4 sm:px-6 lg:px-8 py-4">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="py-6 pt-16 md:pt-6">
                <div class="px-4 sm:px-6 lg:px-8">
                    @if (session('error'))
                        <x-alert type="error" :message="session('error')" />
                    @endif

                    @if (session('warning'))
                        <x-alert type="warning" :message="session('warning')" />
                    @endif

                    {{ $slot }}
                </div>
            </main>
        </div>
    </body>
</html>
