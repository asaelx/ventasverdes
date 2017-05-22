<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>@yield('title')</title>
        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('img/apple-icon-57x57.png') }}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('img/apple-icon-60x60.png') }}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('img/apple-icon-72x72.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon-76x76.png') }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('img/apple-icon-114x114.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('img/apple-icon-120x120.png') }}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('img/apple-icon-144x144.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('img/apple-icon-152x152.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/apple-icon-180x180.png') }}">
        <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('img/android-icon-192x192.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('img/favicon-96x96.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('img/manifest.json') }}">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{ asset('img/ms-icon-144x144.png') }}">
        <meta name="theme-color" content="#ffffff">
        <!-- End Favicon -->

        <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    </head>
    <body>

        <div class="wrapper clearfix">

            @include('layout.navbar')

            @if (Auth::check())

                @include('layout.sidebar')

                <main class="main">

                    <div class="container">
                        <div class="columns">

                            @if (session()->has('flash_message'))
                                <div class="column col-12">
                                    <div class="notification">
                                        <span><i class="typcn typcn-coffee"></i> {{ session()->get('flash_message') }}</span>
                                        <button class="close-notification"><i class="typcn typcn-delete-outline"></i></button>
                                    </div><!-- /.notification -->
                                </div><!-- /.column col-12 -->
                            @endif

                            <div class="column col-12">
                                @php
                                    $cover_background = str_replace('.index', '', Route::current()->getName());
                                    $cover_background = str_replace('.create', '', $cover_background);
                                    $cover_background = str_replace('.edit', '', $cover_background);
                                    $cover_background = str_replace('.show', '', $cover_background);
                                    $cover_background = ($cover_background != '') ? $cover_background : 'dashboard';
                                @endphp
                                <div class="rounded main-cover {{ $cover_background }}">
                                    <h3>@yield('sectionTitle')</h3>
                                </div>
                                <!-- /.rounded main-cover products -->
                            </div><!-- /.column col-12 -->

                            <div class="column col-12">
                                @yield('content')
                            </div><!-- /.column col-12 -->
                        </div>
                        <!-- /.columns -->

                    </div>
                    <!-- /.container -->
                </main>
                <!-- /.main -->

                @yield('modal')

            @else

                @yield('auth')

            @endif

        </div>
        <!-- /.wrapper clearfix -->

        <script type="text/javascript" src="{{ asset('js/admin.js') }}"></script>

        @if ( Config::get('app.debug') )
            <script type="text/javascript">
                document.write('<script src="{{ env('APP_URL') }}:35729/livereload.js?snipver=1" type="text/javascript"><\/script>')
            </script>
        @endif

    </body>
</html>
