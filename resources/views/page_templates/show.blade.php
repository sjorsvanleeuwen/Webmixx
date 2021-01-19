<x-webmixx::layout>
    <x-webmixx::title-header>
        <x-slot name="buttons">
            <a href="{{ route('webmixx.page_templates.index') }}" class="btn btn-sm btn-primary">Back</a>
        </x-slot>
        Page Template: {{ $pageTemplate->name }}
    </x-webmixx::title-header>
    <code style="white-space: pre-line">
        {{ '{{' }} $page->name {!! '}}' !!}
        @foreach($pageTemplate->rootPageAttributeTemplates as $pageAttributeTemplate)
            @include('webmixx::page_templates.page_attribute_template', [
                'pageAttributeTemplate' => $pageAttributeTemplate,
                'base' => '$page'
            ])
        @endforeach
    </code>
</x-webmixx::layout>
