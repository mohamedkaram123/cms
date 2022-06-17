@extends('backend.layouts.app')

@section('content')
@php
if(\Request::segment(3) == "sellersjs"){

}
@endphp
<div id="sellers_js" @if (\Request::segment(3) == "sellersjs")  data-search={{ $search }} @endif>

</div>
@endsection
