<x-webmixx::layout>
    <x-webmixx::title-header>
        <x-slot name="buttons">
            <a href="{{ route('webmixx.menus.create') }}" class="btn btn-sm btn-outline-success"><i class="fas fa-plus"></i></a>
        </x-slot>
        Menus
    </x-webmixx::title-header>
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($menus as $menu)
            <tr>
                <td>
                    <a href="{{ route('webmixx.menus.show', $menu) }}">{{ $menu->name }}</a>
                </td>
                <td class="col-auto text-right">
                    <x-webmixx::post-link>
                        <x-slot name="url">{{ route('webmixx.menus.destroy', $menu) }}</x-slot>
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
                {!! $menus->links() !!}
            </td>
        </tr>
        </tfoot>
    </table>
</x-webmixx::layout>
