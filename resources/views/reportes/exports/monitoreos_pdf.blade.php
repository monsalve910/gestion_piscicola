@php
    $titulo = 'Reporte de Monitoreos';
    $headers = ['Lago', 'Fecha', 'Temp (°C)', 'pH', 'Oxígeno (mg/L)', 'Estado'];
@endphp
@extends('reportes.exports._layout_pdf')
@section('slot')
    @forelse($data as $row)
        <tr>
            <td>{{ $row->lago->nombre ?? 'N/A' }}</td>
            <td>{{ $row->fecha_monitoreo->format('d/m/Y') }}</td>
            <td>{{ number_format($row->temperatura_agua, 2) }}</td>
            <td>{{ number_format($row->ph, 2) }}</td>
            <td>{{ number_format($row->nivel_oxigeno, 2) }}</td>
            <td>{{ ucfirst($row->estado_general) }}</td>
        </tr>
    @empty
        <tr><td colspan="6" style="text-align:center;">No hay registros.</td></tr>
    @endforelse
@endsection
