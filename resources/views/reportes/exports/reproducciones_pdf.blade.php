@php
    $titulo = 'Reporte de Reproducciones';
    $headers = ['Especie', 'Fecha', 'Cantidad', 'Observaciones'];
@endphp
@extends('reportes.exports._layout_pdf')
@section('slot')
    @forelse($data as $row)
        <tr>
            <td>{{ $row->especie->nombre ?? 'N/A' }}</td>
            <td>{{ $row->fecha->format('d/m/Y') }}</td>
            <td>{{ $row->cantidad }}</td>
            <td>{{ $row->observaciones ?? '-' }}</td>
        </tr>
    @empty
        <tr><td colspan="4" style="text-align:center;">No hay registros.</td></tr>
    @endforelse
@endsection
