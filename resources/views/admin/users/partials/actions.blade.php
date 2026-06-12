<div class="flex items-center gap-2">
    <a href="{{ route('admin.users.show', $user) }}"
        class="text-cyan-600 hover:text-cyan-900 text-sm font-medium">
        Ver
    </a>
    <a href="{{ route('admin.users.edit', $user) }}"
        class="text-blue-600 hover:text-blue-900 text-sm font-medium">
        Editar
    </a>
    @if ($user->id !== Auth::user()->id)
        <button type="button"
            onclick="window.dispatchEvent(new CustomEvent('open-modal', { detail: 'toggle-status-{{ $user->id }}' }))"
            class="text-sm font-medium {{ $user->esActivo() ? 'text-red-600 hover:text-red-900' : 'text-green-600 hover:text-green-900' }}">
            {{ $user->esActivo() ? 'Desactivar' : 'Activar' }}
        </button>

        <x-modal name="toggle-status-{{ $user->id }}" :show="false" maxWidth="md">
            <div class="p-6">
                <div class="flex items-start gap-3">
                    <div class="shrink-0 {{ $user->esActivo() ? 'text-red-500' : 'text-green-500' }}">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">
                            {{ $user->esActivo() ? 'Desactivar Usuario' : 'Activar Usuario' }}
                        </h2>
                        <p class="mt-2 text-sm text-gray-600">
                            ¿Estás seguro de que deseas <strong>{{ $user->esActivo() ? 'desactivar' : 'activar' }}</strong>
                            al usuario <strong>{{ $user->name }}</strong>?
                        </p>
                        <p class="mt-1 text-xs text-gray-400">
                            {{ $user->esActivo() ? 'El usuario no podrá iniciar sesión hasta que sea activado nuevamente.' : 'El usuario podrá iniciar sesión una vez activado.' }}
                        </p>
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <x-secondary-button @click="$dispatch('close-modal', 'toggle-status-{{ $user->id }}')">
                        Cancelar
                    </x-secondary-button>
                    <form method="POST" action="{{ route('admin.users.toggle-status', $user) }}" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150
                            {{ $user->esActivo()
                                ? 'bg-red-600 hover:bg-red-500 active:bg-red-700 focus:ring-red-500'
                                : 'bg-green-600 hover:bg-green-500 active:bg-green-700 focus:ring-green-500' }}">
                            <svg class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ $user->esActivo() ? 'Sí, desactivar' : 'Sí, activar' }}
                        </button>
                    </form>
                </div>
            </div>
        </x-modal>
    @endif
</div>
