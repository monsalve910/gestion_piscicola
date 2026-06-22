@forelse ($users as $user)
    <tr class="hover:bg-gray-50 transition-colors duration-150">
        <td class="px-4 py-3 font-medium">{{ $user->name }}</td>
        <td class="px-4 py-3">{{ $user->email }}</td>
        <td class="px-4 py-3">
            <span class="{{ $user->esAdministrador() ? 'badge-info' : 'badge-gray' }}">
                {{ $user->esAdministrador() ? 'Administrador' : 'Trabajador' }}
            </span>
        </td>
        <td class="px-4 py-3">
            <span class="{{ $user->esActivo() ? 'badge-success' : 'badge-danger' }}">
                {{ $user->esActivo() ? 'Activo' : 'Inactivo' }}
            </span>
        </td>
        <td class="px-4 py-3">{{ $user->created_at->format('d/m/Y') }}</td>
        <td class="px-4 py-3">
            @include('admin.users.partials.actions', ['user' => $user])
        </td>
    </tr>
@empty
    <tr>
        <td colspan="6" class="px-4 py-12">
            <div class="flex flex-col items-center justify-center text-gray-400">
                <svg class="h-12 w-12 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <p class="text-base font-medium text-gray-500">No se encontraron usuarios</p>
                <p class="text-sm mt-1">
                    @if ($search)
                        Intenta con otros términos de búsqueda.
                    @else
                        Aún no hay usuarios registrados.
                    @endif
                </p>
            </div>
        </td>
    </tr>
@endforelse
