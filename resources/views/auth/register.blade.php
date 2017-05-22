@extends('layout.base')

@section('title', 'Crear una cuenta')

@section('auth')

    <section class="auth container">
        <div class="card">

            <div class="card-image">
                <img src="{{ asset('img/login-cover.jpg') }}" alt="" class="img-responsive">
                <h1 class="card-title">Crear una cuenta</h1>
            </div>
            <!-- /.card-image -->

            <div class="card-body">
                {{ Form::open(['url' => route('register')]) }}

                    <div class="form-group{{ $errors->has('firstname') ? ' has-danger' : '' }}">
                        {{ Form::label('firstname', 'Nombre(s)', ['class' => 'form-label']) }}
                        {{ Form::input('text', 'firstname', old('firstname'), ['class' => 'form-input', 'required']) }}

                        @if ($errors->has('firstname'))
                            <p class="form-input-hint">{{ $errors->first('firstname') }}</p><!-- /.form-input-hint -->
                        @endif

                    </div>
                    <!-- /.form-group -->

                    <div class="form-group{{ $errors->has('lastname') ? ' has-danger' : '' }}">
                        {{ Form::label('lastname', 'Apellidos', ['class' => 'form-label']) }}
                        {{ Form::input('text', 'lastname', old('lastname'), ['class' => 'form-input', 'required']) }}

                        @if ($errors->has('lastname'))
                            <p class="form-input-hint">{{ $errors->first('lastname') }}</p><!-- /.form-input-hint -->
                        @endif

                    </div>
                    <!-- /.form-group -->

                    <div class="form-group{{ $errors->has('username') ? ' has-danger' : '' }}">
                        {{ Form::label('username', 'Nombre de usuario', ['class' => 'form-label']) }}
                        {{ Form::input('text', 'username', old('username'), ['class' => 'form-input', 'required']) }}

                        @if ($errors->has('username'))
                            <p class="form-input-hint">{{ $errors->first('username') }}</p><!-- /.form-input-hint -->
                        @endif

                    </div>
                    <!-- /.form-group -->

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

                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-danger' : '' }}">
                        {{ Form::label('password_confirmation', 'Confirmar contraseña', ['class' => 'form-label']) }}
                        {{ Form::input('password', 'password_confirmation', null, ['class' => 'form-input', 'required']) }}

                        @if ($errors->has('password_confirmation'))
                            <div class="form-input-hint">{{ $errors->first('password_confirmation') }}</div><!-- /.form-input-hint -->
                        @endif

                    </div>
                    <!-- /.form-group -->

                    <div class="divider"></div><!-- /.divider -->

                    <div class="form-group">
                        <label class="form-checkbox">
                            {{ Form::checkbox('role', old('role'), false, ['id' => 'show-seller-fields']) }}
                            <i class="form-icon"></i> Quiero vender cosas
                        </label>
                    </div>
                    <!-- /.form-group -->

                    <div class="seller-fields{{ (old('role')) ? '' : ' hide' }}">

                        <div class="form-group{{ $errors->has('company') ? ' has-danger' : '' }}">
                            {{ Form::label('company', 'Empresa (opcional)', ['class' => 'form-label']) }}
                            {{ Form::input('text', 'company', old('company'), ['class' => 'form-input']) }}

                            @if ($errors->has('company'))
                                <p class="form-input-hint">{{ $errors->first('company') }}</p><!-- /.form-input-hint -->
                            @endif

                        </div>
                        <!-- /.form-group -->

                        <div class="form-group{{ $errors->has('phone') ? ' has-danger' : '' }}">
                            {{ Form::label('phone', 'Teléfono', ['class' => 'form-label']) }}
                            {{ Form::input('phone', 'phone', old('phone'), ['class' => 'form-input required']) }}

                            @if ($errors->has('phone'))
                                <p class="form-input-hint">{{ $errors->first('phone') }}</p><!-- /.form-input-hint -->
                            @endif

                        </div>
                        <!-- /.form-group -->

                        <div class="form-group{{ $errors->has('rfc') ? ' has-danger' : '' }}">
                            {{ Form::label('rfc', 'R.F.C.', ['class' => 'form-label']) }}
                            {{ Form::input('text', 'rfc', old('rfc'), ['class' => 'form-input required']) }}

                            @if ($errors->has('rfc'))
                                <p class="form-input-hint">{{ $errors->first('rfc') }}</p><!-- /.form-input-hint -->
                            @endif

                        </div>
                        <!-- /.form-group -->

                        <div class="form-group{{ $errors->has('bank') ? ' has-danger' : '' }}">
                            {{ Form::label('bank', 'Banco', ['class' => 'form-label']) }}
                            {{ Form::input('text', 'bank', old('bank'), ['class' => 'form-input required']) }}

                            @if ($errors->has('bank'))
                                <p class="form-input-hint">{{ $errors->first('bank') }}</p><!-- /.form-input-hint -->
                            @endif

                        </div>
                        <!-- /.form-group -->

                        <div class="form-group{{ $errors->has('clabe') ? ' has-danger' : '' }}">
                            {{ Form::label('clabe', 'CLABE', ['class' => 'form-label']) }}
                            {{ Form::input('text', 'clabe', old('clabe'), ['class' => 'form-input required']) }}

                            @if ($errors->has('clabe'))
                                <p class="form-input-hint">{{ $errors->first('clabe') }}</p><!-- /.form-input-hint -->
                            @endif

                        </div>
                        <!-- /.form-group -->

                    </div>
                    <!-- /.seller_fields -->

                    <div class="form-group clearfix mt-10">
                        {{ Form::submit('Registrase', ['class' => 'btn btn-primary float-right mt-10']) }}
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
