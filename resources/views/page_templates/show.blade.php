<x-webmixx::layout :without_vue="true">
    <x-webmixx::title-header>
        <x-slot name="buttons">
            <a href="{{ route('webmixx.page_template.index') }}" class="btn btn-sm btn-primary">Back</a>
        </x-slot>
        Page Template: {{ $pageTemplate->name }}
    </x-webmixx::title-header>
    <code style="white-space: pre-line">
        {!! '&#123;&#123;' !!} $page->name {!! '&#125;&#125;' !!}
        @foreach($pageTemplate->rootPageAttributeTemplates as $pageAttributeTemplate)
            @include('webmixx::page_templates.page_attribute_template', [
                'pageAttributeTemplate' => $pageAttributeTemplate,
                'base' => '$page'
            ])
        @endforeach
    </code>
</x-webmixx::layout>
