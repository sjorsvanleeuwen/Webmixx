<x-webmixx::layout>
    <x-webmixx::title-header>
        <x-slot name="buttons">
            <a href="{{ route('webmixx.menus.index') }}" class="btn btn-sm btn-outline-primary"><i class="fas fa-reply"></i></a>
        </x-slot>
        Menu "{{ $menu->name }}"
    </x-webmixx::title-header>
    <menu-builder class="mb-2" :menu-id="{{ $menu->id }}"></menu-builder>
</x-webmixx::layout>
