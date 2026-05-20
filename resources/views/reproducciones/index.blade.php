<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <title>Reproducciones</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

<div class="container mx-auto p-8">

    <div class="flex justify-between items-center mb-6">

        <h1 class="text-3xl font-bold">
            Reproducciones
        </h1>

        <a href="{{ route('reproducciones.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded-lg">

            Nueva

        </a>

    </div>

    @if(session('success'))

        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">

            {{ session('success') }}

        </div>

    @endif

    <div class="bg-white rounded-xl shadow overflow-hidden">

        <table class="w-full">

            <thead class="bg-gray-200">

                <tr>

                    <th class="p-4 text-left">
                        Especie
                    </th>

                    <th class="p-4 text-left">
                        Fecha
                    </th>

                    <th class="p-4 text-left">
                        Cantidad
                    </th>

                    <th class="p-4 text-left">
                        Observaciones
                    </th>

                    <th class="p-4 text-center">
                        Acciones
                    </th>

                </tr>

            </thead>

            <tbody>

            @foreach($reproducciones as $r)

                <tr class="border-b">

                    <td class="p-4">

                        {{ $r->especie->nombre }}

                    </td>

                    <td class="p-4">

                        {{ $r->fecha }}

                    </td>

                    <td class="p-4">

                        {{ $r->cantidad }}

                    </td>

                    <td class="p-4">

                        {{ $r->observaciones }}

                    </td>

                    <td class="p-4">

                        <div class="flex gap-2 justify-center">

                            <a href="{{ route('reproducciones.edit', $r->id) }}"
                               class="bg-yellow-500 text-white px-3 py-1 rounded">

                                Editar

                            </a>

                            <form action="{{ route('reproducciones.destroy', $r->id) }}"
                                  method="POST">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="bg-red-600 text-white px-3 py-1 rounded">

                                    Eliminar

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</div>

</body>
</html>