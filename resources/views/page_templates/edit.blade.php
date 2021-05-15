<x-webmixx::layout>
    <x-webmixx::title-header>
        Edit Page Template "{{ $pageTemplate->name }}"
    </x-webmixx::title-header>
    <vue-webmixx-page-template-form :page-template-id="{{ $pageTemplate->id }}"/>
</x-webmixx::layout>
