<aside class="sidebar">
    <ul class="menu">
        <li class="menu-item">
            <div class="tile tile-centered">
                <div class="tile-icon">
                    <img src="{{ asset('img/avatar.png') }}" alt="" class="avatar">
                </div>
                <!-- /.tile-icon -->
                <div class="tile-content">{{ Auth::user()->profile->firstname }}</div><!-- /.tile-content -->
            </div>
            <!-- /.tile tile-centered -->
        </li>
        <!-- /.menu-item -->

        <li class="divider"></li><!-- /.divider -->

        @php
            $options = [];
            $options['dashboard'] = ['icon' => 'home', 'name' => 'Dashboard'];
            $options['orders'] = ['icon' => 'upload', 'name' => 'Órdenes'];

            if (Auth::check() && Auth::user()->role == 'seller') {
                $options['products'] = ['icon' => 'tags', 'name' => 'Productos'];
                $options['boxes'] = ['icon' => 'dropbox', 'name' => 'Cajas'];
                $options['questions'] = ['icon' => 'messages', 'name' => 'Preguntas'];
                $options['reviews'] = ['icon' => 'star-full-outline', 'name' => 'Reseñas'];
                $options['addresses'] = ['icon' => 'home', 'name' => 'Direcciones'];
                $options['reports'] = ['icon' => 'chart-pie', 'name' => 'Reportes'];
            }
            if(Auth::check() && Auth::user()->role == 'customer') {
                $options['questions'] = ['icon' => 'messages', 'name' => 'Preguntas'];
                $options['reviews'] = ['icon' => 'star-full-outline', 'name' => 'Reseñas'];
                $options['addresses'] = ['icon' => 'home', 'name' => 'Direcciones'];
            }
            if(Auth::check() && Auth::user()->role == 'admin'){
                $options['pages'] = ['icon' => 'document', 'name' => 'Páginas'];
                $options['menus'] = ['icon' => 'th-menu', 'name' => 'Menús'];
                $options['categories'] = ['icon' => 'folder-open', 'name' => 'Categorías'];
                $options['characteristics'] = ['icon' => 'folder-open', 'name' => 'Características'];
                $options['sellers'] = ['icon' => 'group', 'name' => 'Vendedores'];
                $options['reports'] = ['icon' => 'chart-pie', 'name' => 'Reportes'];
            }
            $options['settings'] = ['icon' => 'cog', 'name' => 'Ajustes'];
        @endphp

        @foreach ($options as $url => $info)
            <li class="menu-item">
                <a href="{{ url('admin/'.$url) }}" class="{{ (Request::is('admin/'.$url) || Request::is('admin/'.$url.'/*') ? 'active' : '') }}">
                    <i class="typcn typcn-{{ $info['icon'] }}"></i> {{ $info['name'] }}
                </a>
            </li><!-- /.menu-item -->
        @endforeach
        <li class="menu-item">
            {{ Form::open(['url' => route('logout')]) }}
                <button type="submit" class="btn btn-link"><i class="typcn typcn-eject"></i> Cerrar sesión</button>
            {{ Form::close() }}
        </li>
        <!-- /.menu-item -->
    </ul>
    <!-- /.menu -->
</aside>
<!-- /.sidebar -->
