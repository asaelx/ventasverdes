@extends('layout.base')

@section('title', 'Páginas')
@section('sectionTitle', 'Crear una página')

@section('content')
    {{ Form::model($page = new \App\Page, ['url' => url('admin/pages'), 'files' => true]) }}
        <div class="columns">
            @include('pages.form')
        </div>
        <!-- /.columns -->
    {{ Form::close() }}
@endsection
