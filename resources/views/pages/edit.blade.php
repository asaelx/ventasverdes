@extends('layout.base')

@section('title', 'Páginas')
@section('sectionTitle', 'Editar página: "' . $page->title . '"')

@section('content')
    {{ Form::model($page, ['url' => url('admin/pages', $page->slug), 'method' => 'PATCH', 'files' => true]) }}
        <div class="columns">
            @include('pages.form')
        </div>
        <!-- /.columns -->
    {{ Form::close() }}
@endsection
