@extends('store.layout.base')

@section('title', 'Ventas Verdes - Búsqueda')

@section('front')
    <section id="search">
        <div class="wrapper">
            <div class="row">
                <div class="col-3 hide">
                    @include('store.search.sidebar')
                </div>
                <!-- /.col-3 -->
                <div class="col-9 no-padding">
                    @include('store.search.results')
                </div>
                <!-- /.col-9 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.wrapper -->
    </section>
    <!-- /#store -->
@endsection
