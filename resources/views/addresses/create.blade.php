@extends('layout.base')

@section('title', 'Direcciones')
@section('sectionTitle', 'Crear una dirección')

@section('content')
    {{ Form::model($address = new \App\Address, ['url' => url('admin/addresses')]) }}
        <div class="columns">
            @include('addresses.form')
        </div>
        <!-- /.columns -->
    {{ Form::close() }}
@endsection
