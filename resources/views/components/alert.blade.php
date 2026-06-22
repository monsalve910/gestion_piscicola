@props([
    'type' => 'info',
    'message' => '',
    'dismissible' => true,
])

@php
    $config = [
        'success' => [
            'border' => 'border-l-emerald-500',
            'bg' => 'bg-emerald-50',
            'text' => 'text-emerald-800',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>',
        ],
        'error' => [
            'border' => 'border-l-red-500',
            'bg' => 'bg-red-50',
            'text' => 'text-red-800',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>',
        ],
        'warning' => [
            'border' => 'border-l-amber-500',
            'bg' => 'bg-amber-50',
            'text' => 'text-amber-800',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>',
        ],
        'info' => [
            'border' => 'border-l-blue-500',
            'bg' => 'bg-blue-50',
            'text' => 'text-blue-800',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
        ],
    ][$type];
@endphp

<div x-data="{ show: true }" x-show="show" x-cloak
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 -translate-y-2"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 -translate-y-2"
    class="mb-4 rounded-xl border border-gray-200/80 border-l-4 shadow-sm {{ $config['border'] }} {{ $config['bg'] }}"
    role="alert">
    <div class="flex items-start p-4">
        <div class="flex-shrink-0">
            <svg class="h-5 w-5 {{ $config['text'] }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                {!! $config['icon'] !!}
            </svg>
        </div>
        <div class="ml-3 flex-1 min-w-0">
            <p class="text-sm font-medium {{ $config['text'] }}">
                {{ $message }}
            </p>
        </div>
        @if ($dismissible)
            <div class="ml-auto pl-3">
                <button @click="show = false" type="button"
                    class="inline-flex rounded-lg p-1.5 {{ $config['text'] }} hover:bg-white/70 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 transition-colors">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        @endif
    </div>
</div>
