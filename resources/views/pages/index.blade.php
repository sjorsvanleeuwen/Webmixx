<x-webmixx::layout>
    <x-webmixx::title-header>
        <x-slot name="buttons">
            <a href="{{ route('webmixx.pages.create') }}" class="btn btn-sm btn-primary">Add</a>
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
                <td></td>
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
