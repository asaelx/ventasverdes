@extends('store.layout.base')

@section('front')
    @include('store.home.slider')
    @include('store.home.products')
    @include('store.home.newsletter')
    @include('store.home.collections')
@endsection
