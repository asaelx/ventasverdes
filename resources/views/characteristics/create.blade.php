@extends('layout.base')

@section('title', 'Características')
@section('sectionTitle', 'Crear una característica')

@section('content')
    {{ Form::model($characteristic = new \App\Characteristic, ['url' => url('admin/characteristics'), 'files' => true]) }}
        <div class="columns">
            @include('characteristics.form')
        </div>
        <!-- /.columns -->
    {{ Form::close() }}
@endsection
