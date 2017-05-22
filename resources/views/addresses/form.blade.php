<div class="column col-8 col-lg-12">
    <div class="panel">

        <div class="form-group">
            {{ Form::label('address', 'Dirección', ['class' => 'form-label']) }}
            {{ Form::input('text', 'address', null, ['class' => 'form-input', 'maxlength' => 35]) }}
        </div>
        <!-- /.form-group -->

        <div class="form-group">
            {{ Form::label('address2', 'Colonia o Fraccionamiento', ['class' => 'form-label']) }}
            {{ Form::input('text', 'address2', null, ['class' => 'form-input', 'maxlength' => 35]) }}
        </div>
        <!-- /.form-group -->

        <div class="form-group">
            {{ Form::label('zipcode', 'Código Postal', ['class' => 'form-label']) }}
            {{ Form::input('text', 'zipcode', null, ['class' => 'form-input']) }}
        </div>
        <!-- /.form-group -->

        <div class="form-group">
            {{ Form::label('country', 'País', ['class' => 'form-label']) }}
            {{ Form::select('country', $countries, null, ['class' => 'form-select', 'id' => 'country-select']) }}
        </div>
        <!-- /.form-group -->

        <div class="form-group">
            {{ Form::label('state', 'Estado', ['class' => 'form-label']) }}
            {{ Form::select('state', $states, null, ['class' => 'form-select', 'id' => 'state-select']) }}
        </div>
        <!-- /.form-group -->

        <div class="form-group">
            {{ Form::label('city', 'Ciudad', ['class' => 'form-label']) }}
            {{ Form::select('city', $cities, null, ['class' => 'form-select', 'id' => 'city-select']) }}
        </div>
        <!-- /.form-group -->

        <div class="form-group clearfix">
            {{ Form::submit('Guardar', ['class' => 'btn btn-primary float-right']) }}
        </div>
        <!-- /.form-group -->

    </div>
    <!-- /.panel -->
</div>
<!-- /.column col-8 col-lg-12 -->
