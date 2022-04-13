@extends('layouts.master')
@section('title', ':: Orders - products')
@section('content')

    <kp-related-products
        :order="{{ $order }}"
        :order-products="{{ $orderProducts }}"
        :products="{{ $products }}"
        :headers="{{ $headers }}"
        submit-action="orders.products.add"
    />
@endsection
