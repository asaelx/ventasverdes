@extends('layout.base')

@section('title', 'Menús')
@section('sectionTitle', 'Editar menú: "' . $menu->title . '"')

@section('content')
    {{ Form::model($menu, ['url' => url('admin/menus', $menu->id), 'method' => 'PATCH']) }}
        <div class="columns">
            @include('menus.form')
        </div>
        <!-- /.columns -->
    {{ Form::close() }}
@endsection
