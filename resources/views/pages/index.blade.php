<x-webmixx::layout>
    <x-webmixx::title-header>
        <x-slot name="buttons">
            <a href="{{ route('webmixx.pages.create') }}" class="btn btn-sm btn-outline-success"><i class="fas fa-plus"></i></a>
        </x-slot>
        Pages
    </x-webmixx::title-header>
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Page Template</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($pages as $page)
            <tr>
                <td>
                    <a href="{{ route('webmixx.preview', [$moduleName, $page->id]) }}">{{ $page->name }}</a>
                </td>
                <td>
                    {{ $page->pageTemplate->name }}
                </td>
                <td class="col-auto text-right">
                    <a class="btn btn-sm btn-outline-primary" href="{{ route('webmixx.pages.edit', $page) }}"><i class="far fa-edit"></i></a>
                    <x-webmixx::post-link>
                        <x-slot name="url">{{ route('webmixx.pages.destroy', $page) }}</x-slot>
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
            <td colspan="3">
                {!! $pages->links() !!}
            </td>
        </tr>
        </tfoot>
    </table>
</x-webmixx::layout>
