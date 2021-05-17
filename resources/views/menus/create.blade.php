<x-webmixx::layout>
    <x-webmixx::title-header>
        Add Menu
    </x-webmixx::title-header>
    <form method="post" action="{{ route('webmixx.menu.store') }}">
        @csrf
        <x-webmixx-forms:input-text name="name" label="Naam"/>
        <x-webmixx-forms:form-buttons />
    </form>
</x-webmixx::layout>
