<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Usuario') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            @if (!$user->esActivo())
                <x-alert type="warning"
                    message="Este usuario está inactivo. No puede iniciar sesión. Si deseas reactivarlo, guarda los cambios y luego actívalo desde la lista de usuarios." />
            @endif

            <x-alert type="info"
                :message="'Editando a: ' . $user->name . ' — Registrado el ' . $user->created_at->format('d/m/Y')" />

            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="p-6">
                    <form method="POST" action="{{ route('admin.users.update', $user) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="name" :value="__('Nombre')" />
                            <x-text-input id="name" type="text" name="name"
                                :value="old('name', $user->name)" required />
                            <x-input-error :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('Correo Electrónico')" />
                            <x-text-input id="email" type="email" name="email"
                                :value="old('email', $user->email)" required />
                            <x-input-error :messages="$errors->get('email')" />
                        </div>

                        <div>
                            <x-input-label for="telefono" :value="__('Teléfono')" />
                            <x-text-input id="telefono" type="text" name="telefono"
                                :value="old('telefono', $user->telefono)" />
                            <x-input-error :messages="$errors->get('telefono')" />
                        </div>

                        <div>
                            <x-input-label for="password" :value="__('Nueva Contraseña (dejar vacío para mantener)')" />
                            <x-text-input id="password" type="password" name="password" />
                            <x-input-error :messages="$errors->get('password')" />
                        </div>

                        <div>
                            <x-input-label for="password_confirmation" :value="__('Confirmar Nueva Contraseña')" />
                            <x-text-input id="password_confirmation" type="password"
                                name="password_confirmation" />
                            <x-input-error :messages="$errors->get('password_confirmation')" />
                        </div>

                        <div>
                            <x-input-label for="rol" :value="__('Rol')" />
                            <select id="rol" name="rol" required class="form-select">
                                <option value="">Seleccionar rol</option>
                                <option value="administrador" {{ old('rol', $user->rol) == 'administrador' ? 'selected' : '' }}>
                                    Administrador
                                </option>
                                <option value="trabajador" {{ old('rol', $user->rol) == 'trabajador' ? 'selected' : '' }}>
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
                                {{ __('Actualizar Usuario') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
