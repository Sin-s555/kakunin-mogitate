<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">

    @if (Request::routeIs('products.index'))
        <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    @elseif (Request::routeIs('products.show'))
        <link rel="stylesheet" href="{{ asset('css/show.css') }}">
    @elseif (Request::routeIs('products.create'))
        <link rel="stylesheet" href="{{ asset('css/create.css') }}">
    @endif
</head>
<body>
    @yield('content')
</body>
</html>
