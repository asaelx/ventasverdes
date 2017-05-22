@extends('layout.base')

@section('title', 'Catálogo de categorías')
@section('sectionTitle', 'Catálogo de categorías')

@section('content')
    @if ($categories->isEmpty())
        <div class="empty">
            <div class="empty-icon">
                <i class="typcn typcn-tags"></i>
            </div><!-- /.empty-icon -->
            <h4 class="empty-title">Aún no hay categorías</h4><!-- /.empty-title -->
            <div class="empty-action">
                <a href="{{ route('categories.create') }}" class="btn btn-primary">Crea la primer categoría</a>
                <button class="btn btn-primary">Importar CSV</button>
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
                        <th>Productos</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->title }}</td>
                            <td>{{ $category->description }}</td>
                            <td>{{ $category->products->count() }}</td>
                            <td>
                                <a href="{{ url('admin/categories/'.$category->slug.'/edit') }}" class="btn btn-link">Editar</a>
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
