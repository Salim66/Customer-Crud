<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Development Area')</title>
    <meta name="csrf_token" content="{{ csrf_token() }}">
    @include('backend.layout.partials.styles')
</head>