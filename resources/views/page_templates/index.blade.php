<x-webmixx::layout>
    <x-webmixx::title-header>
        <x-slot name="buttons">
            <a href="{{ route('webmixx.page_templates.create') }}" class="btn btn-sm btn-outline-success"><i class="fas fa-plus"></i></a>
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
                <td class="col-auto text-right">
                    <x-webmixx::post-link>
                        <x-slot name="url">{{ route('webmixx.page_templates.destroy', $pageTemplate) }}</x-slot>
                        <x-slot name="method">delete</x-slot>
                        <x-slot name="classes">btn btn-sm btn-outline-danger</x-slot>
                        <i class="fas fa-trash-alt"></i>
                    </x-webmixx::post-link>
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
