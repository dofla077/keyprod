@extends('layouts.master')
@section('title', ':: Shipments - Index')
@section('content')
    <kp-order-index
        :items="{{ $shipments }}"
        :headers="{{ $headers }}"
        title="Your Shipments"
        submit-action="shipments.tracking"
    />
@endsection
