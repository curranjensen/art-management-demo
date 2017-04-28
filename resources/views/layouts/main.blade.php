<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('owner.company') }} - @yield('title')</title>
        @yield('head')
        <link href="{{ mix('css/app.css') }}" rel="stylesheet" type="text/css">
        <script>
            window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token() ]); ?>
        </script>
    </head>
    <body>
        <a name="top"></a>
        @include('partials.nav')
        <div class="container" id="app">
            @include('flash::message')
            @yield('content')
        </div>
        @include('partials.footer')
        @yield('script')
        <script src="{{ mix('js/app.js') }}"></script>
        <script>
            $('#flash-overlay-modal').modal();
            $('div.alert').not('.alert-danger').delay(3000).fadeOut(350);
        </script>
    </body>
</html>