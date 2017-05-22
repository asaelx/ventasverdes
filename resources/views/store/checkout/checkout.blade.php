@extends('store.layout.base')

@section('title', 'Ventas Verdes - Completar pedido')

@section('front')
    <section id="checkout">
        <div class="wrapper">
            <div class="row">
                <div class="col-12">
                    <h1 class="section-title">Completar pedido</h1>
                    <!-- /.title -->
                </div>
                <!-- /.col-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-6">
                    {{ Form::open(['url' => 'pago/shipping', 'class' => 'checkout_form form', 'id' => 'checkout_form']) }}
                        <div class="shipping">
                            <h2 class="title">Datos de envío</h2>
                            <!-- /.title -->
                            @if (auth()->check())
                                @if (!auth()->user()->profile->addresses->isEmpty())
                                    <div id="user-addresses">
                                        @php
                                            $addresses_count = 0;
                                        @endphp
                                        @foreach (auth()->user()->profile->addresses as $address)
                                            <div class="form-group">
                                                {{ Form::radio('address_option', $address->id, ($addresses_count == 0) ? true : null, ['class' => 'radio', 'id' => 'address_' . $address->id ]) }}
                                                <label for="address_{{ $address->id }}" class="label-radio">
                                                    <p>{{ $address->profile->firstname . ' ' . $address->profile->lastname }}</p>
                                                    <p>{{ auth()->user()->email }}</p>
                                                    <p>{{ $address->address }}</p>
                                                    <p>{{ $address->address2 }}</p>
                                                    <p>{{ $address->state . ', ' . $address->city }}</p>
                                                    <p>C.P.: {{ $address->zipcode }}</p>
                                                    <img src="{{ asset('img/check_circle.svg') }}" width="20" height="20" class="check">
                                                </label>
                                            </div>
                                            <!-- /.form-group -->
                                            @php
                                                $addresses_count++;
                                            @endphp
                                        @endforeach
                                    </div>
                                    <!-- /#user-addresses -->
                                @endif
                            @endif
                            <div class="form-group">
                                {{ Form::radio('address_option', 'custom', null, ['class' => 'radio', 'id' => 'address_custom']) }}
                                <label for="address_custom" class="label-radio">
                                    <p>Usar otra dirección</p>
                                    <img src="{{ asset('img/check_circle.svg') }}" width="20" height="20" class="check">
                                </label>
                            </div>
                            <!-- /.form-group -->
                            <div id="shipping_form">
                                <div class="form-group">
                                    {{ Form::label('shipping[firstname]', 'Nombre(s)', ['class' => 'label']) }}
                                    {{ Form::input('text', 'shipping[firstname]', null, ['class' => 'input']) }}
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    {{ Form::label('shipping[lastname]', 'Apellido(s)', ['class' => 'label']) }}
                                    {{ Form::input('text', 'shipping[lastname]', null, ['class' => 'input']) }}
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    {{ Form::label('shipping[address]', 'Dirección', ['class' => 'label']) }}
                                    {{ Form::input('text', 'shipping[address]', null, ['class' => 'input']) }}
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    {{ Form::label('shipping[country]', 'País', ['class' => 'label']) }}
                                    {{ Form::select('shipping[country]', $countries, null, ['class' => 'select', 'id' => 'country-select']) }}
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    {{ Form::label('shipping[state]', 'Estado', ['class' => 'label']) }}
                                    {{ Form::select('shipping[state]', $states, null, ['class' => 'select', 'id' => 'state-select']) }}
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    {{ Form::label('shipping[city]', 'Ciudad', ['class' => 'label']) }}
                                    {{ Form::select('shipping[city]', $cities, null, ['class' => 'select', 'id' => 'city-select']) }}
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    {{ Form::label('shipping[zipcode]', 'Código Postal', ['class' => 'label']) }}
                                    {{ Form::input('text', 'shipping[zipcode]', null, ['class' => 'input']) }}
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    {{ Form::label('shipping[phone]', 'Teléfono', ['class' => 'label']) }}
                                    {{ Form::input('text', 'shipping[phone]', null, ['class' => 'input']) }}
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    {{ Form::label('shipping[email]', 'Correo electrónico', ['class' => 'label']) }}
                                    {{ Form::input('text', 'shipping[email]', null, ['class' => 'input']) }}
                                </div>
                                <!-- /.form-group -->
                            </div><!-- /#shipping_form -->
                        </div>
                        <!-- /.shipping -->

                        <div class="billing">

                            <h2 class="title">Datos de facturación</h2>
                            <!-- /.title -->

                            <div class="form-group">
                                {{ Form::radio('billing_option', 'same', null, ['class' => 'radio', 'id' => 'billing-same']) }}
                                <label for="billing-same" class="label-radio">
                                    <p>Igual que los datos de envío</p>
                                    <img src="{{ asset('img/check_circle.svg') }}" width="20" height="20" class="check">
                                </label>
                                <!-- /.label-radio -->
                            </div>
                            <!-- /.form-group -->

                            <div class="form-group">
                                {{ Form::radio('billing_option', 'custom', null, ['class' => 'radio', 'id' => 'billing-custom']) }}
                                <label for="billing-custom" class="label-radio">
                                    <p>Usar otros datos de facturación</p>
                                    <img src="{{ asset('img/check_circle.svg') }}" width="20" height="20" class="check">
                                </label>
                                <!-- /.label-radio -->
                            </div>
                            <!-- /.form-group -->

                            <div id="billing_form">

                                <div class="form-group">
                                    {{ Form::label('billing[firstname]', 'Nombre(s)', ['class' => 'label']) }}
                                    {{ Form::input('text', 'billing[firstname]', null, ['class' => 'input']) }}
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    {{ Form::label('billing[lastname]', 'Apellido(s)', ['class' => 'label']) }}
                                    {{ Form::input('text', 'billing[lastname]', null, ['class' => 'input']) }}
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    {{ Form::label('billing[address]', 'Dirección', ['class' => 'label']) }}
                                    {{ Form::input('text', 'billing[address]', null, ['class' => 'input']) }}
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    {{ Form::label('billing[country]', 'País', ['class' => 'label']) }}
                                    {{ Form::select('billing[country]', $countries, null, ['class' => 'select', 'id' => 'billing-country-select']) }}
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    {{ Form::label('billing[state]', 'Estado', ['class' => 'label']) }}
                                    {{ Form::select('billing[state]', $states, null, ['class' => 'select', 'id' => 'billing-state-select']) }}
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    {{ Form::label('billing[city]', 'Ciudad', ['class' => 'label']) }}
                                    {{ Form::select('billing[city]', $cities, null, ['class' => 'select', 'id' => 'billing-city-select']) }}
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    {{ Form::label('billing[zipcode]', 'Código Postal', ['class' => 'label']) }}
                                    {{ Form::input('text', 'billing[zipcode]', null, ['class' => 'input']) }}
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    {{ Form::label('billing[phone]', 'Teléfono', ['class' => 'label']) }}
                                    {{ Form::input('text', 'billing[phone]', null, ['class' => 'input']) }}
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    {{ Form::label('billing[email]', 'Correo electrónico', ['class' => 'label']) }}
                                    {{ Form::input('text', 'billing[email]', null, ['class' => 'input']) }}
                                </div>
                                <!-- /.form-group -->
                            </div><!-- /#billing_form -->
                        </div><!-- /.billing -->
                    {{ Form::close() }}
                </div>
                <!-- /.col-6 -->
                <div class="col-6">
                    @include('store.checkout.summary', ['submit' => 'Continuar al método de envío'])
                </div>
                <!-- /.col-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.wrapper -->
    </section>
    <!-- /#store -->
@endsection
