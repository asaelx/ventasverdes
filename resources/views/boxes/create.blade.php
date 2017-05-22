@extends('layout.base')

@section('title', 'Cajas')
@section('sectionTitle', 'Agregar una caja')

@section('content')
    {{ Form::model($box = new \App\Box, ['url' => url('admin/boxes')]) }}
        <div class="columns">
            @include('boxes.form')
        </div>
        <!-- /.columns -->
    {{ Form::close() }}
@endsection
