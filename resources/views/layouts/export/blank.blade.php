<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('owner.company') }} - @yield('title')</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">
    <style type="text/css">
        body {
            background-color: #ffffff;
        }
    </style>
    @yield('head')
</head>
<body>
<div class="container" id="app">
    @yield('content')
</div>
<script src="{{ mix('js/app.js') }}"></script>
@yield('script')
</body>
</html>