<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ auth()->user()->esAdministrador() ? __('Panel de Administración') : __('Mi Panel') }}
        </h2>
    </x-slot>

    @if (auth()->user()->esAdministrador())
        @include('admin.dashboard')
    @else
        @include('trabajador.dashboard')
    @endif
</x-app-layout>
