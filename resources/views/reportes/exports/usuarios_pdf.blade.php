@php
    $titulo = 'Reporte de Usuarios';
    $headers = ['Nombre', 'Email', 'Rol', 'Teléfono', 'Estado', 'Registro'];
@endphp
@extends('reportes.exports._layout_pdf')
@section('slot')
    @forelse($data as $row)
        <tr>
            <td>{{ $row->name }}</td>
            <td>{{ $row->email }}</td>
            <td>{{ ucfirst($row->rol) }}</td>
            <td>{{ $row->telefono ?? '-' }}</td>
            <td>{{ ucfirst($row->status) }}</td>
            <td>{{ $row->created_at->format('d/m/Y') }}</td>
        </tr>
    @empty
        <tr><td colspan="6" style="text-align:center;">No hay registros.</td></tr>
    @endforelse
@endsection
