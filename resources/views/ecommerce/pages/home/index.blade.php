@extends('layouts.general')

@section('title', 'কেনারহাট')

@section('content')
@include('ecommerce.pages.home.slide')
@include('ecommerce.pages.home.product_row')
@include('ecommerce.pages.home.category_row')
@include('ecommerce.pages.home.new_product_row')

@include('ecommerce.pages.home.shipping')

@include('ecommerce.pages.home.universal_cart')
@endsection



