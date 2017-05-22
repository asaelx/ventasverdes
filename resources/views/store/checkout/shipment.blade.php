@extends('store.layout.base')

@section('title', 'Ventas Verdes - Método de envío')

@section('front')
    <section id="shipment">
        <div class="wrapper">
            <div class="row">
                <div class="col-12">
                    <h1 class="section-title">Seleccionar método de envío</h1>
                    <!-- /.section-title -->
                </div>
                <!-- /.col-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-6">
                    {{ Form::open(['url' => url('pago/pay'), 'class' => 'pay_form form']) }}
                        @if (count($all_rates['rates']) > 1)
                            <h2 class="title">Se realizarán {{ count($all_rates['rates']) }} órdenes</h2>
                        @endif

                        @foreach ($all_rates['rates'] as $rate)

                            <div class="form-group">
                                {{ Form::label('rates[]', 'Envío #' . $all_rates['shipment_id'], ['class' => 'label']) }}
                                {{ Form::select('rates[]', $rate, null, ['class' => 'rate-select select']) }}
                            </div>
                            <!-- /.form-group -->
                        @endforeach

                        @include('store.checkout.payment_method')

                    {{ Form::close() }}
                </div>
                <!-- /.col-6 -->
                <div class="col-6">
                    @include('store.checkout.summary', ['submit' => 'Realizar el pago'])
                </div>
                <!-- /.col-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.wrapper -->
    </section>
    <!-- /#shipment -->
@endsection
