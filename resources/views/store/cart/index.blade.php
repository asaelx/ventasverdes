@extends('store.layout.base')

@section('title', 'Ventas Verdes - Carrito')

@section('front')
    <section id="cart">
        <div class="wrapper">
            <div class="row">
                <div class="col-12">
                    <h1 class="section-title">Carrito de compras</h1>
                    <!-- /.title -->
                </div>
                <!-- /.col-12 -->
            </div>
            <!-- /.row -->
            @if ($cart->quantities->isEmpty())
                <div class="row">
                    <div class="col-12">
                        <div class="empty">
                            <h2 class="title">Tu carrito está vacío :(</h2>
                            <!-- /.title -->
                            <div class="text">
                                <p>Puedes explorar productos y agregarlos a tu carrito en la <a href="{{ url('busqueda') }}" class="link">Tienda</a></p>
                            </div>
                            <!-- /.text -->
                        </div>
                        <!-- /.empty -->
                    </div><!-- /.col-12 -->
                </div><!-- /.row -->
            @else
                {{ Form::open(['url' => url('carrito', $cart->id), 'method' => 'PATCH']) }}
                    <div class="row">
                        <div class="col-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Producto</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Total</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cart->quantities as $quantity)
                                        <tr>
                                            <td data-th="Foto">
                                                <div class="photo">
                                                    <img src="{{ asset('storage/' . $quantity->variation->product->first()->medias->first()->url) }}" alt="{{ $quantity->variation->title }}" class="img">
                                                </div>
                                                <!-- /.photo -->
                                            </td>
                                            @php
                                                $title = ($quantity->variation->product->first()->variations->count() > 1) ? $quantity->variation->product->first()->title . ' (' . $quantity->variation->title . ')' : $quantity->variation->product->first()->title;
                                            @endphp
                                            <td data-th="Producto">
                                                <span class="title">{{ $title }}</span>
                                            </td>
                                            @php
                                                $price = (!is_null($quantity->variation->sale_price)) ? $quantity->variation->sale_price : $quantity->variation->regular_price;
                                            @endphp
                                            <td data-th="Precio">
                                                <span class="price">
                                                    <span class="currency-symbol">$</span>
                                                    <span class="product-price">{{ currency($price) }}</span>
                                                </span>
                                            </td>
                                            <td data-th="Cantidad">
                                                <div class="quantity">
                                                    <input type="number" class="qty input" name="quantities[{{ $quantity->id }}][quantity]" value="{{ $quantity->quantity }}" min="1">
                                                </div>
                                                <!-- /.qty -->
                                            </td>
                                            <td data-th="Total">
                                                <span class="price">
                                                    <span class="currency-symbol">$</span>
                                                    <span class="product-total">{{ currency($quantity->quantity * $price) }}</span>
                                                </span>
                                            </td>
                                            <td data-th="Opciones">
                                                <button class="btn btn-red delete-item" data-token="{{ csrf_token() }}" data-id="{{ $quantity->id }}">Eliminar</button>
                                                {{ Form::hidden('quantities['.$quantity->id.'][variation_id]', $quantity->variation_id) }}
                                                {{ Form::hidden('quantities['.$quantity->id.'][cart_id]', $quantity->cart->id) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4" class="text-right"><b>Subtotal</b></td>
                                        <td colspan="2">
                                            <span class="price">
                                                <span class="currency-symbol">$</span>
                                                <span class="subtotal">{{ currency($cart->subtotal) }}</span>
                                            </span>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                            <!-- /.table -->
                        </div><!-- /.col-12 -->
                    </div><!-- /.row -->
                    <div class="row">
                        <div class="col-12">
                            <div class="pull-right">
                                <button type="submit" class="btn btn-blue">Actualizar el carrito</button>
                                <a href="{{ url('pago') }}" class="btn btn-green">Proceder a los datos de envío</a>
                            </div>
                            <!-- /.pull-right -->
                        </div><!-- /.col-12 -->
                    </div><!-- /.row -->
                {{ Form::close() }}
            @endif
        </div>
        <!-- /.wrapper -->
    </section>
    <!-- /#store -->
@endsection
