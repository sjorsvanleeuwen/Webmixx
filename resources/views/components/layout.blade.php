<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="/vendor/webmixx/css/webmixx.css">
    <link rel="shortcut icon" href="data:image/x-icon;," type="image/x-icon">
    <title>Webmixx</title>
</head>
<body>
    <x-webmixx::menu />
    <div class="container" id="app">
        {!! $slot !!}
    </div>
    <script src="/vendor/webmixx/js/manifest.js" defer></script>
    <script src="/vendor/webmixx/js/vendor.js" defer></script>
    <script src="/vendor/webmixx/js/webmixx.js" defer></script>
</body>
</html>
