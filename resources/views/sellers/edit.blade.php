@extends('layout.base')

@section('title', 'Vendedores')
@section('sectionTitle', 'Editar vendedor "' . $seller->profile->firstname . '"')

@section('content')
    {{ Form::model($seller, ['url' => url('admin/sellers', $seller->id), 'method' => 'PATCH']) }}
        <div class="columns">
            @include('sellers.form')
        </div>
        <!-- /.columns -->
    {{ Form::close() }}
@endsection
