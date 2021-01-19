<x-webmixx::layout>
    <x-webmixx::title-header>
        Add Page
    </x-webmixx::title-header>
    <form method="post" action="{{ route('webmixx.pages.store') }}">
        @csrf
        <x-webmixx-forms:input-text name="name" label="Naam"/>
        <x-webmixx-forms:select name="page_template_id" label="Page Template" :options="$pageTemplates->toArray()" :emptyFirst="true" />
        <x-webmixx-forms:form-buttons />
    </form>
</x-webmixx::layout>
