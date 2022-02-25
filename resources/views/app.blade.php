<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
{{--        <link rel="stylesheet" href="Admin/dist/css/adminlte.css">--}}
{{--        <title>{{ config('app.name', 'Laravel') }}</title>--}}

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
{{--        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">--}}

        <!-- Scripts -->
        @routes
{{--        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>--}}
{{--        <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>--}}
        <script src="{{ mix('/js/app.js') }}" defer></script>

    </head>

    <body class="bg-light">

{{--        <img src="{{ mix('imgs/zop/photo1.png') }}" alt="">--}}
{{--        <img src="{{ mix('imgs/photo1.png') }}" alt="">--}}
        @inertia
    </body>
</html>
