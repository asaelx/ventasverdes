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

                {{ Form::open(['url' => url('admin/password/reset')]) }}

                    {{ Form::hidden('token', $token) }}

                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                        {{ Form::label('email', 'Correo electrónico', ['class' => 'form-label']) }}
                        {{ Form::input('email', 'email', ($email) ? $email : old('email'), ['class' => 'form-input', 'required']) }}

                        @if ($errors->has('email'))
                            <p class="form-input-hint">{{ $errors->first('email') }}</p><!-- /.form-input-hint -->
                        @endif

                    </div>
                    <!-- /.form-group -->

                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                        {{ Form::label('password', 'Contraseña', ['class' => 'form-label']) }}
                        {{ Form::input('password', 'password', null, ['class' => 'form-input', 'required']) }}

                        @if ($errors->has('password'))
                            <div class="form-input-hint">{{ $errors->first('password') }}</div><!-- /.form-input-hint -->
                        @endif

                    </div>
                    <!-- /.form-group -->

                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-danger' : '' }}">
                        {{ Form::label('password_confirmation', 'Contraseña', ['class' => 'form-label']) }}
                        {{ Form::input('password', 'password_confirmation', null, ['class' => 'form-input', 'required']) }}

                        @if ($errors->has('password_confirmation'))
                            <div class="form-input-hint">{{ $errors->first('password_confirmation') }}</div><!-- /.form-input-hint -->
                        @endif

                    </div>
                    <!-- /.form-group -->

                    <div class="form-group clearfix">
                        {{ Form::submit('Entrar con nueva contraseña', ['class' => 'btn btn-primary float-right']) }}
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
