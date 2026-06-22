<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto space-y-6">
            <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200">
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200">
                @include('profile.partials.update-password-form')
            </div>

            <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-200">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
