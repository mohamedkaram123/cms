@extends('backend.layouts.app')

@section('content')
@php

     $arraydata = json_encode($customer) ;

@endphp
<div id="customer_profile"
    data-customer="{{ $arraydata }}"
 >

</div>
@endsection
