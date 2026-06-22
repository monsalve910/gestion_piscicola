<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $titulo ?? 'Reporte' }}</title>
    <style>
        @page { margin: 20mm 15mm 20mm 15mm; }
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 10pt; color: #333; }
        .header { text-align: center; border-bottom: 2px solid #0E7490; padding-bottom: 8px; margin-bottom: 15px; }
        .header h1 { color: #0E7490; font-size: 18pt; margin: 0 0 4px 0; }
        .header .sub { color: #666; font-size: 8pt; }
        .info-bar { font-size: 8pt; color: #555; margin-bottom: 12px; display: flex; justify-content: space-between; }
        .info-bar .left { text-align: left; }
        .info-bar .right { text-align: right; }
        table { width: 100%; border-collapse: collapse; font-size: 8pt; }
        th { background-color: #0E7490; color: white; padding: 6px 4px; text-align: left; font-weight: bold; }
        td { padding: 4px; border-bottom: 1px solid #ddd; }
        tr:nth-child(even) td { background-color: #f8fafc; }
        .summary { margin-bottom: 15px; }
        .summary table { width: auto; }
        .summary td { padding: 4px 12px; border: 1px solid #ccc; background: #f0fdf4; font-size: 8pt; }
        .summary td.label { font-weight: bold; background: #e0f2fe; }
        .footer { position: fixed; bottom: 0; left: 0; right: 0; text-align: center; font-size: 7pt; color: #999; border-top: 1px solid #ddd; padding-top: 4px; }
        .footer .pagenum:before { content: "Página " counter(page); }
    </style>
</head>
<body>
    <div class="header">
        <h1>Sistema de Gestión Piscícola</h1>
        <div class="sub">{{ $titulo ?? 'Reporte' }}</div>
    </div>

    <div class="info-bar">
        <div class="left">
            <strong>Generado por:</strong> {{ $usuario->name }} ({{ $usuario->email }})<br>
            <strong>Rol:</strong> {{ ucfirst($usuario->rol) }}
        </div>
        <div class="right">
            <strong>Fecha:</strong> {{ $fechaGeneracion }}<br>
            <strong>Registros:</strong> {{ $data->count() }}
        </div>
    </div>

    @if(!empty($resumen))
    <div class="summary">
        <table>
            <tr>
                @foreach($resumen as $label => $value)
                    <td class="label">{{ $label }}</td>
                    <td>{{ $value }}</td>
                @endforeach
            </tr>
        </table>
    </div>
    @endif

    <table>
        <thead>
            <tr>
                @foreach($headers as $header)
                    <th>{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @yield('slot')
        </tbody>
    </table>

    <div class="footer">
        <span class="pagenum"></span> &mdash; {{ $titulo ?? 'Reporte' }} &mdash; {{ $fechaGeneracion }}
    </div>
</body>
</html>
