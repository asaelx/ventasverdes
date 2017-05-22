@extends('layout.base')

@section('title', 'Categorías')
@section('sectionTitle', 'Crear una categoría')

@section('content')
    {{ Form::model($category = new \App\Category, ['url' => url('admin/categories')]) }}
        <div class="columns">
            @include('categories.form')
        </div>
        <!-- /.columns -->
    {{ Form::close() }}
@endsection
