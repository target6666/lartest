<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token", content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">

</head>
<body>
    <div id="app">
        @include('inc.navbar')
        <div class="container">
            @include('inc.message')
            @yield('content')
        </div>
    </div>

    <!-- Scripts  -->

    <script>window.Laravel={ csrfToken: '{{ csrf_token()}}'}</script>
    <script src="/js/app.js"></script>
</body>
</html>