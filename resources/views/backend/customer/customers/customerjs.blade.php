@extends('backend.layouts.app')

@section('content')
@php



@endphp
<div id="customers_js" @if (\Request::segment(3) == "customersjs")
    data-search={{ $search }}
@endif >

</div>
@endsection
