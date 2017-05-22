@extends('layout.base')

@section('title', 'Características')
@section('sectionTitle', 'Catálogo de características')

@section('content')
    @if ($characteristics->isEmpty())
        <div class="empty">
            <div class="empty-icon">
                <i class="typcn typcn-tags"></i>
            </div><!-- /.empty-icon -->
            <h4 class="empty-title">Aún no hay características</h4><!-- /.empty-title -->
            <div class="empty-action">
                <a href="{{ route('characteristics.create') }}" class="btn btn-primary">Crea la primer característica</a>
            </div><!-- /.empty-action -->
        </div>
        <!-- /.empty -->
    @else
        <div class="panel">
            <table class="table table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Ícono</th>
                        <th>Productos</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($characteristics as $characteristic)
                        <tr>
                            <td>{{ $characteristic->title }}</td>
                            <td>{{ $characteristic->description }}</td>
                            <td>
                                @if ($characteristic->icon)
                                    <img src="{{ asset('storage/' . $characteristic->icon->url) }}" alt="" class="img-responsive">
                                @else
                                    <span>Sin ícono</span>
                                @endif
                            </td>
                            <td>{{ $characteristic->products->count() }}</td>
                            <td>
                                <a href="{{ url('admin/characteristics/'.$characteristic->slug.'/edit') }}" class="btn btn-link">Editar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- /.table table-striped table-hover -->
        </div>
        <!-- /.panel -->
    @endif
@endsection
