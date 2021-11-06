<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('/vendor/webmixx/css/webmixx.css') }}">
    <link rel="shortcut icon" href="data:image/x-icon;," type="image/x-icon">
    <title>Webmixx</title>
</head>
<body>
    <x-webmixx::menu />
    <div class="container @if(isset($withoutVue) && $withoutVue === true) no-vue @endif" id="app">
        {!! $slot !!}
    </div>
    <div class="lh-lg position-fixed bottom-0 w-100 text-center bg-dark text-light">
        Powered by Webmixx
    </div>
    <script src="{{ asset('vendor/webmixx/js/manifest.js') }}" defer></script>
    <script src="{{ asset('/vendor/webmixx/js/vendor.js') }}" defer></script>
    <script src="{{ asset('/vendor/webmixx/js/webmixx.js') }}" defer></script>
</body>
</html>
