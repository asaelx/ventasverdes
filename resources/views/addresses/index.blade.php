@extends('layout.base')

@section('title', 'Direcciones')
@section('sectionTitle', 'Direcciones')

@section('content')
    @if ($addresses->isEmpty())
        <div class="empty">
            <div class="empty-icon">
                <i class="typcn typcn-home"></i>
            </div><!-- /.empty-icon -->
            <h4 class="empty-title">Aún no tienes direcciones</h4><!-- /.empty-title -->
            <div class="empty-action">
                <a href="{{ route('addresses.create') }}" class="btn btn-primary">Agrega una dirección</a>
            </div><!-- /.empty-action -->
        </div>
        <!-- /.empty -->
    @else
        <div class="panel">
            <table class="table table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th>Dirección</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($addresses as $address)
                        <tr>
                            <td>{{ $address->address . ' ' . $address->address2 }}</td>
                            <td>
                                <a href="{{ url('admin/addresses/'.$address->id.'/edit') }}" class="btn btn-link">Editar</a>
                                <button class="btn btn-danger trigger-modal" data-modal="delete-modal" data-action="{{ url('admin/addresses', $address->id) }}" data-text="¿Seguro que quieres eliminar la dirección '{{ $address->address }}'?">Eliminar</button>
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

@section('modal')
    <div class="modal" id="delete-modal">
        <div class="modal-overlay"></div>
        <!-- /.modal-overlay -->
        <div class="modal-container">
            <div class="modal-header">
                <button class="close-modal btn btn-clear float-right"></button>
                <div class="modal-title">Dirección</div>
                <!-- /.modal-title -->
                <div class="modal-body">
                    <div class="content">
                        <p class="text"></p>
                        {{ Form::open(['url' => url('/'), 'method' => 'DELETE']) }}
                            <div class="text-center">
                                <button class="close-modal btn btn-primary">Cancelar</button>
                                {{ Form::submit('Eliminar', ['class' => 'btn btn-danger']) }}
                            </div>
                        {{ Form::close() }}
                    </div>
                    <!-- /.content -->
                </div>
                <!-- /.modal-body -->
            </div>
            <!-- /.modal-header -->
        </div>
        <!-- /.modal-container -->
    </div>
    <!-- /.modal active -->
@endsection
