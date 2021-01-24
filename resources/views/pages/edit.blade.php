<x-webmixx::layout>
    <x-webmixx::title-header>
        Edit Page "{{ $page->name }}"
    </x-webmixx::title-header>
    <page-form :page-id="{{ $page->id }}"/>
{{--    <form method="post" action="{{ route('webmixx.pages.update', $page) }}">--}}
{{--        @method('PUT')--}}
{{--        @csrf--}}
{{--        <x-webmixx-forms:input-text name="name" label="Naam" :value="$page->name"/>--}}
{{--        <x-webmixx-forms:select disabled="disabled" name="page_template_id" label="Page Template" :options="$pageTemplates" :emptyFirst="true" :value="$page->page_template_id" />--}}
{{--        @foreach($page->pageTemplate->rootPageAttributeTemplates as $rootPageAttributeTemplate)--}}
{{--            <x-webmixx-pages:page-attribute-template :pageTemplate="$page->pageTemplate" :pageAttributeTemplate="$rootPageAttributeTemplate" :pageAttributes="$page->pageAttributes"/>--}}
{{--        @endforeach--}}
{{--        <x-webmixx-forms:form-buttons />--}}
{{--    </form>--}}
</x-webmixx::layout>
