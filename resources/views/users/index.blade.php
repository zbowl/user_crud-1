<x-main-layout>
    <x-slot name="title">
        {{ __('Users') }}
    </x-slot>
    <x-slot name="slot">
        @livewire('user.manage-users')
    </x-slot>
</x-main-layout>
