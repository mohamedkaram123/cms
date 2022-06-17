@extends('backend.layouts.app')

@section('content')

{{-- {{dd($orders)}} --}}
@php

//         // $customKey = "b75524255a7f54d2726a951bb39204df";
//         // $newEncrypter = new \Illuminate\Encryption\Encrypter($customKey, "AES-256-CBC");
//         //  dd(env("ENCRYPT_KEY"));
             $symbol = currency_symbol();



            // $query =  DB::table('orders')
            //     ->join('users', function ($join) {
            //         $join->on('users.id', '=', 'orders.user_id')
            //             ->where('users.user_type', '=', 'admin')
            //             ->orOn('users.id', '=', 'orders.user_id')
            //             ->where('users.user_type', '=', 'customer');
            //     })
            //     ->join('users AS seller', function ($join) {
            //         $join->on('seller.id', '=', 'orders.seller_id')
            //             ->where('seller.user_type', '=', 'seller');

            //         // ->orWhere('users.user_type', '=', 'seller');
            //     });


            // if ($request->id != 0 && $request->id != null) {
//                 $query =    $query->where("orders.id", 'like', "%746%");
// //            }

//             $counter_query =   $query->select(DB::raw("COUNT(orders.id) / 10 as counter"), DB::raw("COUNT(orders.id) as rowss"));

//             $queryCounter = $query;
//             $query =  $query->select('orders.delivery_status', 'orders.payment_status', 'orders.id', 'orders.code', 'orders.created_at', DB::raw("CONCAT('$symbol', orders.grand_total) AS grand_total"), 'users.name as customer', 'seller.name as seller');
//   $orders =  $query
//                 ->offset(10)
//                 ->limit(10)
//                 ->get();



//             $counter =  $counter_query->get();

//             return dd($orders);


     $arraydata = json_encode($cartsData) ;

@endphp
<div id="orders"  data-sellers="{{ $arraydata }}" data-search="{{ $search }}" data-order_search="{{ $order_search }}" >

</div>

@endsection
