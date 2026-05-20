<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Especies</title>

    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-8">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">
            Listado de Especies
        </h1>

        <a href="{{ route('especies.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            Nueva Especie
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-lg rounded-xl overflow-hidden">

        <table class="w-full">

            <thead class="bg-gray-200">
                <tr>
                    <th class="p-4 text-left">ID</th>
                    <th class="p-4 text-left">Nombre</th>
                    <th class="p-4 text-left">Descripción</th>
                    <th class="p-4 text-left">Cantidad</th>
                    <th class="p-4 text-left">Lago ID</th>
                    <th class="p-4 text-center">Acciones</th>
                </tr>
            </thead>

            <tbody>

            @foreach($especies as $e)

                <tr class="border-b">

                    <td class="p-4">{{ $e->id }}</td>
                    <td class="p-4">{{ $e->nombre }}</td>
                    <td class="p-4">{{ $e->descripcion }}</td>
                    <td class="p-4">{{ $e->cantidad }}</td>
                    <td class="p-4">{{ $e->lago_id }}</td>

                    <td class="p-4 flex gap-2 justify-center">

                        <a href="{{ route('especies.edit', $e->id) }}"
                           class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                            Editar
                        </a>

                        <form action="{{ route('especies.destroy', $e->id) }}"
                              method="POST">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                Eliminar
                            </button>

                        </form>

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</div>

</body>
</html>