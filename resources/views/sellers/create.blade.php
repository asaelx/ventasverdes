@extends('layout.base')

@section('title', 'Vendedores')
@section('sectionTitle', 'Dar de alta un vendedor')

@section('content')
    {{ Form::model($seller = new \App\User, ['url' => url('admin/sellers')]) }}
        <div class="columns">
            @include('sellers.form')
        </div>
        <!-- /.columns -->
    {{ Form::close() }}
@endsection
