<div class="column col-8 col-lg-12">

    <div class="panel">

        <div class="form-group">
            {{ Form::label('title', 'Nombre de la tienda', ['class' => 'form-label']) }}
            {{ Form::input('text', 'title', null, ['class' => 'form-input']) }}
        </div>
        <!-- /.form-group -->

        <div class="form-group">
            {{ Form::label('description', 'Descripción', ['class' => 'form-label']) }}
            {{ Form::textarea('description', null, ['size' => '10x3', 'class' => 'form-input autosizable']) }}
        </div>
        <!-- /.form-group -->

        <div class="form-group">
            {{ Form::label('footer', 'Pie de página', ['class' => 'form-label']) }}
            {{ Form::input('text', 'footer', null, ['class' => 'form-input']) }}
        </div>
        <!-- /.form-group -->

        <div class="columns">
            <div class="column col-6">
                <div class="form-group">
                    {{ Form::label('favicon', 'Favicon', ['class' => 'form-label']) }}
                    {{ Form::file('favicon', ['class' => 'form-input']) }}
                    @if ($setting->favicon)
                        <div class="preview">
                            <img src="{{ asset('storage/' . $setting->favicon()->first()->url) }}" alt="{{ $setting->title }}" class="img-responsive">
                        </div>
                        <!-- /.preview -->
                    @endif
                </div>
                <!-- /.form-group -->
            </div>
            <!-- /.column col-6 -->
            <div class="column col-6">
                <div class="form-group">
                    {{ Form::label('logo', 'Logotipo', ['class' => 'form-label']) }}
                    {{ Form::file('logo', ['class' => 'form-input']) }}
                    @if ($setting->logo)
                        <div class="preview">
                            <img src="{{ asset('storage/' . $setting->logo()->first()->url) }}" alt="{{ $setting->title }}" class="img-responsive">
                        </div>
                        <!-- /.preview -->
                    @endif
                </div>
                <!-- /.form-group -->
            </div>
            <!-- /.column col-6 -->
        </div>
        <!-- /.columns -->

        <div class="form-group clearfix">
            {{ Form::submit('Guardar', ['class' => 'btn btn-primary float-right']) }}
        </div>
        <!-- /.form-group -->

    </div>
    <!-- /.panel -->

</div>
<!-- /.column col-8 col-lg-12 -->
