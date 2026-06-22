@if (!empty($resumen))
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
    <div class="p-4">
        <h3 class="text-sm font-semibold text-gray-700 mb-3">Resumen</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach ($resumen as $label => $value)
                @php
                    $isMonetary = str_contains($label, 'Precio') || str_contains($label, 'Ingreso');
                    $isCount = str_contains($label, 'Total') && !str_contains($label, 'Precio') && !str_contains($label, 'Ingreso');
                @endphp
                <div class="bg-cyan-50 border border-cyan-200 rounded-lg p-3 text-center">
                    <div class="text-xs text-gray-500 uppercase tracking-wide">{{ $label }}</div>
                    <div class="text-lg font-bold text-cyan-700 mt-1">
                        @if ($isMonetary)
                            ${{ number_format((float)$value, 2) }}
                        @else
                            {{ $value }}
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif
