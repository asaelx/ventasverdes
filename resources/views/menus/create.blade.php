@extends('layout.base')

@section('title', 'Menús')
@section('sectionTitle', 'Crear un menú')

@section('content')
    {{ Form::model($menu = new \App\Menu, ['url' => url('admin/menus')]) }}
        <div class="columns">
            @include('menus.form')
        </div>
        <!-- /.columns -->
    {{ Form::close() }}
@endsection
