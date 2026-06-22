@php
    $titulo = 'Reporte de Lagos';
    $headers = ['Nombre', 'Ubicación', 'Tamaño (m²)', 'Profundidad (m)', 'Capacidad Máx.', 'Estado', 'Especies', 'Registro'];
@endphp
@extends('reportes.exports._layout_pdf')
@section('slot')
    @forelse($data as $row)
        <tr>
            <td>{{ $row->nombre }}</td>
            <td>{{ $row->ubicacion ?? '-' }}</td>
            <td>{{ number_format($row->tamano, 2) }}</td>
            <td>{{ number_format($row->profundidad, 2) }}</td>
            <td>{{ $row->capacidad_maxima_peces }}</td>
            <td>{{ ucfirst($row->estado) }}</td>
            <td>{{ $row->especies_count ?? $row->especies->count() }}</td>
            <td>{{ $row->created_at->format('d/m/Y') }}</td>
        </tr>
    @empty
        <tr><td colspan="8" style="text-align:center;">No hay registros.</td></tr>
    @endforelse
@endsection
