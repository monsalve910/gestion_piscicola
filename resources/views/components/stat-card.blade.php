@props(['title', 'value', 'icon', 'color' => 'cyan', 'subtitle' => null])

@php
    $colors = [
        'cyan' => 'from-cyan-500 to-cyan-600',
        'teal' => 'from-teal-500 to-teal-600',
        'blue' => 'from-blue-500 to-blue-600',
        'indigo' => 'from-indigo-500 to-indigo-600',
        'purple' => 'from-purple-500 to-purple-600',
        'pink' => 'from-pink-500 to-pink-600',
        'red' => 'from-red-500 to-red-600',
        'orange' => 'from-orange-500 to-orange-600',
        'green' => 'from-green-500 to-green-600',
        'yellow' => 'from-yellow-500 to-yellow-600',
    ];
    $gradient = $colors[$color] ?? $colors['cyan'];
@endphp

<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 card-hover">
    <div class="flex items-center gap-4">
        <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-gradient-to-br {{ $gradient }} text-white shrink-0">
            {!! $icon !!}
        </div>
        <div class="min-w-0">
            <p class="text-sm font-medium text-gray-500 truncate">{{ $title }}</p>
            <p class="text-2xl font-bold text-gray-900 mt-0.5">{{ $value }}</p>
            @if($subtitle)
                <p class="text-xs text-gray-400 mt-0.5">{{ $subtitle }}</p>
            @endif
        </div>
    </div>
</div>
