<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nueva Venta') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="p-6">
                    <form action="{{ route('ventas.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label">Especie</label>
                            <select name="especie_id" id="especie_select"
                                data-precios='@json($especies->pluck('precio', 'id'))'
                                class="form-select">
                                <option value="">-- Selecciona una especie --</option>
                                @foreach ($especies as $especie)
                                    <option value="{{ $especie->id }}" @selected(old('especie_id') == $especie->id)>
                                        {{ $especie->nombre }} - ${{ number_format($especie->precio, 2) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('especie_id') <p class="form-error">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Peso (kg)</label>
                            <input type="number" step="0.01" name="peso_kg" id="peso_kg_input" min="0.01" value="{{ old('peso_kg', 1) }}"
                                class="form-input">
                            @error('peso_kg') <p class="form-error">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Precio por kg</label>
                            <input type="number" step="0.01" name="precio_unitario" id="precio_unitario_input" min="0" value="{{ old('precio_unitario') }}"
                                class="form-input">
                            @error('precio_unitario') <p class="form-error">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Total</label>
                            <div id="total_display" class="mt-1 text-lg font-semibold text-gray-900">$0.00</div>
                        </div>

                        <script>
                            const precios = JSON.parse(document.getElementById('especie_select').dataset.precios || '{}');

                            function actualizarPrecio() {
                                const especieId = document.getElementById('especie_select').value;
                                const precio = precios[especieId] || 0;
                                const inputPrecio = document.getElementById('precio_unitario_input');
                                if (!inputPrecio.value || inputPrecio.dataset.autofilled !== 'false') {
                                    inputPrecio.value = precio;
                                    inputPrecio.dataset.autofilled = 'true';
                                }
                                actualizarTotal();
                            }

                            function actualizarTotal() {
                                const pesoKg = parseFloat(document.getElementById('peso_kg_input').value) || 0;
                                const precio = parseFloat(document.getElementById('precio_unitario_input').value) || 0;
                                document.getElementById('total_display').textContent = '$' + (pesoKg * precio).toFixed(2);
                            }

                            document.getElementById('especie_select').addEventListener('change', function() {
                                document.getElementById('precio_unitario_input').dataset.autofilled = 'true';
                                actualizarPrecio();
                            });

                            document.getElementById('precio_unitario_input').addEventListener('input', function() {
                                this.dataset.autofilled = 'false';
                                actualizarTotal();
                            });

                            document.getElementById('peso_kg_input').addEventListener('input', actualizarTotal);

                            document.addEventListener('DOMContentLoaded', actualizarPrecio);
                        </script>

                        <div class="mb-4">
                            <label class="form-label">Fecha de Venta</label>
                            <input type="date" name="fecha_venta" value="{{ old('fecha_venta') }}"
                                class="form-input">
                            @error('fecha_venta') <p class="form-error">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex justify-end gap-2">
                            <a href="{{ route('ventas.index') }}" class="btn-secondary">Cancelar</a>
                            <button type="submit" class="btn-primary">
                                Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
