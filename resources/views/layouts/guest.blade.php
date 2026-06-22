<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Ecopiscis') }} - Iniciar Sesión</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-cyan-500 via-blue-500 to-teal-500">
            <div class="flex flex-col items-center mb-6">
                <a href="/" class="text-white">
                    <x-application-logo class="w-auto h-12 text-white" />
                </a>
                <p class="mt-2 text-sm text-white/80">Sistema de Gestión Piscícola</p>
            </div>

            <div class="w-full sm:max-w-md mt-2 px-8 py-8 bg-white/95 backdrop-blur-sm shadow-2xl rounded-2xl">
                <div class="fixed top-4 right-4 z-[100] flex flex-col gap-3 w-full max-w-sm">
                    @if (session('success'))
                        <x-toast type="success" :message="session('success')" />
                    @endif

                    @if (session('info'))
                        <x-toast type="info" :message="session('info')" />
                    @endif
                </div>

                @if (session('error'))
                    <x-alert type="error" :message="session('error')" />
                @endif

                @if (session('warning'))
                    <x-alert type="warning" :message="session('warning')" />
                @endif

                {{ $slot }}
            </div>

            <p class="mt-6 text-xs text-white/60">&copy; {{ date('Y') }} Ecopiscis. Todos los derechos reservados.</p>
        </div>
    </body>
</html>
