<div class="column col-8 col-lg-12">
    <div class="panel">

        <div class="form-group">
            {{ Form::label('title', 'Título', ['class' => 'form-label']) }}
            {{ Form::input('text', 'title', null, ['class' => 'form-input', 'required']) }}
        </div>
        <!-- /.form-group -->
        <div class="form-group">
            {{ Form::label('description', 'Descripción', ['class' => 'form-label']) }}
            {{ Form::textarea('description', null, ['size' => '10x3', 'class' => 'form-input autosizable', 'required']) }}
        </div>
        <!-- /.form-group -->

        <div class="divider"></div><!-- /.divider -->

        <div class="form-group">
            <label class="form-switch">
                {{ Form::checkbox('has_variations', null, ($product->options->isEmpty()) ? false : true, ['id' => 'has_variations']) }}
                <i class="form-icon"></i> Este producto tiene variaciones
            </label>
        </div>
        <!-- /.form-group -->

    </div>
    <!-- /.panel -->

    <div class="panel variations_panel{{ ($product->options->isEmpty()) ? ' hide' : '' }}">
        <h6 class="text-bold">Variaciones <button class="btn btn-link float-right add-variation">Agregar</button></h6>
        <!-- /.text-bold -->
        <em>Agrega variaciones si el producto tiene múltiples versiones, como diferentes tamaños o colores.</em>

        <div class="divider"></div><!-- /.divider -->

        <div class="options{{ ($product->options->isEmpty()) ? ' hide' : '' }}">

            <table class="table">
                <tbody>
                    @if (!$product->options->isEmpty())

                        @php
                            $options_count = 0;
                        @endphp

                        @foreach ($product->options as $option)
                            <tr class="option">
                                <td width="25%">
                                    <div class="form-group">
                                        {{ Form::label('title', 'Opción', ['class' => 'form-label']) }}
                                        {{ Form::input('text', 'options[' . $options_count . '][title]', $option->title, ['class' => 'form-input']) }}
                                    </div>
                                    <!-- /.form-group -->
                                </td>
                                <td width="65%">
                                    {{ Form::label('value', 'Valores (separar por comas)', ['class' => 'form-label']) }}
                                    <div class="form-autocomplete">
                                        <div class="form-autocomplete-input form-input">

                                            {{-- @php
                                                $values_count = 0;
                                            @endphp --}}

                                            @foreach ($option->values as $value)

                                                <label class="chip">
                                                    {{ $value->title }}
                                                    <button class="btn btn-clear remove-chip"></button>
                                                </label><!-- /.chip -->

                                                {{ Form::hidden('options[' . $options_count .  '][values][]', $value->title, ['class' => 'values-hidden']) }}

                                                {{-- @php
                                                    $values_count++;
                                                @endphp --}}

                                            @endforeach

                                            {{ Form::input('text', null, null, ['class' => 'form-input option-values']) }}

                                        </div>
                                        <!-- /.form-autocomplete-input form-input -->
                                    </div>
                                    <!-- /.form-autocomplete -->
                                </td>
                                <td width="10%"></td>
                            </tr>

                            @php
                                $options_count++;
                            @endphp

                        @endforeach

                    @else

                        <tr class="option">
                            <td width="25%">
                                <div class="form-group">
                                    {{ Form::label('title', 'Opción', ['class' => 'form-label']) }}
                                    {{ Form::input('text', 'options[0][title]', null, ['class' => 'form-input']) }}
                                </div>
                                <!-- /.form-group -->
                            </td>
                            <td width="65%">
                                {{ Form::label('value', 'Valores (separar por comas)', ['class' => 'form-label']) }}
                                <div class="form-autocomplete">
                                    <div class="form-autocomplete-input form-input">

                                        {{ Form::input('text', null, null, ['class' => 'form-input option-values']) }}

                                    </div>
                                    <!-- /.form-autocomplete-input form-input -->
                                </div>
                                <!-- /.form-autocomplete -->
                            </td>
                            <td width="10%"></td>
                        </tr>

                    @endif
                </tbody>
            </table>
            <!-- /.table -->

            <button class="btn btn-link add-option mt-10{{ ($product->options->isEmpty()) ? ' hide' : '' }}">Agregar otra opción</button>

            <div class="divider"></div><!-- /.divider -->

        </div>
        <!-- /.options -->

        <table class="table table-striped table-hover variations{{ ($product->options->isEmpty()) ? ' hide' : '' }}">
            <tbody>

                @if (!$product->variations->isEmpty())

                    @php
                        $variations_count = 0;
                    @endphp

                    @foreach ($product->variations as $variation)

                        <tr class="variation">

                            <td>
                                <div class="form-group">
                                    <label class="form-checkbox">
                                        {{ Form::checkbox('is_variation', null, true) }}
                                        <i class="form-icon"></i> <span class="combination">{{ $variation->title }}</span>
                                    </label>
                                    {{ Form::hidden('variations_list[' . $variations_count . '][title]', $variation->title) }}
                                </div>
                                <!-- /.form-group -->
                            </td>

                            <td>
                                <div class="form-group">
                                    {{ Form::label('code', 'Código único', ['class' => 'form-label']) }}
                                    {{ Form::input('text', 'variations_list[' . $variations_count . '][code]', $variation->code, ['class' => 'form-input']) }}
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    {{ Form::label('stock', 'En existencia', ['class' => 'form-label']) }}
                                    {{ Form::input('text', 'variations_list[' . $variations_count . '][stock]', $variation->stock, ['class' => 'form-input']) }}
                                </div>
                                <!-- /.form-group -->
                            </td>

                            <td>
                                <div class="form-group">
                                    {{ Form::label('regular_price', 'Precio', ['class' => 'form-label']) }}
                                    <div class="input-group">
                                        <span class="input-group-addon">$</span>
                                        {{ Form::input('text', 'variations_list[' . $variations_count . '][regular_price]', $variation->regular_price, ['class' => 'form-input']) }}
                                    </div>
                                    <!-- /.input-group -->
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    {{ Form::label('sale_price', 'Precio de oferta (opcional)', ['class' => 'form-label']) }}
                                    <div class="input-group">
                                        <span class="input-group-addon">$</span>
                                        {{ Form::input('text', 'variations_list[' . $variations_count . '][sale_price]', $variation->sale_price, ['class' => 'form-input']) }}
                                    </div>
                                    <!-- /.input-group -->
                                </div>
                                <!-- /.form-group -->
                            </td>

                        </tr><!-- /.variation -->

                        @php
                            $variations_count++;
                        @endphp

                    @endforeach

                @else

                    <tr class="variation">

                        <td>
                            <div class="form-group">
                                <label class="form-checkbox">
                                    {{ Form::checkbox('is_variation', null, true) }}
                                    <i class="form-icon"></i> <span class="combination"></span>
                                </label>
                                {{ Form::hidden('variations_list[0][title]') }}
                            </div>
                            <!-- /.form-group -->
                        </td>

                        <td>
                            <div class="form-group">
                                {{ Form::label('code', 'Código único', ['class' => 'form-label']) }}
                                {{ Form::input('text', 'variations_list[0][code]', null, ['class' => 'form-input']) }}
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group">
                                {{ Form::label('stock', 'En existencia', ['class' => 'form-label']) }}
                                {{ Form::input('text', 'variations_list[0][stock]', null, ['class' => 'form-input']) }}
                            </div>
                            <!-- /.form-group -->
                        </td>

                        <td>
                            <div class="form-group">
                                {{ Form::label('regular_price', 'Precio', ['class' => 'form-label']) }}
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    {{ Form::input('text', 'variations_list[0][regular_price]', null, ['class' => 'form-input']) }}
                                </div>
                                <!-- /.input-group -->
                            </div>
                            <!-- /.form-group -->
                            <div class="form-group">
                                {{ Form::label('sale_price', 'Precio de oferta (opcional)', ['class' => 'form-label']) }}
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    {{ Form::input('text', 'variations_list[0][sale_price]', null, ['class' => 'form-input']) }}
                                </div>
                                <!-- /.input-group -->
                            </div>
                            <!-- /.form-group -->
                        </td>

                    </tr><!-- /.variation -->

                @endif

            </tbody>
        </table>
        <!-- /.table table-striped table-hover -->

    </div>
    <!-- /.panel -->

    <div class="panel price_panel{{ ($product->options->isEmpty()) ? '' : ' hide' }}">
        <h6 class="text-bold">Precio</h6>
        <!-- /.text-bold -->
        <div class="divider"></div>
        <!-- /.divider -->
        <div class="columns">
            <div class="column col-6">
                {{ Form::label('regular_price', 'Precio', ['class' => 'form-label']) }}
                <div class="input-group">
                    <span class="input-group-addon">$</span>
                    {{ Form::input('text', 'regular_price', $product->variations->first()->regular_price, ['class' => 'form-input']) }}
                </div>
                <!-- /.input-group -->
            </div>
            <!-- /.column col-6 -->
            <div class="column col-6">
                {{ Form::label('sale_price', 'Precio de oferta (opcional)', ['class' => 'form-label']) }}
                <div class="input-group">
                    <span class="input-group-addon">$</span>
                    {{ Form::input('text', 'sale_price', $product->variations->first()->sale_price, ['class' => 'form-input']) }}
                </div>
                <!-- /.input-group -->
            </div>
            <!-- /.column col-6 -->
        </div>
        <!-- /.columns -->
    </div>
    <!-- /.panel -->

    <div class="panel inventory_panel{{ ($product->options->isEmpty()) ? '' : ' hide' }}">
        <h6 class="text-bold">Inventario</h6>
        <!-- /.text-bold -->
        <div class="divider"></div>
        <!-- /.divider -->
        <div class="columns">
            <div class="column col-6">
                {{ Form::label('code', 'Código único', ['class' => 'form-label']) }}
                {{ Form::input('text', 'code', $product->variations->first()->code, ['class' => 'form-input']) }}
            </div>
            <!-- /.column col-6 -->
            <div class="column col-6">
                {{ Form::label('stock', 'Unidades en existencia', ['class' => 'form-label']) }}
                {{ Form::input('text', 'stock', $product->variations->first()->stock, ['class' => 'form-input']) }}
            </div>
            <!-- /.column col-6 -->
        </div>
        <!-- /.columns -->
    </div>
    <!-- /.panel -->

</div>
<!-- /.col-8 -->

<div class="column col-4 col-lg-12">

    <div class="panel">
        <h6 class="text-bold">Fotos de producto</h6>
        <!-- /.text-bold -->
        <div class="divider"></div>
        <!-- /.divider -->
        <div class="form-group">
            {{ Form::label('photos[]', 'Fotos', ['class' => 'form-label']) }}
            {{ Form::file('photos[]', ['class' => 'form-input file-input-preview', 'multiple']) }}
            <div class="preview columns">
                @if (!$product->medias->isEmpty())
                    @foreach ($product->medias as $media)

                        @if ($media->type == 'image')

                            <div class="column col-6 col-lg-3 col-md-4 col-sm-12">
                                <i class="typcn typcn-delete"></i>
                                <img src="{{ url('storage/' . $media->url) }}" alt="{{ $product->title }}" class="img-responsive">
                                {{ Form::hidden('existing_photos[]', $media->id, ['id' => '']) }}
                            </div>
                            <!-- /.column col-6 col-lg-3 col-md-4 col-sm-12 -->

                        @endif

                    @endforeach
                @endif
            </div><!-- /.preview columns -->
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.panel -->

    <div class="panel">
        <h6 class="text-bold">Video</h6>
        <!-- /.text-bold -->
        <div class="divider"></div>
        <!-- /.divider -->
        <div class="form-group">

            @foreach ($product->medias as $media)
                @if ($media->type == 'youtube')
                    @php
                        $youtube = $media->url;
                    @endphp
                @endif
            @endforeach

            {{ Form::label('video', 'URL del video YouTube (opcional)', ['class' => 'form-label']) }}
            {{ Form::input('text', 'video', (isset($youtube)) ? $youtube : null, ['class' => 'form-input']) }}
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.panel -->

    <div class="panel">
        <h6 class="text-bold">Envío</h6>
        <!-- /.text-bold -->
        <em>Especifica las dimensiones del producto para calcular los envíos.</em>
        <div class="divider"></div>
        <!-- /.divider -->

        <div class="columns">
            <div class="column col-6">
                {{ Form::label('length', 'Largo', ['class' => 'form-label']) }}
                <div class="input-group">
                    {{ Form::input('text', 'length', ($product->variations && !$product->variations->isEmpty()) ? $product->variations->first()->length : null, ['class' => 'form-input']) }}
                    <span class="input-group-addon">cm</span>
                </div>
                <!-- /.input-group -->
            </div>
            <!-- /.column col-6 -->
            <div class="column col-6">
                {{ Form::label('width', 'Ancho', ['class' => 'form-label']) }}
                <div class="input-group">
                    {{ Form::input('text', 'width', ($product->variations && !$product->variations->isEmpty()) ? $product->variations->first()->width : null, ['class' => 'form-input']) }}
                    <span class="input-group-addon">cm</span>
                </div>
                <!-- /.input-group -->
            </div>
            <!-- /.column col-6 -->
            <div class="column col-6">
                {{ Form::label('height', 'Alto', ['class' => 'form-label']) }}
                <div class="input-group">
                    {{ Form::input('text', 'height', ($product->variations && !$product->variations->isEmpty()) ? $product->variations->first()->height : null, ['class' => 'form-input']) }}
                    <span class="input-group-addon">cm</span>
                </div>
                <!-- /.input-group -->
            </div>
            <!-- /.column col-6 -->
            <div class="column col-6">
                {{ Form::label('weight', 'Peso', ['class' => 'form-label']) }}
                <div class="input-group">
                    {{ Form::input('text', 'weight', ($product->variations && !$product->variations->isEmpty()) ? $product->variations->first()->weight : null, ['class' => 'form-input']) }}
                    <span class="input-group-addon">kg</span>
                </div>
                <!-- /.input-group -->
            </div>
            <!-- /.column col-6 -->
        </div>
        <!-- /.columns -->
    </div>
    <!-- /.panel -->

    <div class="panel">
        <h6 class="text-bold">Organización</h6>
        <!-- /.text-bold -->
        <div class="divider"></div>
        <!-- /.divider -->
        <div class="form-group">
            {{ Form::label('category_list[]', 'Categorías', ['class' => 'form-label']) }}
            {{ Form::select('category_list[]', $categories, null, ['class' => 'select2', 'multiple']) }}
        </div>
        <!-- /.form-group -->
        <div class="form-group">
            {{ Form::label('characteristic_list[]', 'Características', ['class' => 'form-label']) }}
            {{ Form::select('characteristic_list[]', $characteristics, null, ['class' => 'select2', 'multiple']) }}
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.panel -->

    <div class="form-group">
        {{ Form::submit('Publicar', ['class' => 'btn btn-primary float-right']) }}
    </div>
    <!-- /.form-group -->

</div>
<!-- /.col-4 -->
