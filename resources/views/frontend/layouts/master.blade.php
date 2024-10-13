<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('images/favicon.png') }}">
    @includeIf('frontend.layouts._head_css')
</head>

<body>
    @yield('content')

    @includeIf('frontend.layouts._footer_js')
</body>
</html>
