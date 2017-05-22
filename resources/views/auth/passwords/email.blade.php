@extends('layout.base')

@section('title', 'Recuperar contraseña')

@section('auth')

    <section class="auth container">
        <div class="card">

            <div class="card-image">
                <img src="{{ asset('img/login-cover.jpg') }}" alt="" class="img-responsive">
                <h1 class="card-title">Recuperar contraseña</h1>
            </div>
            <!-- /.card-image -->

            <div class="card-body">

                @if (session('status'))
                    <div class="toast toast-success">
                        {{ session('status') }}
                    </div>
                    <!-- /.toast toast-success -->
                @endif

                <em>Por favor ingrese el correo electrónico con el que se registró y le llegará un link para generar una nueva contraseña.</em>

                <div class="divider"></div><!-- /.divider -->

                {{ Form::open(['url' => url('admin/password/email')]) }}
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                        {{ Form::label('email', 'Correo electrónico', ['class' => 'form-label']) }}
                        {{ Form::input('email', 'email', old('email'), ['class' => 'form-input', 'required']) }}

                        @if ($errors->has('email'))
                            <p class="form-input-hint">{{ $errors->first('email') }}</p><!-- /.form-input-hint -->
                        @endif

                    </div>
                    <!-- /.form-group -->

                    <div class="form-group clearfix">
                        {{ Form::submit('Enviar link de recuperación', ['class' => 'btn btn-primary float-right']) }}
                    </div>
                    <!-- /.form-group -->

                {{ Form::close() }}
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.auth container -->

@endsection
