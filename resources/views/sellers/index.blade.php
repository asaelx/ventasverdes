@extends('layout.base')

@section('title', 'Vendedores')
@section('sectionTitle', 'Vendedores')

@section('content')
    @if ($sellers->isEmpty())
        <div class="empty">
            <div class="empty-icon">
                <i class="typcn typcn-tags"></i>
            </div><!-- /.empty-icon -->
            <h4 class="empty-title">Aún no hay vendedores</h4><!-- /.empty-title -->
            <div class="empty-action">
                <a href="{{ route('sellers.create') }}" class="btn btn-primary">Dar de alta un vendedor</a>
            </div><!-- /.empty-action -->
        </div>
        <!-- /.empty -->
    @else
        <div class="panel">
            <table class="table table-striped table-hover datatable">
                <thead>
                    <tr>
                        <th>Nombre(s)</th>
                        <th>Apellidos</th>
                        <th>Usuario</th>
                        <th>Empresa</th>
                        <th>Teléfono</th>
                        <th>RFC</th>
                        <th>CLABE</th>
                        <th>Banco</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sellers as $seller)
                        <tr>
                            <td>{{ $seller->profile->firstname }}</td>
                            <td>{{ $seller->profile->lastname }}</td>
                            <td>{{ $seller->username }}</td>
                            <td>{{ $seller->profile->company }}</td>
                            <td>{{ $seller->profile->phone }}</td>
                            <td>{{ $seller->profile->rfc }}</td>
                            <td>{{ $seller->profile->clabe }}</td>
                            <td>{{ $seller->profile->bank }}</td>
                            <td>
                                <a href="{{ url('admin/sellers/'.$seller->id.'/edit') }}" class="btn btn-link">Editar</a>
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
