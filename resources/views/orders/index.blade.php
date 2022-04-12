@extends('layouts.master')
@section('title', ':: Orders')
@section('content')

    <kp-order-index
        :items="{{ $orders }}"
    />
@endsection
