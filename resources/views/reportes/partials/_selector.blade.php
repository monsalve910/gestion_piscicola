<div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-4">
    <div class="p-4">
        <form action="{{ route('reportes.preview') }}" method="POST" class="flex items-end gap-4">
            @csrf
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Tipo de Reporte</label>
                <select name="tipo" class="form-select block w-full">
                    <option value="">-- Selecciona un tipo --</option>
                    @foreach ($tiposDisponibles as $key => $label)
                        <option value="{{ $key }}" @selected($tipo === $key)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn-primary">
                Generar Vista Previa
            </button>
        </form>
    </div>
</div>
