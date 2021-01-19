<x-webmixx::layout>
    <x-webmixx::title-header>
        <x-slot name="buttons">
            <a href="{{ route('webmixx.page_attribute_templates.create') }}" class="btn btn-sm btn-primary">Add</a>
        </x-slot>
        Page Attribute Templates
    </x-webmixx::title-header>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Page Template</th>
                <th>Parent Page Attribute Template</th>
                <th>Field type</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach($pageAttributeTemplates as $pageAttributeTemplate)
            <tr>
                <td>
                    {{ $pageAttributeTemplate->name }}
                </td>
                <td>
                    {{ $pageAttributeTemplate->pageTemplate->name }}
                </td>
                <td>
                    {{ optional($pageAttributeTemplate->pageAttributeTemplate)->name }}
                </td>
                <td>
                    {{ $pageAttributeTemplate->field_type }}
                </td>
                <td></td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="5">
                {!! $pageAttributeTemplates->links() !!}
            </td>
        </tr>
        </tfoot>
    </table>
</x-webmixx::layout>
