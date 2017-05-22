@extends('layout.base')

@section('title', 'Órdenes')
@section('sectionTitle', 'Órdenes')

@section('content')
    <div class="panel">
        <table class="table table-striped table-hover datatable">
            <thead>
                <tr>
                    <th>Orden</th>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Estatus</th>
                    <th>Método de Pago</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>#1014</td>
                    <td>{{ ucfirst(\Date::today()->format('l j \\d\\e F Y')) }}</td>
                    <td>Juan Sebastian</td>
                    <td><span class="label label-success">Vendida</span></td>
                    <td>Tarjeta de crédito</td>
                    <td><span class="money">$ 1,500.00</span></td>
                </tr>
                <tr>
                    <td>#1014</td>
                    <td>{{ ucfirst(\Date::today()->format('l j \\d\\e F Y')) }}</td>
                    <td>Juan Sebastian</td>
                    <td><span class="label label-warning">Pendiente</span></td>
                    <td>Tarjeta de crédito</td>
                    <td><span class="money">$ 1,500.00</span></td>
                </tr>
                <tr>
                    <td>#1014</td>
                    <td>{{ ucfirst(\Date::today()->format('l j \\d\\e F Y')) }}</td>
                    <td>Juan Sebastian</td>
                    <td><span class="label label-warning">Pendiente</span></td>
                    <td>Tarjeta de crédito</td>
                    <td><span class="money">$ 1,500.00</span></td>
                </tr>
                <tr>
                    <td>#1014</td>
                    <td>{{ ucfirst(\Date::today()->format('l j \\d\\e F Y')) }}</td>
                    <td>Juan Sebastian</td>
                    <td><span class="label label-danger">Cancelada</span></td>
                    <td>Tarjeta de crédito</td>
                    <td><span class="money">$ 1,500.00</span></td>
                </tr>
                <tr>
                    <td>#1014</td>
                    <td>{{ ucfirst(\Date::today()->format('l j \\d\\e F Y')) }}</td>
                    <td>Juan Sebastian</td>
                    <td><span class="label label-danger">Cancelada</span></td>
                    <td>Tarjeta de crédito</td>
                    <td><span class="money">$ 1,500.00</span></td>
                </tr>
            </tbody>
        </table>
        <!-- /.table table-striped table-hover -->
    </div>
    <!-- /.panel -->
@endsection
