<div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-4">
    <div class="p-4">
        <form action="{{ route('reportes.preview') }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            @csrf
            <input type="hidden" name="tipo" value="{{ $tipo }}">

            @if (isset($opcionesFiltro['lagos']))
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Lago</label>
                <select name="lago_id" class="form-select block w-full">
                    <option value="">Todos</option>
                    @foreach ($opcionesFiltro['lagos'] as $id => $nombre)
                        <option value="{{ $id }}" @selected(($filtros['lago_id'] ?? '') == $id)>{{ $nombre }}</option>
                    @endforeach
                </select>
            </div>
            @endif

            @if (isset($opcionesFiltro['especies']))
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Especie</label>
                <select name="especie_id" class="form-select block w-full">
                    <option value="">Todas</option>
                    @foreach ($opcionesFiltro['especies'] as $id => $nombre)
                        <option value="{{ $id }}" @selected(($filtros['especie_id'] ?? '') == $id)>{{ $nombre }}</option>
                    @endforeach
                </select>
            </div>
            @endif

            @if (isset($opcionesFiltro['estados']))
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                <select name="estado" class="form-select block w-full">
                    <option value="">Todos</option>
                    @foreach ($opcionesFiltro['estados'] as $estado)
                        <option value="{{ $estado }}" @selected(($filtros['estado'] ?? '') == $estado)>{{ ucfirst($estado) }}</option>
                    @endforeach
                </select>
            </div>
            @endif

            @if (isset($opcionesFiltro['roles']))
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Rol</label>
                <select name="rol" class="form-select block w-full">
                    <option value="">Todos</option>
                    @foreach ($opcionesFiltro['roles'] as $rol)
                        <option value="{{ $rol }}" @selected(($filtros['rol'] ?? '') == $rol)>{{ ucfirst($rol) }}</option>
                    @endforeach
                </select>
            </div>
            @endif

            @if (isset($opcionesFiltro['tipos']))
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Tipo</label>
                <select name="tipo_recom" class="form-select block w-full">
                    <option value="">Todos</option>
                    @foreach ($opcionesFiltro['tipos'] as $t)
                        <option value="{{ $t }}" @selected(($filtros['tipo'] ?? '') == $t)>{{ ucfirst($t) }}</option>
                    @endforeach
                </select>
            </div>
            @endif

            @if (isset($opcionesFiltro['niveles']))
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nivel Riesgo</label>
                <select name="nivel_riesgo" class="form-select block w-full">
                    <option value="">Todos</option>
                    @foreach ($opcionesFiltro['niveles'] as $n)
                        <option value="{{ $n }}" @selected(($filtros['nivel_riesgo'] ?? '') == $n)>{{ ucfirst($n) }}</option>
                    @endforeach
                </select>
            </div>
            @endif

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Fecha desde</label>
                <input type="date" name="fecha_desde" value="{{ $filtros['fecha_desde'] ?? '' }}"
                    class="form-input block w-full">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Fecha hasta</label>
                <input type="date" name="fecha_hasta" value="{{ $filtros['fecha_hasta'] ?? '' }}"
                    class="form-input block w-full">
            </div>

            <div class="flex items-end gap-2">
                <button type="submit" class="btn-primary">
                    Aplicar Filtros
                </button>
                <a href="{{ route('reportes.index') }}" class="btn-secondary"
                   onclick="event.preventDefault(); document.querySelector('input[name=_token]').form.submit();">
                    Limpiar
                </a>
            </div>
        </form>
    </div>
</div>
