@extends('layout.base')

@section('title', 'Direcciones')
@section('sectionTitle', 'Editar dirección')

@section('content')
    {{ Form::model($address, ['url' => url('admin/addresses', $address->id), 'method' => 'PATCH']) }}
        <div class="columns">
            @include('addresses.form')
        </div>
        <!-- /.columns -->
    {{ Form::close() }}
@endsection
