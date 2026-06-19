@forelse ($reproducciones as $reproduccion)
    <tr>
        <td class="px-4 py-3">{{ $reproduccion->especie->nombre ?? 'N/A' }}</td>
        <td class="px-4 py-3">{{ $reproduccion->fecha->format('d/m/Y') }}</td>
        <td class="px-4 py-3">{{ $reproduccion->cantidad }}</td>
        <td class="px-4 py-3">{{ \Illuminate\Support\Str::limit($reproduccion->observaciones, 50) }}</td>
        <td class="px-4 py-3">{{ $reproduccion->created_at->format('d/m/Y') }}</td>
        <td class="px-4 py-3">
            <a href="{{ route('reproducciones.show', $reproduccion) }}" class="text-cyan-600 hover:underline">Ver</a>
            <a href="{{ route('reproducciones.edit', $reproduccion) }}" class="text-yellow-600 hover:underline ml-2">Editar</a>
            <button type="button" data-url="{{ route('reproducciones.destroy', $reproduccion) }}"
                class="btn-eliminar text-red-600 hover:underline ml-2">
                Eliminar
            </button>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="6" class="px-4 py-3 text-center text-gray-500">No hay reproducciones registradas.</td>
    </tr>
@endforelse