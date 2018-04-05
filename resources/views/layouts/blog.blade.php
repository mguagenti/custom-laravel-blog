<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }} | {{ config('app.name', 'Blog')  }}</title>
    <meta name="description" content="{{ $meta_description }}">
    @if(!empty($author))
        <meta name="author" content="{{ $author }}">
    @endif

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Merriweather|Nanum+Gothic" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <main>
        <div class="nav">
            <div class="nav-brand">
                <a href="/">Awesome Blog!</a>
            </div>
            <ul class="nav-inner">
                <li><a href="/">Home</a></li>
                <li><a href="#">Recent Posts</a></li>
                <li><a href="#">Categories</a></li>
            </ul>
        </div>

        @yield('content')

    </main>
</body>
</html>
