@extends('layout.base')

@section('title', 'Cajas')
@section('sectionTitle', 'Editar caja "' . $box->name . '"')

@section('content')
    {{ Form::model($box, ['url' => url('admin/boxes', $box->id), 'method' => 'PATCH']) }}
        <div class="columns">
            @include('boxes.form')
        </div>
        <!-- /.columns -->
    {{ Form::close() }}
@endsection
