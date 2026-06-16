<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMonitoreoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'fecha_monitoreo' => ['required', 'date'],
            'temperatura_agua' => ['nullable', 'numeric', 'min:-10', 'max:50'],
            'ph' => ['nullable', 'numeric', 'min:0', 'max:14'],
            'nivel_oxigeno' => ['nullable', 'numeric', 'min:0', 'max:20'],
            'estado_general' => ['required', 'string', 'in:bueno,regular,malo'],
            'observaciones' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'fecha_monitoreo.required' => 'La fecha del monitoreo es obligatoria.',
            'estado_general.required' => 'Debe seleccionar un estado general.',
            'estado_general.in' => 'El estado general seleccionado no es válido.',
        ];
    }
}
