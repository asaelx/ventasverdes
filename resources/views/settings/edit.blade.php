@extends('layout.base')

@section('title', 'Ajustes')
@section('sectionTitle', 'Ajustes')

@section('content')
    {{ Form::model($setting, ['url' => url('admin/settings', $setting->id), 'method' => 'PATCH', 'files' => true]) }}
        <div class="columns">
            @include('settings.form')
        </div>
        <!-- /.columns -->
    {{ Form::close() }}
@endsection
