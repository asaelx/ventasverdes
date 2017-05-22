<div class="payment-method">
    <h2 class="title">Método de pago</h2>
    <!-- /.title -->
    <div class="form-group">
        {{ Form::radio('payment_method', 'oxxo_cash', null, ['id' => 'oxxo_cash', 'class' => 'radio checkbox_payment']) }}
        <label for="oxxo_cash" class="label-radio">
            <p>Pago en OXXO</p>
            <p>Se te enviará documento para que puedas llevarlo al cualquier OXXO y realizar el pago</p>
            <img src="{{ asset('img/check_circle.svg') }}" width="20" height="20" class="check">
        </label>
        <!-- /.label-radio -->
    </div><!-- /.form-group -->
    <div class="form-group">
        {{ Form::radio('payment_method', 'spei', null, ['id' => 'spei', 'class' => 'radio checkbox_payment']) }}
        <label for="spei" class="label-radio">
            <p>Transferencia bancaria</p>
            <p>Se te enviará una ficha de pago para que realices la transferencia desde el portal de tu Banco</p>
            <img src="{{ asset('img/check_circle.svg') }}" width="20" height="20" class="check">
        </label>
        <!-- /.label-radio -->
    </div><!-- /.form-group -->
    <div class="form-group">
        {{ Form::radio('payment_method', 'card', true, ['id' => 'card', 'class' => 'radio checkbox_payment']) }}
        <label for="card" class="label-radio">
            <p>Tarjeta de crédito</p>
            <img src="{{ asset('img/check_circle.svg') }}" width="20" height="20" class="check">
        </label>
        <!-- /.label-radio -->
    </div><!-- /.form-group -->
    <div id="card-details">
        <div class="form-group">
            <div class="info">
                <div class="card-errors"></div><!-- /.card-errors -->
            </div><!-- /.info -->
        </div><!-- /.form-group -->
        <div class="form-group">
            {{ Form::label('card[name]', 'Nombre del tarjetahabiente', ['class' => 'label']) }}
            {{ Form::input('text', null, null, ['class' => 'input', 'data-conekta' => 'card[name]']) }}
        </div><!-- /.form-group -->
        <div class="form-group">
            {{ Form::label('card[number]', 'Número de tarjeta', ['class' => 'label']) }}
            {{ Form::input('text', null, null, ['class' => 'input', 'data-conekta' => 'card[number]']) }}
        </div><!-- /.form-group -->
        <div class="form-group">
            {{ Form::label('card[cvc]', 'CVC', ['class' => 'label']) }}
            {{ Form::input('text', null, null, ['class' => 'input', 'data-conekta' => 'card[cvc]']) }}
        </div><!-- /.form-group -->
        <div class="form-group">
            {{ Form::label('card[exp_month]', 'Mes de expiración (MM)', ['class' => 'label']) }}
            {{ Form::input('text', null, null, ['class' => 'input', 'data-conekta' => 'card[exp_month]']) }}
        </div><!-- /.form-group -->
        <div class="form-group">
            {{ Form::label('card[exp_year]', 'Año de expiración (YYYY)', ['class' => 'label']) }}
            {{ Form::input('text', null, null, ['class' => 'input', 'data-conekta' => 'card[exp_year]']) }}
        </div><!-- /.form-group -->
    </div><!-- /#card-details -->
</div><!-- /.payment-method -->
