<div class="column col-8 col-lg-12">
    <div class="panel">

        <div class="form-group">
            {{ Form::label('name', 'Nombre', ['class' => 'form-label']) }}
            {{ Form::input('text', 'name', null, ['class' => 'form-input']) }}
        </div>
        <!-- /.form-group -->

        <div class="form-group">
            {{ Form::label('length', 'Largo', ['class' => 'form-label']) }}
            <div class="input-group">
                {{ Form::input('text', 'length', null, ['class' => 'form-input']) }}
                <span class="input-group-addon">cm</span>
            </div>
            <!-- /.input-group -->
        </div>
        <!-- /.form-group -->

        <div class="form-group">
            {{ Form::label('height', 'Alto', ['class' => 'form-label']) }}
            <div class="input-group">
                {{ Form::input('text', 'height', null, ['class' => 'form-input']) }}
                <span class="input-group-addon">cm</span>
            </div>
            <!-- /.input-group -->
        </div>
        <!-- /.form-group -->

        <div class="form-group">
            {{ Form::label('width', 'Ancho', ['class' => 'form-label']) }}
            <div class="input-group">
                {{ Form::input('text', 'width', null, ['class' => 'form-input']) }}
                <span class="input-group-addon">cm</span>
            </div>
            <!-- /.input-group -->
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
