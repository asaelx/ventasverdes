@extends('layout.base')

@section('title', 'Productos')
@section('sectionTitle', 'Productos')

@section('content')

    @if ($products->isEmpty())
        <div class="empty">
            <div class="empty-icon">
                <i class="typcn typcn-tags"></i>
            </div><!-- /.empty-icon -->
            @if (Auth::user()->role == 'seller')
                <h4 class="empty-title">Aún no tienes productos</h4><!-- /.empty-title -->
                <p class="empty-subtitle">Agrega un producto</p><!-- /.empty-subtitle -->
                <div class="empty-action">
                    <a href="{{ route('products.create') }}" class="btn btn-primary">Crea tu primer producto</a>
                </div><!-- /.empty-action -->
            @elseif(Auth::user()->role == 'admin')
                <h4 class="empty-title">Aún no hay productos</h4><!-- /.empty-title -->
            @endif
        </div>
        <!-- /.empty -->
    @else
        <div class="panel">
            <table class="table table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th>Foto</th>
                        @if (Auth::user()->role == 'admin')
                            <th>Vendedor</th>
                        @endif
                        <th>Producto</th>
                        <th>Categoría</th>
                        <th>Inventario</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        @php
                            $stock = 0;
                            foreach ($product->variations as $variation) {
                                $stock = $stock + $variation->stock;
                            }
                        @endphp
                        <tr>
                            <td width="100px" style="min-width: 100px">
                                <img src="{{ url('storage/' . $product->medias->first()->url) }}" alt="{{ $product->title }}" class="rounded img-responsive">
                            </td>
                            @if (Auth::user()->role == 'admin')
                                <td>{{ $product->user()->profile->firstname }}</td>
                            @endif
                            <td>{{ $product->title }}</td>
                            <td>{{ $product->categories->first()->title }}</td>
                            <td>{{ $stock }}</td>
                            <td>
                                <a href="{{ url('admin/products/'. $product->slug .'/edit') }}" class="btn btn-link">Editar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- /.table table-striped table-hover -->
        </div>
        <!-- /.panel -->
    @endif

@endsection
