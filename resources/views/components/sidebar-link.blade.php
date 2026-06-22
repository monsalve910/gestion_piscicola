@props(['href', 'active' => false, 'icon' => null])

<a href="{{ $href }}"
   x-data
   :title="!$store.sidebar.open ? '{{ $slot }}' : ''"
   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium transition-all duration-200 whitespace-nowrap
          {{ $active ? 'bg-white/20 text-white shadow-sm' : 'text-white/70 hover:bg-white/10 hover:text-white' }}">
    @if($icon)
        <span class="shrink-0">{!! $icon !!}</span>
    @endif
    <span x-show="$store.sidebar.open"
          x-transition:enter="transition ease-out duration-200"
          x-transition:enter-start="opacity-0"
          x-transition:enter-end="opacity-100"
          class="truncate">
        {{ $slot }}
    </span>
</a>
