<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <title>Registrar Reproducción</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

<div class="max-w-2xl mx-auto mt-10 bg-white p-8 rounded-xl shadow">

    <h1 class="text-3xl font-bold mb-6">

        Registrar Reproducción

    </h1>

    <form action="{{ route('reproducciones.store') }}"
          method="POST">

        @csrf

        <div class="mb-4">

            <label class="block mb-2">

                Especie

            </label>

            <select name="especie_id"
                    class="w-full border p-3 rounded">

                @foreach($especies as $e)

                    <option value="{{ $e->id }}">

                        {{ $e->nombre }}

                    </option>

                @endforeach

            </select>

        </div>

        <div class="mb-4">

            <label class="block mb-2">

                Fecha

            </label>

            <input type="date"
                   name="fecha"
                   class="w-full border p-3 rounded">

        </div>

        <div class="mb-4">

            <label class="block mb-2">

                Cantidad

            </label>

            <input type="number"
                   name="cantidad"
                   class="w-full border p-3 rounded">

        </div>

        <div class="mb-6">

            <label class="block mb-2">

                Observaciones

            </label>

            <textarea name="observaciones"
                      class="w-full border p-3 rounded"></textarea>

        </div>

        <div class="flex gap-3">

    <button type="submit"
            class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">

        Guardar

    </button>

    <a href="{{ route('reproducciones.index') }}"
       class="bg-gray-500 text-white px-5 py-2 rounded hover:bg-gray-600">

        Volver

    </a>

</div>

    </form>

</div>

</body>
</html>