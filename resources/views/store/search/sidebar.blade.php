<aside id="sidebar">
    {{ Form::open(['url' => url('busqueda'), 'method' => 'GET', 'class' => 'filters-form']) }}
        <section class="section categories">
            <h3 class="title">Mostrar resultados para</h3>
            <!-- /.title -->
            <ul class="list radio">
                <li class="item">
                    {{ Form::radio('category', '', (is_null($category_id)) ? true : null, ['id' => 'category-all']) }}
                    <label for="category-all" class="text">Todas las categorías</label>
                </li>
                <!-- /.item -->
                @foreach ($all_categories as $all_category)
                    <li class="item">
                        {{ Form::radio('category', $all_category->id, ($category_id == $all_category->id) ? true : null, ['id' => $all_category->id]) }}
                        <label for="{{ $all_category->id }}" class="text">{{ $all_category->title }}</label>
                    </li>
                    <!-- /.item -->
                @endforeach
            </ul>
            <!-- /.list -->
        </section>
        <!-- /.section categories -->
        <section class="section price">
            <h3 class="title">Precio</h3>
            <!-- /.title -->
            <input type="range" id="price-range" name="price_range" value="" data-min="{{ (isset($price_min)) ? $price_min : 0 }}" data-max="{{ (isset($price_max)) ? $price_max : 0 }}" data-from="{{ (isset($price_from)) ? $price_from : 0 }}" data-to="{{ (isset($price_to)) ? $price_to : 0 }}">
            <input type="hidden" name="price_from" id="price-from" value="0">
            <input type="hidden" name="price_to" id="price-to" value="0">
        </section>
        <!-- /.section price -->
        <section class="section order">
            <h3 class="title">Ordenar por</h3>
            <!-- /.title -->
            <ul class="list radio">
                <li class="item">
                    {{ Form::radio('sorting', 'low to high', (!is_null($sorting) && $sorting == 'low to high') ? true : null, ['id' => 'low-to-high']) }}
                    <label for="low-to-high" class="text">Menor a mayor precio</label>
                </li>
                <!-- /.item -->
                <li class="item">
                    {{ Form::radio('sorting', 'high to low', (!is_null($sorting) && $sorting == 'high to low') ? true : null, ['id' => 'high-to-low']) }}
                    <label for="high-to-low" class="text">Mayor a menor precio</label>
                </li>
                <!-- /.item -->
                <li class="item">
                    {{ Form::radio('sorting', 'most rated', (!is_null($sorting) && $sorting == 'most rated') ? true : null, ['id' => 'most-rated']) }}
                    <label for="most-rated" class="text">Mejor calificación</label>
                </li>
                <!-- /.item -->
                <li class="item">
                    {{ Form::radio('sorting', 'newest', (!is_null($sorting) && $sorting == 'newest') ? true : null, ['id' => 'newest']) }}
                    <label for="newest" class="text">Lo más nuevo</label>
                </li>
                <!-- /.item -->
            </ul>
            <!-- /.list -->
        </section>
        <!-- /.section order -->
        <section class="section submit">
            {{ Form::hidden('search', (isset($s)) ? $s : null) }}
            {{ Form::submit('Aplicar', ['class' => 'btn btn-green']) }}
        </section>
        <!-- /.section submit -->
    {{ Form::close() }}
</aside>
<!-- /#sidebar -->
