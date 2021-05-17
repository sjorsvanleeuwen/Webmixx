<x-webmixx::layout>
    <x-webmixx::title-header>
        Edit Page "{{ $page->name }}"
    </x-webmixx::title-header>
    <vue-page-form :page-id="{{ $page->id }}"/>
</x-webmixx::layout>
