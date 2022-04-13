@extends('layouts.master')
@section('title', ':: Orders')
@section('content')

    <kp-order-index
        :items="{{ $orders }}"
        :headers="{{ $headers }}"
        title="Your Orders"
        retailurl="orders.products"
    />
@endsection
