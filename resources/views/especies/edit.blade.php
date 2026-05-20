<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Especie</title>

    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-8">

    <div class="max-w-xl mx-auto bg-white p-8 rounded-xl shadow-lg">

        <h1 class="text-3xl font-bold mb-6 text-gray-800">
            Editar Especie
        </h1>

        <form action="{{ route('especies.update', $especie->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block mb-2 font-semibold">
                    Nombre
                </label>

                <input type="text"
                       name="nombre"
                       value="{{ $especie->nombre }}"
                       class="w-full border rounded-lg p-3">
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-semibold">
                    Descripción
                </label>

                <input type="text"
                       name="descripcion"
                       value="{{ $especie->descripcion }}"
                       class="w-full border rounded-lg p-3">
            </div>

            <div class="mb-4">
                <label class="block mb-2 font-semibold">
                    Cantidad
                </label>

                <input type="number"
                       name="cantidad"
                       value="{{ $especie->cantidad }}"
                       class="w-full border rounded-lg p-3">
            </div>

            <div class="mb-6">
                <label class="block mb-2 font-semibold">
                    Lago ID
                </label>

                <input type="number"
                       name="lago_id"
                       value="{{ $especie->lago_id }}"
                       class="w-full border rounded-lg p-3">
            </div>

            <div class="flex gap-3">

                <button type="submit"
                        class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700">
                    Actualizar
                </button>

                <a href="{{ route('especies.index') }}"
                   class="bg-gray-500 text-white px-5 py-2 rounded-lg hover:bg-gray-600">
                    Volver
                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html>
