<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Webmixx</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{ route('webmixx.dashboard') }}">Home</a>
            </li>
            @can('viewAny', \SjorsvanLeeuwen\Webmixx\Models\Menu::class)
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('webmixx.menu.index') }}">Menus</a>
                </li>
            @endcan
            @can('viewAny', \SjorsvanLeeuwen\Webmixx\Models\Page::class)
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('webmixx.page.index') }}">Pages</a>
                </li>
            @endcan
            @can('viewAny', \SjorsvanLeeuwen\Webmixx\Models\PageTemplate::class)
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('webmixx.page_template.index') }}">Page Templates</a>
                </li>
            @endcan
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="/">View website</a>
            </li>
        </ul>
    </div>
</nav>
