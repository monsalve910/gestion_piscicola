@php
    $titulo = 'Reporte de Especies';
    $headers = ['Nombre', 'Descripción', 'Cantidad', 'Precio', 'Lago', 'Fecha Registro'];
@endphp
@extends('reportes.exports._layout_pdf')
@section('slot')
    @forelse($data as $row)
        <tr>
            <td>{{ $row->nombre }}</td>
            <td>{{ $row->descripcion ?? '-' }}</td>
            <td>{{ $row->cantidad }}</td>
            <td>${{ number_format($row->precio, 2) }}</td>
            <td>{{ $row->lago->nombre ?? 'N/A' }}</td>
            <td>{{ $row->created_at->format('d/m/Y') }}</td>
        </tr>
    @empty
        <tr><td colspan="6" style="text-align:center;">No hay registros.</td></tr>
    @endforelse
@endsection
