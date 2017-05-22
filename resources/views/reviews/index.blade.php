@extends('layout.base')

@section('title', 'Reseñas')
@section('sectionTitle', 'Reseñas')

@section('content')
    @if ($reviews->isEmpty())
        <div class="empty">
            <div class="empty-icon">
                <i class="typcn typcn-tags"></i>
            </div><!-- /.empty-icon -->
            @if (Auth::user()->role == 'seller')
                <h4 class="empty-title">Aún no te han escrito reseñas</h4><!-- /.empty-title -->
            @elseif(Auth::user()->role == 'customer')
                <h4 class="empty-title">Aún no haz escrito reseñas</h4><!-- /.empty-title -->
            @endif
        </div>
        <!-- /.empty -->
    @else
        <div class="panel">
            <table class="table table-striped table-hover datatable">
                <thead>
                    <tr>
                        @if (Auth::user()->role == 'seller')
                            <th>Nombre</th>
                        @endif
                        <th>Producto</th>
                        <th>Reseña</th>
                        <th>Calificación</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reviews as $review)
                        <tr>
                            @if (Auth::user()->role == 'seller')
                                <td>{{ $review->user->profile->firstname }}</td>
                            @endif
                            <td><a href="{{ url('producto', $review->product->slug) }}" class="link" target="_blank">{{ $review->product->title }}</a></td>
                            <td>{{ $review->content }}</td>
                            <td>@include('store.layout.stars_list', ['selected' => $review->rating])</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- /.table table-striped table-hover -->
        </div>
        <!-- /.panel -->
    @endif
@endsection
