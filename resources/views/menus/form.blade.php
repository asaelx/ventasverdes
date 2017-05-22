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

    </div>
    <!-- /.panel -->

    <div class="panel">
        <h6 class="text-bold">Links</h6>
        <!-- /.text-bold -->
        <div class="divider"></div>
        <!-- /.divider -->

        <table class="table table-striped table-hover links">
            <tbody>
                @if ($menu->links->isEmpty())
                    <tr class="link">
                        <td>
                            <div class="form-group">
                                {{ Form::label('type', 'Tipo', ['class' => 'form-label']) }}
                                {{ Form::select('type', ['page' => 'Página', 'url' => 'URL'], null, ['class' => 'form-select link-type']) }}
                            </div>
                            <!-- /.form-group -->
                        </td>
                        <td>
                            <div class="form-group title">
                                {{ Form::label('links[0][title]', 'Título', ['class' => 'form-label']) }}
                                {{ Form::input('text', 'links[0][title]', null, ['class' => 'form-input']) }}
                            </div>
                            <!-- /.form-group -->
                        </td>
                        <td>
                            <div class="form-group">
                                <div class="page">
                                    @if ($pages->isEmpty())
                                        {{ Form::label('page', 'Aún no hay páginas', ['class' => 'form-label']) }}
                                        <a href="{{ url('admin/pages/create') }}" class="btn btn-primary">Crear una página</a>
                                    @else
                                        {{ Form::label('links[0][page]', 'Selecciona una página', ['class' => 'form-label']) }}
                                        {{ Form::select('links[0][page]', $pages, null, ['class' => 'form-select']) }}
                                    @endif
                                </div>
                                <!-- /#page -->
                                <div class="url hide">
                                    {{ Form::label('links[0][url]', 'Escribe una URL', ['class' => 'form-label']) }}
                                    {{ Form::input('text', 'links[0][url]', null, ['class' => 'form-input', 'disabled']) }}
                                </div>
                                <!-- /#url -->
                            </div>
                            <!-- /.form-group -->
                        </td>
                        <td class="options" width="90px"></td>
                    </tr>
                    <!-- /.link -->
                @else
                    @php
                        $links_count = 0;
                    @endphp
                    @foreach ($menu->links as $link)
                        <tr class="link">
                            <td>
                                <div class="form-group">
                                    {{ Form::label('type', 'Tipo', ['class' => 'form-label']) }}
                                    {{ Form::select('type', ['page' => 'Página', 'url' => 'URL'], null, ['class' => 'form-select link-type']) }}
                                </div>
                                <!-- /.form-group -->
                            </td>
                            <td>
                                <div class="form-group title">
                                    {{ Form::label('links[' . $links_count . '][title]', 'Título', ['class' => 'form-label']) }}
                                    {{ Form::input('text', 'links[' . $links_count . '][title]', $link->title, ['class' => 'form-input']) }}
                                </div>
                                <!-- /.form-group -->
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="page{{ ($link->page_id) ? '' : ' hide' }}">
                                        @if ($pages->isEmpty())
                                            {{ Form::label('page', 'Aún no hay páginas', ['class' => 'form-label']) }}
                                            <a href="{{ url('admin/pages/create') }}" class="btn btn-primary">Crear una página</a>
                                        @else
                                            {{ Form::label('links[' . $links_count . '][page]', 'Selecciona una página', ['class' => 'form-label']) }}
                                            {{ Form::select('links[' . $links_count . '][page]', $pages, ($link->page_id) ? $link->page_id : null, ['class' => 'form-select', ($link->page_id) ? '' : 'disabled']) }}
                                        @endif
                                    </div>
                                    <!-- /#page -->
                                    <div class="url{{ ($link->url) ? '' : ' hide' }}">
                                        {{ Form::label('links[' . $links_count . '][url]', 'Escribe una URL', ['class' => 'form-label']) }}
                                        {{ Form::input('text', 'links[' . $links_count . '][url]', ($link->url) ? $link->url : null, ['class' => 'form-input', ($link->url) ? '' : 'disabled']) }}
                                    </div>
                                    <!-- /#url -->
                                </div>
                                <!-- /.form-group -->
                            </td>
                            <td class="options" width="90px">
                                @if ($links_count != 0)
                                    <button class="delete-link btn btn-danger">Eliminar</button>
                                @endif
                            </td>
                        </tr>
                        <!-- /.link -->
                        @php
                            $links_count++;
                        @endphp
                    @endforeach
                @endif

            </tbody>
        </table>
        <!-- /.table table-striped table-hover links -->
        <button class="btn btn-link add-link mt-10">Agregar otro link</button>
    </div>
    <!-- /.panel -->

    <div class="panel">
        <div class="form-group clearfix">
            {{ Form::submit('Guardar', ['class' => 'btn btn-primary float-right']) }}
        </div>
        <!-- /.form-group -->
    </div>
    <!-- /.panel -->

</div>
<!-- /.column col-8 col-lg-12 -->
