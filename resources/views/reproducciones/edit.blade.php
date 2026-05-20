<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <title>Editar Reproducción</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100">

<div class="max-w-2xl mx-auto mt-10 bg-white p-8 rounded-xl shadow">

    <h1 class="text-3xl font-bold mb-6">

        Editar Reproducción

    </h1>

    <form action="{{ route('reproducciones.update', $reproduccion->id) }}"
          method="POST">

        @csrf
        @method('PUT')

        <div class="mb-4">

            <label class="block mb-2">

                Especie

            </label>

            <select name="especie_id"
                    class="w-full border p-3 rounded">

                @foreach($especies as $e)

                    <option value="{{ $e->id }}"
                        {{ $reproduccion->especie_id == $e->id ? 'selected' : '' }}>

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
                   value="{{ $reproduccion->fecha }}"
                   class="w-full border p-3 rounded">

        </div>

        <div class="mb-4">

            <label class="block mb-2">

                Cantidad

            </label>

            <input type="number"
                   name="cantidad"
                   value="{{ $reproduccion->cantidad }}"
                   class="w-full border p-3 rounded">

        </div>

        <div class="mb-6">

            <label class="block mb-2">

                Observaciones

            </label>

            <textarea name="observaciones"
                      class="w-full border p-3 rounded">{{ $reproduccion->observaciones }}</textarea>

        </div>

        <button type="submit"
                class="bg-green-600 text-white px-5 py-2 rounded">

            Actualizar

        </button>

    </form>

</div>

</body>
</html>