<x-webmixx::layout>
    <x-webmixx::title-header>
        <x-slot name="buttons">
            <a href="{{ route('webmixx.page_template.create') }}" class="btn btn-sm btn-outline-success"><i class="fas fa-plus"></i></a>
        </x-slot>
        Page Templates
    </x-webmixx::title-header>
    <table class="table">
        <caption>
            {!! $pageTemplates->links() !!}
        </caption>
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
                    <a href="{{ route('webmixx.page_template.show', $pageTemplate) }}">{{ $pageTemplate->name }}</a>
                </td>
                <td class="text-end">
                    <a class="btn btn-sm btn-outline-primary" href="{{ route('webmixx.page_template.edit', $pageTemplate) }}"><i class="far fa-edit"></i></a>
                    <x-webmixx::post-link>
                        <x-slot name="url">{{ route('webmixx.page_template.destroy', $pageTemplate) }}</x-slot>
                        <x-slot name="method">delete</x-slot>
                        <x-slot name="classes">btn btn-sm btn-outline-danger</x-slot>
                        <i class="fas fa-trash-alt"></i>
                    </x-webmixx::post-link>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-webmixx::layout>
