@extends('layout.base')

@section('title', 'Productos')
@section('sectionTitle', 'Crear un producto')

@section('content')
    {{-- @include('layout.errors') --}}
    {{ Form::model($product = new \App\Product, ['url' => url('admin/products'), 'files' => true]) }}
        <div class="columns">
            @include('products.form')
        </div>
        <!-- /.columns -->
    {{ Form::close() }}
@endsection
