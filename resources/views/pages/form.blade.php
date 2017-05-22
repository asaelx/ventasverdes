<div class="column col-8 col-lg-12">
    <div class="panel">

        <div class="form-group">
            {{ Form::label('cover', 'Imagen de portada', ['class' => 'form-label']) }}
            {{ Form::file('cover', ['class' => 'form-input']) }}
            @if ($page->cover)
                <div class="preview">
                    <img src="{{ asset('storage/' . $page->cover->url) }}" alt="{{ $page->title }}" class="img-responsive">
                </div>
                <!-- /.preview -->
            @endif
        </div>
        <!-- /.form-group -->

        <div class="form-group">
            {{ Form::label('title', 'Título', ['class' => 'form-label']) }}
            {{ Form::input('text', 'title', null, ['class' => 'form-input']) }}
        </div>
        <!-- /.form-group -->

        <div class="form-group">
            {{ Form::label('content', 'Contenido', ['class' => 'form-label']) }}
            {{ Form::textarea('content', null, ['size' => '10x3', 'class' => 'form-input wysiwyg']) }}
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
