<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>@yield('title', 'Ventas Verdes')</title>
        {{ Html::style('css/store.css') }}
    </head>
    <body>

        @include('store.layout.notification')

        @section('header')
            @include('store.layout.top')
            @include('store.layout.menu')
        @show

        @yield('front')

        @section('footer')
            @include('store.layout.footer')
        @show

        @yield('modal')

        <script type="text/javascript" src="https://conektaapi.s3.amazonaws.com/v0.3.2/js/conekta.js"></script>
        {{ Html::script('js/store.js') }}
        @if ( Config::get('app.debug') )
          <script type="text/javascript">
            document.write('<script src="{{ url('/') }}:35729/livereload.js?snipver=1" type="text/javascript"><\/script>')
          </script>
        @endif
    </body>
</html>
