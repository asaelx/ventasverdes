@extends('layout.base')

@section('title', 'Menús')
@section('sectionTitle', 'Menús')

@section('content')
    @if ($menus->isEmpty())
        <div class="empty">
            <div class="empty-icon">
                <i class="typcn typcn-th-menu"></i>
            </div><!-- /.empty-icon -->
            <h4 class="empty-title">Aún no hay menús</h4><!-- /.empty-title -->
            <div class="empty-action">
                <a href="{{ route('menus.create') }}" class="btn btn-primary">Crea el primer menú</a>
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
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($menus as $menu)
                        <tr>
                            <td>{{ $menu->title }}</td>
                            <td>{{ $menu->description }}</td>
                            <td>
                                <a href="{{ url('admin/menus/'.$menu->id.'/edit') }}" class="btn btn-link">Editar</a>
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
