<x-webmixx::layout>
    <x-webmixx::title-header>
        Add Page Template
    </x-webmixx::title-header>
    <form method="post" action="{{ route('webmixx.page_templates.store') }}">
        @csrf
        <x-webmixx-forms:input-text name="name" label="Naam"/>
        <x-webmixx-forms:input-checkbox name="repeatable" label="Repeatable"/>
        <x-webmixx-forms:form-buttons />
    </form>
</x-webmixx::layout>
