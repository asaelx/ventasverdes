<div class="column col-8 col-lg-12">
    <div class="panel">

        <div class="form-group">
            {{ Form::label('title', 'Título', ['class' => 'form-label']) }}
            {{ Form::input('text', 'title', null, ['class' => 'form-input']) }}
        </div>
        <!-- /.form-group -->

        <div class="form-group">
            {{ Form::label('description', 'Descripción', ['class' => 'form-label']) }}
            {{ Form::textarea('description', null, ['size' => '10x3', 'class' => 'form-input autosizable']) }}
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
