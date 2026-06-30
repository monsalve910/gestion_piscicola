@forelse ($ventas as $venta)
    <tr class="hover:bg-gray-50 transition-colors duration-150">
        <td class="px-4 py-3">{{ $venta->especie->nombre ?? 'N/A' }}</td>
        <td class="px-4 py-3">{{ number_format($venta->peso_kg, 2) }} kg</td>
        <td class="px-4 py-3">${{ number_format($venta->precio_unitario, 2) }}</td>
        <td class="px-4 py-3">${{ number_format($venta->total, 2) }}</td>
        <td class="px-4 py-3">{{ $venta->fecha_venta->format('d/m/Y') }}</td>
        <td class="px-4 py-3">
            <div class="flex items-center gap-2">
                <a href="{{ route('ventas.show', $venta) }}" class="text-cyan-600 hover:text-cyan-800 text-sm font-medium">Ver</a>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="6" class="px-4 py-8 text-center text-gray-500">
            <div class="flex flex-col items-center justify-center">
                <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                </svg>
                <p class="text-sm font-medium text-gray-400">No hay ventas registradas.</p>
            </div>
        </td>
    </tr>
@endforelse
