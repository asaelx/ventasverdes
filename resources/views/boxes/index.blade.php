@extends('layout.base')

@section('title', 'Catálogo de cajas')
@section('sectionTitle', 'Catálogo de cajas')

@section('content')
    @if ($boxes->isEmpty())
        <div class="empty">
            <div class="empty-icon">
                <i class="typcn typcn-tags"></i>
            </div><!-- /.empty-icon -->
            <h4 class="empty-title">Aún no tienes cajas</h4><!-- /.empty-title -->
            <div class="empty-action">
                <a href="{{ route('boxes.create') }}" class="btn btn-primary">Crea tu primer caja</a>
            </div><!-- /.empty-action -->
        </div>
        <!-- /.empty -->
    @else
        <div class="panel">
            <table class="table table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Largo</th>
                        <th>Alto</th>
                        <th>Ancho</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($boxes as $box)
                        <tr>
                            <td>{{ $box->name }}</td>
                            <td>{{ $box->length }}</td>
                            <td>{{ $box->height }}</td>
                            <td>{{ $box->width }}</td>
                            <td>
                                <a href="{{ url('admin/boxes/'.$box->id.'/edit') }}" class="btn btn-link">Editar</a>
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
