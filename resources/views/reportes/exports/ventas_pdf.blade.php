@php
    $titulo = 'Reporte de Ventas';
    $headers = ['Fecha', 'Especie', 'Peso (kg)', 'Precio por kg', 'Total'];
@endphp
@extends('reportes.exports._layout_pdf')
@section('slot')
    @forelse($data as $row)
        <tr>
            <td>{{ $row->fecha_venta->format('d/m/Y') }}</td>
            <td>{{ $row->especie->nombre ?? 'N/A' }}</td>
            <td>{{ number_format($row->peso_kg, 2) }}</td>
            <td>${{ number_format($row->precio_unitario, 2) }}</td>
            <td>${{ number_format($row->total, 2) }}</td>
        </tr>
    @empty
        <tr><td colspan="5" style="text-align:center;">No hay registros.</td></tr>
    @endforelse
@endsection
