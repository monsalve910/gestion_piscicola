@props(['status'])

@if ($status)
    <x-toast type="success" :message="$status" />
@endif
