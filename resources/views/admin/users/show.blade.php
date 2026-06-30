<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalles del Usuario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            @if (!$user->esActivo())
                <x-alert type="warning"
                    message="Este usuario está inactivo. No puede iniciar sesión hasta que un administrador lo active." />
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <dl class="space-y-4">
                        <div class="flex border-b pb-3">
                            <dt class="w-1/3 font-semibold text-gray-600">ID</dt>
                            <dd class="w-2/3">{{ $user->id }}</dd>
                        </div>
                        <div class="flex border-b pb-3">
                            <dt class="w-1/3 font-semibold text-gray-600">Nombre</dt>
                            <dd class="w-2/3">{{ $user->name }}</dd>
                        </div>
                        <div class="flex border-b pb-3">
                            <dt class="w-1/3 font-semibold text-gray-600">Correo Electrónico</dt>
                            <dd class="w-2/3">{{ $user->email }}</dd>
                        </div>
                        <div class="flex border-b pb-3">
                            <dt class="w-1/3 font-semibold text-gray-600">Teléfono</dt>
                            <dd class="w-2/3">{{ $user->telefono ?? 'No registrado' }}</dd>
                        </div>
                        <div class="flex border-b pb-3">
                            <dt class="w-1/3 font-semibold text-gray-600">Rol</dt>
                            <dd class="w-2/3">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold
                                    {{ $user->esAdministrador() ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                                    {{ $user->esAdministrador() ? 'Administrador' : 'Trabajador' }}
                                </span>
                            </dd>
                        </div>
                        <div class="flex border-b pb-3">
                            <dt class="w-1/3 font-semibold text-gray-600">Estado</dt>
                            <dd class="w-2/3">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold
                                    {{ $user->esActivo() ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $user->esActivo() ? 'Activo' : 'Inactivo' }}
                                </span>
                            </dd>
                        </div>
                        <div class="flex border-b pb-3">
                            <dt class="w-1/3 font-semibold text-gray-600">Registrado</dt>
                            <dd class="w-2/3">{{ $user->created_at->format('d/m/Y H:i') }}</dd>
                        </div>
                        <div class="flex pb-3">
                            <dt class="w-1/3 font-semibold text-gray-600">Última actualización</dt>
                            <dd class="w-2/3">{{ $user->updated_at->format('d/m/Y H:i') }}</dd>
                        </div>
                    </dl>

                    <div class="mt-6 flex items-center justify-end gap-4">
                        <a href="{{ route('admin.users.index') }}"
                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                            Volver
                        </a>
                        @if ($user->id !== Auth::user()->id)
                            <a href="{{ route('admin.users.edit', $user) }}"
                                class="px-4 py-2 bg-cyan-600 text-white rounded-md hover:bg-cyan-700">
                                Editar
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
