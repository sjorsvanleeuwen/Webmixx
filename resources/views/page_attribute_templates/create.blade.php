<x-webmixx::layout>
    <x-webmixx::title-header>
        Add Page Attribute Template
    </x-webmixx::title-header>
    <form method="post" action="{{ route('webmixx.page_attribute_templates.store') }}">
        @csrf
        <x-webmixx-forms:select name="page_template_id" label="Page Template" :options="$pageTemplates->toArray()" :emptyFirst="true" />
        <x-webmixx-forms:select name="page_attribute_template_id" label="Parent Page Attribute Template" :options="$pageAttributeTemplates->toArray()" :emptyFirst="true" :allowEmpty="true" />
        <x-webmixx-forms:input-text name="name" label="Naam"/>
        <x-webmixx-forms:select name="field_type" label="Field Type" :options="$fieldTypes->toArray()" />
        <x-webmixx-forms:input-checkbox name="repeatable" label="Repeatable"/>
        <x-webmixx-forms:form-buttons />
    </form>
</x-webmixx::layout>
