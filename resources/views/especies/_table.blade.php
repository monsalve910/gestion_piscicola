@forelse ($especies as $especie)
    <tr class="hover:bg-gray-50 transition-colors duration-150">
        <td class="px-4 py-3">{{ $especie->nombre }}</td>
        <td class="px-4 py-3">{{ \Illuminate\Support\Str::limit($especie->descripcion, 50) }}</td>
        <td class="px-4 py-3">{{ $especie->cantidad }}</td>
        <td class="px-4 py-3">${{ number_format($especie->precio, 2) }}</td>
        <td class="px-4 py-3">{{ $especie->lago->nombre ?? 'N/A' }}</td>
        <td class="px-4 py-3">{{ $especie->created_at->format('d/m/Y') }}</td>
        <td class="px-4 py-3">
            <div class="flex items-center gap-2">
                <a href="{{ route('especies.show', $especie) }}" class="text-cyan-600 hover:text-cyan-800 text-sm font-medium">Ver</a>
                <a href="{{ route('especies.edit', $especie) }}" class="text-amber-600 hover:text-amber-800 text-sm font-medium">Editar</a>
                <button type="button" onclick="confirmarEliminar('{{ route('especies.destroy', $especie) }}')"
                    class="text-sm font-medium text-red-600 hover:text-red-800">
                    Eliminar
                </button>
            </div>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="7" class="px-4 py-8 text-center text-gray-500">
            <div class="flex flex-col items-center justify-center">
                <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                </svg>
                <p class="text-sm font-medium text-gray-400">No hay especies registradas.</p>
            </div>
        </td>
    </tr>
@endforelse