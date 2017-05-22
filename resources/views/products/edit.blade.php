@extends('layout.base')

@section('title', 'Productos')
@section('sectionTitle', 'Editar producto "' . $product->title . '"')

@section('content')
    {{ Form::model($product, ['url' => url('admin/products', $product->slug), 'method' => 'PATCH', 'files' => true]) }}
        <div class="columns">
            @include('products.form')
        </div>
        <!-- /.columns -->
    {{ Form::close() }}
@endsection
