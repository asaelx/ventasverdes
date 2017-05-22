@extends('store.layout.base')

@section('title', 'Ventas Verdes - ' . $single->title)

@section('front')
    <section id="single-product">
        <div class="wrapper">
            <header class="header">
                <div class="row">
                    <div class="col-9">
                        <div class="breadcrumbs">
                            <a href="{{ url('/') }}" class="link">Volver al listado</a> |
                            <a href="{{ url('busqueda?category='.$single->categories->first()->id) }}" class="link">{{ $single->categories->first()->title }}</a> -
                            <span class="current">{{ $single->title }}</span>
                        </div>
                        <!-- /.breadcrumbs -->
                    </div>
                    <!-- /.col-9 -->
                    <div class="col-3">
                        <div class="report pull-right">
                            <a href="#" class="link">Denunciar este producto</a>
                        </div>
                        <!-- /.report -->
                    </div>
                    <!-- /.col-3 -->
                </div>
                <!-- /.row -->
            </header>
            <!-- /.header -->
            <article class="single">
                <div class="row">
                    <div class="col-6 no-padding">
                        <div class="{{ ($single->medias->count() > 1) ? 'col-10' : 'col-12' }}">
                            @if ($single->medias->count() > 1)
                                <div class="gallery glide">
                                    <div class="glide__wrapper">
                                        <ul class="glide__track">
                                            @foreach ($single->medias as $media)
                                                @if ($media->type == 'image')
                                                    <li class="glide__slide">
                                                        <img src="{{ asset('storage/' . $media->url) }}" alt="{{ $single->title }}" class="featured">
                                                    </li>
                                                    <!-- /.glide__slide -->
                                                @elseif ($media->type == 'youtube')
                                                    <li class="glide__slide">
                                                        <div class="video-wrapper">
                                                            {!! youtube_embed($media->url) !!}
                                                        </div>
                                                        <!-- /.video-wrapper -->
                                                    </li>
                                                    <!-- /.glide__slide -->
                                                @endif
                                            @endforeach
                                        </ul>
                                        <!-- /.glide__track -->
                                    </div>
                                    <!-- /.glide__wrapper -->
                                </div>
                                <!-- /.gallery -->
                            @else
                                <div class="gallery">
                                    <img src="{{ asset('storage/' . $single->medias->first()->url) }}" alt="{{ $single->title }}" class="featured">
                                </div>
                                <!-- /.gallery -->
                            @endif
                        </div>
                        <!-- /.col-10 no-padding -->

                        @if ($single->medias->count() > 1)
                            <div class="col-2">
                                <div class="thumbnails">
                                    <ul class="list">
                                        @foreach ($single->medias as $media)
                                            <li class="item">
                                                @if ($media->type == 'image')
                                                    <img src="{{ asset('storage/' . $media->url) }}" alt="{{ $single->title }}" class="img">
                                                @elseif ($media->type == 'youtube')
                                                    <img src="{{ youtube_thumbnail_url($media->url) }}" alt="{{ $single->title }}" class="img">
                                                @endif
                                            </li>
                                            <!-- /.item -->
                                        @endforeach
                                    </ul>
                                    <!-- /.list -->
                                </div>
                                <!-- /.thumbnails -->
                            </div>
                            <!-- /.col-2 -->
                        @endif

                    </div>
                    <!-- /.col-6 -->

                    <div class="col-6">
                        <div class="information">
                            <h1 class="title">{{ $single->title }}</h1>
                            <!-- /.title -->
                            <h2 class="subtitle">
                                Quedan 7 días · Ubicado en {{ $single->user->profile->city }} · 16 vendidos · 6 opiniones
                            </h2>
                            <!-- /.subtitle -->
                            <div class="description">
                                {{ $single->description }}
                            </div>
                            <!-- /.description -->
                            @if ($single->variations->count() > 1)
                                <div class="variations">
                                    <div class="row">
                                        <div class="col-12 no-padding">
                                            <div class="variation">
                                                <h6 class="title">Variaciones</h6>
                                                <!-- /.title -->
                                                <select name="variation_id" id="" class="select">
                                                    @foreach ($single->variations as $variation)
                                                        <option value="{{ $variation->id }}">{{ $variation->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!-- /.variation -->
                                        </div>
                                        <!-- /.col-12 -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.variations -->
                            @endif
                            <div class="add-to-cart">
                                {{ Form::open(['url' => 'carrito/agregar']) }}
                                    {{ Form::hidden('variation_id', $single->variations->first()->id, ['id' => 'variation-input']) }}
                                    <div class="row">
                                        <div class="col-12 no-padding">
                                            <div class="quantity">
                                                <h3 class="title">Cantidad</h3>
                                                <!-- /.title -->
                                                {{-- <button class="qty_less control">—</button> --}}
                                                <input type="number" class="qty" name="quantity" min="1" max="{{ $single->variations->first()->stock }}" value="1">
                                                {{-- <button class="qty_more control">+</button> --}}
                                            </div>
                                            <!-- /.quantity -->
                                        </div>
                                        <!-- /.col-12 -->
                                        <div class="col-12 no-padding">
                                            <div class="row">
                                                <div class="col-6">
                                                    <button class="add-to-cart-btn btn btn-green" type="submit">Añadir al carrito</button>
                                                </div>
                                                <!-- /.col-6 -->
                                                <div class="col-6">
                                                    <button class="add-to-collection-btn btn btn-orange trigger-modal" type="button" data-modal="add-to-collection-modal">Añadir a colección</button>
                                                </div>
                                                <!-- /.col-6 -->
                                            </div>
                                            <!-- /.row -->
                                        </div>
                                        <!-- /.col-12 -->
                                    </div>
                                    <!-- /.row -->
                                {{ Form::close() }}
                            </div>
                            <!-- /.add-to-cart -->
                        </div>
                        <!-- /.information -->
                    </div>
                    <!-- /.col-6 -->
                </div>
                <!-- /.row -->
            </article>
            <!-- /.single -->

            <div class="row">
                <div class="col-12">
                    <section class="characteristics">
                        <h3 class="title">Características</h3>
                        <!-- /.title -->
                        <ul class="list">
                            @foreach ($single->characteristics as $characteristic)
                                <li class="item">
                                    @if ($characteristic->icon)
                                        <img src="{{ asset('storage/' . $characteristic->icon->url) }}" alt="" class="img">
                                    @endif
                                    <span class="name">{{ $characteristic->title }}</span>
                                    <div class="description">{{ $characteristic->description }}</div>
                                    <!-- /.description -->
                                </li>
                                <!-- /.item -->
                            @endforeach
                        </ul>
                        <!-- /.list -->
                    </section>
                    <!-- /.characteristics -->
                </div>
                <!-- /.col-12 -->
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-6">
                    <section class="reviews">
                        <h3 class="title">Opiniones de clientes</h3>
                        <!-- /.title -->
                        {{-- @if (auth()->check() && auth()->user()->role != 'admin')
                            {{ Form::open(['url' => url('admin/reviews'), 'class' => 'review-form']) }}
                                <div class="input-wrapper">
                                    {{ Form::input('text', 'content', null, ['class' => 'input', 'placeholder' => 'Escribe una opinión...']) }}
                                    {{ Form::submit('Aceptar', ['class' => 'btn btn-green']) }}
                                    {{ Form::hidden('product_id', $single->id) }}
                                </div>
                                <!-- /.input-wrapper -->
                                <div class="rating-radios">
                                    @foreach (range(1, 5) as $index)
                                        <label for="star-{{ $index }}" class="star">
                                            <img src="{{ asset('img/star-selected.svg') }}" alt="Star" class="img">
                                            {{ Form::radio('rating', '1', null, ['class' => 'radio', 'id' => 'star-' . $index]) }}
                                        </label>
                                        <!-- /.star -->
                                    @endforeach
                                </div>
                                <!-- /.rating-radios -->
                            {{ Form::close() }}
                        @else
                            <h4 class="sign-in">
                                <a href="{{ url('admin/login') }}" class="link">Inicia sesión</a> para escribir una opinión del producto
                            </h4>
                            <!-- /.sign-in -->
                        @endif --}}
                        @if (!$single->reviews->isEmpty())
                            {{-- @include('store.layout.stars') --}}

                            @foreach ($single->reviews as $review)
                                <article class="review">
                                    <header class="header">
                                        <div class="row">
                                            <div class="rating">
                                                @include('store.layout.stars_list', ['selected' => $review->rating])
                                            </div>
                                            <!-- /.rating -->
                                        </div>
                                        <!-- /.row -->
                                        <div class="row">
                                            <span class="author">Por {{ $review->user->profile->firstname }} el {{ \Date::createFromFormat('Y-m-d H:i:s', $review->created_at)->format('l j \\d\\e F Y · h:i A') }}</span>
                                            {{-- <span class="variation">Material: Piedra | Color: Gris</span> --}}
                                        </div>
                                        <!-- /.row -->
                                    </header>
                                    <!-- /.header -->
                                    <div class="content">
                                        <p>{{ $review->content }}</p>
                                    </div>
                                    <!-- /.content -->
                                </article>
                                <!-- /.review -->
                            @endforeach
                        @else
                            <h4 class="empty">Aún no hay opiniones para este producto</h4>
                            <!-- /.empty -->
                        @endif
                    </section>
                    <!-- /.reviews -->
                </div>
                <!-- /.col-6 -->
                <div class="col-6">
                    <section class="questions">
                        <h3 class="title">Preguntas al vendedor</h3>
                        <!-- /.title -->
                        @if (auth()->check() && auth()->user()->role != 'admin')
                            {{ Form::open(['url' => url('admin/questions'), 'class' => 'question-form']) }}
                                <div class="input-wrapper">
                                    {{ Form::input('text', 'content', null, ['class' => 'input', 'placeholder' => 'Escribe tu pregunta...']) }}
                                    {{ Form::submit('Preguntar', ['class' => 'btn btn-green']) }}
                                    {{ Form::hidden('product_id', $single->id) }}
                                </div>
                                <!-- /.input-wrapper -->
                            {{ Form::close() }}
                        @else
                            <h4 class="sign-in">
                                <a href="{{ url('admin/login') }}" class="link">Inicia sesión</a> para hacerle una pregunta al vendedor
                            </h4>
                            <!-- /.sign-in -->
                        @endif
                        @if (!$single->questions->isEmpty())
                            <div class="conversation">
                                @foreach ($single->questions as $question)
                                    @if ($question->answer)
                                        <div class="thread">
                                            <div class="row">
                                                <div class="question">
                                                    <header class="header">
                                                        <a href="#" class="link">{{ $question->user->profile->firstname }}</a> preguntó el {{ \Date::createFromFormat('Y-m-d H:i:s', $question->created_at)->format('l j \\d\\e F Y · h:i A') }}
                                                    </header>
                                                    <!-- /.header -->
                                                    <div class="content">
                                                        {{ $question->content }}
                                                    </div>
                                                    <!-- /.content -->
                                                </div>
                                                <!-- /.question -->
                                                <div class="answer">
                                                    <header class="header">
                                                        <a href="#" class="link">{{ $single->user->profile->firstname }}</a> respondió el {{ \Date::createFromFormat('Y-m-d H:i:s', $question->answer->created_at)->format('l j \\d\\e F Y · h:i A') }}
                                                    </header>
                                                    <!-- /.header -->
                                                    <div class="content">
                                                        {{ $question->answer->content }}
                                                    </div>
                                                    <!-- /.content -->
                                                </div>
                                                <!-- /.answer -->
                                            </div>
                                            <!-- /.row -->
                                        </div>
                                        <!-- /.thread -->
                                    @endif
                                @endforeach
                            </div>
                            <!-- /.conversation -->
                        @else
                            <h4 class="empty">Aún no hay preguntas para este producto.</h4>
                            <!-- /.empty -->
                        @endif
                    </section>
                    <!-- /.questions -->
                </div>
                <!-- /.col-6 -->
            </div>
            <!-- /.row -->

            @if (!$related->isEmpty())
                <section class="related_products">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="title">Productos relacionados</h3>
                            <!-- /.title -->
                        </div>
                        <!-- /.col-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        @foreach ($related as $product)
                            <div class="col-3">
                                @include('store.layout.product')
                            </div>
                            <!-- /.col-3 -->
                        @endforeach
                    </div>
                    <!-- /.row -->
                </section>
                <!-- /.related_products -->
            @endif

        </div>
        <!-- /.wrapper -->
    </section>
    <!-- /#single -->
@endsection

@section('modal')
    <div class="layer"></div><!-- /.layer -->

    <div class="modal" id="add-to-collection-modal">
        <h2 class="title">Añadir a la colección <button class="close-modal">&times;</button></h2>
        <!-- /.title -->
        <div class="content">
            @if (auth()->check())
                {{ Form::open(['url' => url('collections/ajaxStore')]) }}
                    <div class="form-group">
                        {{ Form::label('title', 'Crear nueva colección', ['class' => 'label']) }}
                        {{ Form::input('text', 'title', null, ['class' => 'input']) }}
                    </div>
                    <!-- /.form-group -->
                {{ Form::close() }}
            @else
                <h3 class="sign-in">
                    <a href="{{ url('admin/login') }}" class="link">Inicia sesión</a> para agregar el producto a una colección
                </h3>
                <!-- /.sign-in -->
            @endif
        </div>
        <!-- /.content -->
    </div>
    <!-- /.modal -->
@endsection
