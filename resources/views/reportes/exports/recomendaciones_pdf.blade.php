@php
    $titulo = 'Reporte de Recomendaciones';
    $headers = ['Lago', 'Mensaje', 'Tipo', 'Nivel Riesgo', 'Fecha'];
@endphp
@extends('reportes.exports._layout_pdf')
@section('slot')
    @forelse($data as $row)
        <tr>
            <td>{{ $row->lago->nombre ?? 'N/A' }}</td>
            <td>{{ $row->mensaje }}</td>
            <td>{{ ucfirst($row->tipo) }}</td>
            <td>{{ ucfirst($row->nivel_riesgo) }}</td>
            <td>{{ $row->created_at->format('d/m/Y') }}</td>
        </tr>
    @empty
        <tr><td colspan="5" style="text-align:center;">No hay registros.</td></tr>
    @endforelse
@endsection
