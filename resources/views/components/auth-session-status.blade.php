@props(['status'])

@if ($status)
    <x-alert type="info" :message="$status" :dismissible="true" />
@endif
