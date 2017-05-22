@extends('layout.base')

@section('title', 'Características')
@section('sectionTitle', 'Editar característica "' . $characteristic->title . '"')

@section('content')
    {{ Form::model($characteristic, ['url' => url('admin/characteristics', $characteristic->slug), 'method' => 'PATCH', 'files' => true]) }}
        <div class="columns">
            @include('characteristics.form')
        </div>
        <!-- /.columns -->
    {{ Form::close() }}
@endsection
