@extends('layout.base')

@section('title', 'Categorías')
@section('sectionTitle', 'Editar categoría "' . $category->title . '"')

@section('content')
    {{ Form::model($category, ['url' => url('admin/categories', $category->slug), 'method' => 'PATCH']) }}
        <div class="columns">
            @include('categories.form')
        </div>
        <!-- /.columns -->
    {{ Form::close() }}
@endsection
