<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Usuario') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="p-6">
                    <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="name" :value="__('Nombre')" />
                            <x-text-input id="name" type="text" name="name"
                                :value="old('name')" required autofocus />
                            <x-input-error :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('Correo Electrónico')" />
                            <x-text-input id="email" type="email" name="email"
                                :value="old('email')" required />
                            <x-input-error :messages="$errors->get('email')" />
                        </div>

                        <div>
                            <x-input-label for="telefono" :value="__('Teléfono')" />
                            <x-text-input id="telefono" type="text" name="telefono"
                                :value="old('telefono')" />
                            <x-input-error :messages="$errors->get('telefono')" />
                        </div>

                        <div>
                            <x-input-label for="password" :value="__('Contraseña')" />
                            <x-text-input id="password" type="password" name="password"
                                required />
                            <x-input-error :messages="$errors->get('password')" />
                        </div>

                        <div>
                            <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />
                            <x-text-input id="password_confirmation" type="password"
                                name="password_confirmation" required />
                            <x-input-error :messages="$errors->get('password_confirmation')" />
                        </div>

                        <div>
                            <x-input-label for="rol" :value="__('Rol')" />
                            <select id="rol" name="rol" required class="form-select">
                                <option value="">Seleccionar rol</option>
                                <option value="administrador" {{ old('rol') == 'administrador' ? 'selected' : '' }}>
                                    Administrador
                                </option>
                                <option value="trabajador" {{ old('rol') == 'trabajador' ? 'selected' : '' }}>
                                    Trabajador
                                </option>
                            </select>
                            <x-input-error :messages="$errors->get('rol')" />
                        </div>

                        <div class="flex items-center justify-end gap-4">
                            <a href="{{ route('admin.users.index') }}"
                                class="btn-secondary">
                                Cancelar
                            </a>
                            <button type="submit" class="btn-primary">
                                {{ __('Crear Usuario') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
