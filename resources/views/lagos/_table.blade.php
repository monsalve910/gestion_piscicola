@forelse ($lagos as $lago)
    <tr class="hover:bg-gray-50">
        <td class="px-4 py-3 font-medium">{{ $lago->nombre }}</td>
        <td class="px-4 py-3">{{ $lago->ubicacion ?? '—' }}</td>
        <td class="px-4 py-3">{{ $lago->tamano ? number_format($lago->tamano, 2) . ' m²' : '—' }}</td>
        <td class="px-4 py-3">
            <span class="px-2 py-1 rounded-full text-xs font-semibold
                {{ $lago->esActivo() ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                {{ $lago->esActivo() ? 'Activo' : 'Inactivo' }}
            </span>
        </td>
        <td class="px-4 py-3">{{ $lago->created_at->format('d/m/Y') }}</td>
        <td class="px-4 py-3">
            @include('lagos.partials.actions', ['lago' => $lago])
        </td>
    </tr>
@empty
    <tr>
        <td colspan="6" class="px-4 py-12">
            <div class="flex flex-col items-center justify-center text-gray-400">
                <svg class="h-12 w-12 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <p class="text-base font-medium text-gray-500">No se encontraron lagos</p>
                <p class="text-sm mt-1">
                    @if ($search)
                        Intenta con otros términos de búsqueda.
                    @else
                        Aún no hay lagos registrados.
                    @endif
                </p>
            </div>
        </td>
    </tr>
@endforelse
