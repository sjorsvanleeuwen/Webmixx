<x-webmixx::layout>
    <x-webmixx::title-header>
        <x-slot name="buttons">
            <a href="{{ route('webmixx.page_templates.create') }}" class="btn btn-sm btn-primary">Add</a>
        </x-slot>
        Page Templates
    </x-webmixx::title-header>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach($pageTemplates as $pageTemplate)
            <tr>
                <td>
                    <a href="{{ route('webmixx.page_templates.show', $pageTemplate) }}">{{ $pageTemplate->name }}</a>
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="2">
                {!! $pageTemplates->links() !!}
            </td>
        </tr>
        </tfoot>
    </table>
</x-webmixx::layout>
