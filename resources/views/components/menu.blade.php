<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Webmixx</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('webmixx.dashboard') }}">Home</a>
                </li>
                @can('viewAny', \SjorsvanLeeuwen\Webmixx\Models\Page::class)
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('webmixx.pages.index') }}">Pages</a>
                    </li>
                @endcan
                @can('viewAny', \SjorsvanLeeuwen\Webmixx\Models\PageTemplate::class)
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('webmixx.page_templates.index') }}">Page Templates</a>
                    </li>
                @endcan
                @can('viewAny', \SjorsvanLeeuwen\Webmixx\Models\PageAttributeTemplate::class)
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('webmixx.page_attribute_templates.index') }}">Page Attribute Templates</a>
                    </li>
                @endcan
            </ul>
        </div>
    </div>
</nav>
