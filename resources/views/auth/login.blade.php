@extends('layout.base')

@section('title', 'Iniciar Sesión')

@section('auth')

    <section class="auth container">
        <div class="card">

            <div class="card-image">
                <img src="{{ asset('img/login-cover.jpg') }}" alt="" class="img-responsive">
                <h1 class="card-title">Iniciar sesión</h1>
            </div>
            <!-- /.card-image -->

            <div class="card-body">
                {{ Form::open(['url' => route('login')]) }}

                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                        {{ Form::label('email', 'Correo electrónico', ['class' => 'form-label']) }}
                        {{ Form::input('email', 'email', old('email'), ['class' => 'form-input', 'required']) }}

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

                    <div class="form-group">
                        <label class="form-checkbox">
                            {{ Form::checkbox('remember', old('remember'), true) }}
                            <i class="form-icon"></i> Recordarme
                        </label>
                    </div>
                    <!-- /.form-group -->

                    <div class="form-group clearfix">
                        {{ Form::submit('Entrar', ['class' => 'btn btn-primary float-right']) }}
                    </div>
                    <!-- /.form-group -->

                    <div class="divider"></div><!-- /.divider -->

                    <div class="form-group text-center">
                        <a href="{{ url('admin/password/reset') }}" class="btn btn-link">¿Se te olvidó la contraseña?</a>
                        <p>¿No tienes cuenta?<a href="{{ route('register') }}" class="btn btn-link">Regístrate aquí.</a></p>
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
