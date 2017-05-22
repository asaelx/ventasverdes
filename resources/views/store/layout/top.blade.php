<header id="top">

    <div class="wrapper">
        <div class="row">
            <div class="col-12">
                <div class="col-8 no-padding left">

                    <div id="main-logo">
                        <a href="{{ url('/') }}" class="link">
                            <picture>
                                <source srcset="{{ asset('img/logo-small.png') }}" media="(max-width: 1010px)">
                                <source srcset="{{ asset('img/logo.png') }}">
                                <img src="{{ asset('img/logo.png') }}" alt="title" class="img">
                            </picture>
                        </a><!-- /link -->
                    </div><!-- /logo -->

                    <div id="search">
                        {{ Form::open(['url' => url('busqueda'), 'class' => 'search-form', 'method' => 'GET']) }}
                            {{ Form::input('search', 'search', (isset($s)) ? $s : null, ['class' => 'input', 'placeholder' => 'Buscar...']) }}
                            {{ Form::select('category', $search_categories, (isset($category_id) && !is_null($category_id)) ? $category_id : null, ['class' => 'select']) }}
                            {{ Form::hidden('price_from', (isset($price_from) && !is_null($price_from)) ? $price_from : null) }}
                            {{ Form::hidden('price_to', (isset($price_to) && is_null($price_to)) ? $price_to : null) }}
                            {{ Form::hidden('sorting', (isset($sorting) && is_null($sorting)) ? $sorting : null) }}
                            {{ Form::submit('Buscar', ['class' => 'btn btn-green']) }}
                        {{ Form::close() }}
                    </div><!-- /search -->

                    <div id="responsive-nav">
                        <label class="label" for="toggle-nav">
                            <span class="icon">&#9776;</span>
                        </label><!-- /toggle-nav -->
                        <input type="checkbox" id="toggle-nav">
                        <nav class="nav">
                            <ul class="menu">
                                <li class="option">
                                    <a href="{{ url('#') }}" class="link">Vender</a>
                                </li>
                                <!-- /.option -->
                                @if (auth()->check())
                                    <li class="option">
                                        {{ Form::open(['url' => url('admin/logout')]) }}
                                            <button type="submit" class="link">Cerrar sesión</button>
                                        {{ Form::close() }}
                                    </li><!-- /.option -->
                                @else
                                    <li class="option">
                                        <a href="{{ url('admin/login') }}" class="link">Iniciar sesión</a>
                                    </li>
                                    <!-- /.option -->
                                    <li class="option">
                                        <a href="{{ url('admin/register') }}" class="link">Registrarse</a>
                                    </li>
                                    <!-- /.option -->
                                @endif
                            </ul>
                            <!-- /.menu -->
                        </nav>
                        <!-- /.nav -->
                    </div>
                    <!-- /#responsive-nav -->

                </div><!-- /col-8 -->

                <div class="col-4 no-padding right">
                    <ul class="list pull-right">
                        <li class="item">
                            <a href="#" class="sell btn btn-green">Vender</a>
                        </li>
                        <li class="item">
                            <img src="{{ asset('img/notification.svg') }}" alt="" class="icon">
                        </li>
                        <li class="item">
                            <a href="{{ url('carrito') }}" class="link">
                                <img src="{{ asset('img/cart.svg') }}" alt="" class="icon">
                            </a>
                        </li>
                        <li class="item dropdown">
                            <a href="{{ url('dashboard') }}" class="profile">
                                <div class="photo">
                                    <img src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/128.jpg" alt="" class="img">
                                </div>
                                <!-- /.photo -->
                                <img src="{{ asset('img/caret-down.svg') }}" alt="" class="icon">
                            </a><!-- /profile -->
                            <ul class="submenu">
                                <li class="option">
                                    <a href="{{ url('dashboard') }}" class="link">Dashboard</a>
                                </li><!-- /.option -->
                                <li class="option">
                                    <a href="{{ url('dashboard/perfil') }}" class="link">Perfil</a>
                                </li><!-- /.option -->
                                <li class="option">
                                    {{ Form::open(['url' => route('logout')]) }}
                                        <button type="submit" class="link">Cerrar sesión</button>
                                    {{ Form::close() }}
                                </li><!-- /.option -->
                            </ul><!-- /.submenu -->
                        </li>
                    </ul><!-- /list -->

                </div><!-- /col-4 -->

            </div><!-- /col-12 -->
        </div><!-- /row -->
    </div><!-- /wrapper -->

</header><!-- /top -->
