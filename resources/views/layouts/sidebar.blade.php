@php
$isAdmin = Auth::user()->esAdministrador();
@endphp

<!-- Mobile backdrop -->
<div x-show="$store.sidebar.mobileOpen"
    x-transition:enter="transition-opacity ease-linear duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity ease-linear duration-300"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    @click="$store.sidebar.toggleMobile()"
    class="fixed inset-0 z-40 bg-gray-900/60 md:hidden">
</div>

<!-- Sidebar -->
<aside class="fixed inset-y-0 left-0 z-50 flex flex-col bg-gradient-to-b from-cyan-600 to-teal-700 shadow-xl transition-all duration-300 ease-in-out"
    :class="[
        $store.sidebar.mobileOpen ? 'translate-x-0' : '-translate-x-full',
        $store.sidebar.open ? 'w-64 md:translate-x-0' : 'w-16 md:translate-x-0'
      ]">

    <!-- Logo + Toggle -->
    <div class="flex items-center h-16 px-4 border-b border-white/10 shrink-0"
        :class="$store.sidebar.open ? 'justify-between' : 'justify-center'">

        <!-- Logo + Name -->
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 overflow-hidden" x-show="$store.sidebar.open">
            <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-white/20">
                <svg class="w-5 h-5 text-white" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="20" cy="20" r="19" stroke="currentColor" stroke-width="2" />
                    <path d="M12 22C12 22 16 18 20 22C24 26 28 22 28 22" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    <path d="M20 14V18" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    <path d="M16 16L18 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                    <path d="M24 16L22 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                </svg>
            </div>
            <span class="text-white font-semibold text-sm tracking-wide truncate">Gestión Piscícola</span>
        </a>

        <!-- Collapse toggle (desktop) -->
        <button @click.stop="$store.sidebar.toggle()"
            class="hidden md:flex items-center justify-center w-8 h-8 rounded-lg text-white/60 hover:text-white hover:bg-white/10 transition-all duration-200"
            :class="$store.sidebar.open ? '' : 'mx-auto'">
            <svg class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                :class="$store.sidebar.open ? '' : 'rotate-180'">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
            </svg>
        </button>

        <!-- Close button (mobile) -->
        <button @click="mobileOpen = false"
            class="md:hidden flex items-center justify-center w-8 h-8 rounded-lg text-white/60 hover:text-white hover:bg-white/10">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto scrollbar-thin">
        <!-- Dashboard -->
        <x-sidebar-link :href="route('dashboard')"
            :active="request()->routeIs('dashboard')"
            icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>'>
            Dashboard
        </x-sidebar-link>

        <!-- Ventas (both roles) -->
        <x-sidebar-link :href="route('ventas.index')"
            :active="request()->routeIs('ventas.*')"
            icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>'>
            Ventas
        </x-sidebar-link>

        @if($isAdmin)
        <!-- Especies -->
        <x-sidebar-link :href="route('especies.index')"
            :active="request()->routeIs('especies.*')"
            icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16.69 7.44a6.973 6.973 0 0 0 -1.69 4.56c0 1.747 .64 3.345 1.699 4.571"/><path d="M2 9.504c7.715 8.647 14.75 10.265 20 2.498c-5.25 -7.761 -12.285 -6.142 -20 2.504"/><path d="M18 11v.01"/><path d="M11.5 10.5c-.667 1 -.667 2 0 3"/></svg>'>
            Especies
        </x-sidebar-link>

        <!-- Lagos -->
        <x-sidebar-link :href="route('lagos.index')"
            :active="request()->routeIs('lagos.*')"
            icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>'>
            Lagos
        </x-sidebar-link>

        <!-- Reproducciones -->
        <x-sidebar-link :href="route('reproducciones.index')"
            :active="request()->routeIs('reproducciones.*')"
            icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>'>
            Reproducciones
        </x-sidebar-link>
        <!-- Monitoreos -->
        <x-sidebar-link :href="route('monitoreos.seleccionar')"
            :active="request()->routeIs('monitoreos.*')"
            icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>'>
            Monitoreos
        </x-sidebar-link>

        <!-- Recomendaciones -->
        <x-sidebar-link :href="route('recomendaciones.index')"
            :active="request()->routeIs('recomendaciones.*')"
            icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>'>
            Recomendaciones
        </x-sidebar-link>

        <!-- Reportes -->
        <x-sidebar-link :href="route('reportes.index')"
            :active="request()->routeIs('reportes.*')"
            icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>'>
            Reportes
        </x-sidebar-link>

        <!-- Usuarios -->
        <x-sidebar-link :href="route('admin.users.index')"
            :active="request()->routeIs('admin.users.*')"
            icon='<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>'>
            Usuarios
        </x-sidebar-link>
        @endif
    </nav>

    <!-- Bottom section: User + Logout -->
    <div class="border-t border-white/10 p-3 shrink-0">
        <div x-show="$store.sidebar.open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            class="space-y-2">
            <!-- User info -->
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-white/70 hover:text-white hover:bg-white/10 transition-all duration-200">
                <div class="flex items-center justify-center w-8 h-8 rounded-full bg-white/20 text-white text-xs font-bold shrink-0">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
                <div class="min-w-0">
                    <div class="flex items-center gap-2">
                        <p class="text-sm font-medium text-white truncate">{{ Auth::user()->name }}</p>
                        <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-medium uppercase tracking-wider bg-white/20 text-white/90 shrink-0">
                            {{ Auth::user()->esAdministrador() ? 'Admin' : 'Trabajador' }}
                        </span>
                    </div>
                    <p class="text-xs text-white/50 truncate">{{ Auth::user()->email }}</p>
                </div>
            </a>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full flex items-center gap-3 px-3 py-2 rounded-lg text-white/50 hover:text-white hover:bg-white/10 transition-all duration-200 text-sm">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span>Cerrar sesión</span>
                </button>
            </form>
        </div>

        <!-- Collapsed: show only avatar -->
        <div x-show="!$store.sidebar.open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            class="flex flex-col items-center gap-3">
            <a href="{{ route('profile.edit') }}" class="flex items-center justify-center w-10 h-10 rounded-full bg-white/20 text-white text-xs font-bold">
                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center justify-center w-10 h-10 rounded-lg text-white/50 hover:text-white hover:bg-white/10 transition-all duration-200" title="Cerrar sesión">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
</aside>