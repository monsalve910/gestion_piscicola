<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MonitoreosExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithEvents, ShouldAutoSize
{
    protected Collection $data;

    public function __construct(Collection $data)
    {
        $this->data = $data;
    }

    public function collection(): Collection
    {
        return $this->data;
    }

    public function headings(): array
    {
        return ['Lago', 'Fecha Monitoreo', 'Temperatura (°C)', 'pH', 'Oxígeno (mg/L)', 'Estado'];
    }

    public function map($monitoreo): array
    {
        return [
            $monitoreo->lago->nombre ?? 'N/A',
            $monitoreo->fecha_monitoreo->format('d/m/Y'),
            number_format($monitoreo->temperatura_agua, 2),
            number_format($monitoreo->ph, 2),
            number_format($monitoreo->nivel_oxigeno, 2),
            ucfirst($monitoreo->estado_general),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [1 => ['font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']], 'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '0E7490']]]];
    }

    public function registerEvents(): array
    {
        return [AfterSheet::class => function (AfterSheet $event) {
            $event->sheet->getDelegate()->setAutoFilter('A1:F' . ($this->data->count() + 1));
        }];
    }
}
