@forelse ($especies as $especie)
    <tr>
        <td class="px-4 py-3">{{ $especie->nombre }}</td>
        <td class="px-4 py-3">{{ \Illuminate\Support\Str::limit($especie->descripcion, 50) }}</td>
        <td class="px-4 py-3">{{ $especie->cantidad }}</td>
        <td class="px-4 py-3">{{ $especie->lago->nombre ?? 'N/A' }}</td>
        <td class="px-4 py-3">{{ $especie->created_at->format('d/m/Y') }}</td>
        <td class="px-4 py-3">
            <a href="{{ route('especies.show', $especie) }}" class="text-cyan-600 hover:underline">Ver</a>
            <a href="{{ route('especies.edit', $especie) }}" class="text-yellow-600 hover:underline ml-2">Editar</a>
            <form action="{{ route('especies.destroy', $especie) }}" method="POST" class="inline" onsubmit="return confirm('¿Eliminar esta especie?')">
                @csrf
                @method('DELETE')
                <button type="button" onclick="confirmarEliminar('{{ route('especies.destroy', $especie) }}')"
                    class="text-red-600 hover:underline ml-2">
                    Eliminar
                </button>
            </form>
        </td>
    </tr>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="6" class="px-4 py-3 text-center text-gray-500">No hay especies registradas.</td>
    </tr>
@endforelse