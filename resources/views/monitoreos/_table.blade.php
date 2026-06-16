@forelse ($monitoreos as $monitoreo)
    <tr class="hover:bg-gray-50">
        <td class="px-4 py-3 font-medium">{{ $monitoreo->fecha_monitoreo->format('d/m/Y') }}</td>
        <td class="px-4 py-3">{{ $monitoreo->temperatura_agua ? $monitoreo->temperatura_agua . ' °C' : '—' }}</td>
        <td class="px-4 py-3">{{ $monitoreo->ph ?? '—' }}</td>
        <td class="px-4 py-3">{{ $monitoreo->nivel_oxigeno ? $monitoreo->nivel_oxigeno . ' mg/L' : '—' }}</td>
        <td class="px-4 py-3">
            <span class="px-2 py-1 rounded-full text-xs font-semibold
                {{ $monitoreo->estado_general == 'bueno' ? 'bg-green-100 text-green-700' : ($monitoreo->estado_general == 'regular' ? 'bg-amber-100 text-amber-700' : 'bg-red-100 text-red-700') }}">
                {{ ucfirst($monitoreo->estado_general) }}
            </span>
        </td>
        <td class="px-4 py-3">
            @include('monitoreos.partials.actions', ['monitoreo' => $monitoreo, 'lago' => $lago])
        </td>
    </tr>
@empty
    <tr>
        <td colspan="6" class="px-4 py-12">
            <div class="flex flex-col items-center justify-center text-gray-400">
                <svg class="h-12 w-12 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                <p class="text-base font-medium text-gray-500">No se encontraron monitoreos</p>
                <p class="text-sm mt-1">
                    @if ($search)
                        Intenta con otros términos de búsqueda.
                    @else
                        Aún no hay monitoreos registrados para este lago.
                    @endif
                </p>
            </div>
        </td>
    </tr>
@endforelse
