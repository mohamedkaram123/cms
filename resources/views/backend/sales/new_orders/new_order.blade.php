@extends('backend.layouts.app')

@section('content')

@php
     $arraydata = json_encode($cartsData) ;


@endphp
<div id="new_order" data-sellers="{{ $arraydata }}"  >

</div>

@endsection

