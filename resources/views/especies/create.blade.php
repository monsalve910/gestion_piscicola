<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nueva Especie') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="p-6">
                    <form action="{{ route('especies.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="nombre" value="{{ old('nombre') }}"
                                class="form-input">
                            @error('nombre') <p class="form-error">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Descripción</label>
                            <textarea name="descripcion" rows="3"
                                class="form-textarea">{{ old('descripcion') }}</textarea>
                            @error('descripcion') <p class="form-error">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Cantidad</label>
                            <input type="number" name="cantidad" min="0" value="{{ old('cantidad', 0) }}"
                                class="form-input">
                            @error('cantidad') <p class="form-error">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Precio</label>
                            <input type="number" step="0.01" name="precio" min="0" value="{{ old('precio', 0) }}"
                                class="form-input">
                            @error('precio') <p class="form-error">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Lago</label>
                            <select name="lago_id" class="form-select">
                                <option value="">-- Selecciona un lago --</option>
                                @foreach ($lagos as $lago)
                                    <option value="{{ $lago->id }}" @selected(old('lago_id') == $lago->id)>
                                        {{ $lago->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('lago_id') <p class="form-error">{{ $message }}</p> @enderror
                        </div>

                        <hr class="my-6">

                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Parámetros Ideales para Recomendaciones</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="form-label">Temperatura Mínima (°C)</label>
                                <input type="number" step="0.01" name="temp_min" min="0" value="{{ old('temp_min') }}"
                                    class="form-input" required>
                                @error('temp_min') <p class="form-error">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="form-label">Temperatura Máxima (°C)</label>
                                <input type="number" step="0.01" name="temp_max" min="0" value="{{ old('temp_max') }}"
                                    class="form-input" required>
                                @error('temp_max') <p class="form-error">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="form-label">Oxígeno Mínimo (mg/L)</label>
                                <input type="number" step="0.01" name="oxigeno_min" value="{{ old('oxigeno_min') }}"
                                    class="form-input" required>
                                @error('oxigeno_min') <p class="form-error">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="form-label">Oxígeno Máximo (mg/L)</label>
                                <input type="number" step="0.01" name="oxigeno_max" value="{{ old('oxigeno_max') }}"
                                    class="form-input" required>
                                @error('oxigeno_max') <p class="form-error">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        <div class="flex justify-end gap-2 mt-6">
                            <a href="{{ route('especies.index') }}" class="btn-secondary">Cancelar</a>
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