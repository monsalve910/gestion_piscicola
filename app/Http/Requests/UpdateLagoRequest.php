<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLagoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:255'],
            'ubicacion' => ['nullable', 'string', 'max:255'],
            'tamano' => ['nullable', 'numeric', 'min:0'],
            'profundidad' => ['nullable', 'numeric', 'min:0'],
            'capacidad_maxima_peces' => ['nullable', 'integer', 'min:0'],
            'estado' => ['required', 'string', 'in:activo,inactivo'],
            'observaciones' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del lago es obligatorio.',
            'estado.required' => 'Debe seleccionar un estado.',
            'estado.in' => 'El estado seleccionado no es válido.',
        ];
    }
}
