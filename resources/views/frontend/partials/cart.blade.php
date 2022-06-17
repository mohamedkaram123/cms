@php
    $carts = auth()->check()?auth()->user()->carts:null;
    $carts_count = auth()->check()?count($carts):0;
@endphp
<a href="javascript:void(0)" id="dropDowncarts" class="d-flex align-items-center text-reset h-100" data-toggle="dropdown" data-display="static">
    <i class="la la-shopping-cart la-2x opacity-80"></i>
    <span class="flex-grow-1 ml-1">
        @if(Session::has('cart') || $carts != null)
            <span class="badge badge-primary badge-inline badge-pill">{{$carts != null ? count($carts) : count(Session::get('cart'))}}</span>
        @else
            <span class="badge badge-primary badge-inline badge-pill">0</span>
        @endif
        <span class="nav-box-text d-none d-xl-block opacity-70">{{translate('Cart')}}</span>
    </span>
</a>
<div  aria-labelledby="dropDowncarts" class="dropdown-menu dropdown-menu-right dropdown-menu-lg p-0 stop-propagation">

    @if (auth()->check())
    @if($carts != null)
        @if( count($carts)  > 0)
        @php
               $special_offer_cart =   DB::table('special_offers')
            ->join('special_offers_customer_purchase', function ($join) {
                $join->on('special_offers.id', '=', 'special_offers_customer_purchase.special_offers_id');
            })

            ->where("special_offers_customer_purchase.offer_applies_type", 1)
            ->where("special_offers.end_date", ">", now())

            ->select("special_offers_customer_purchase.*", "special_offers.*")
            ->first();



            // return dd($special_offer_cart);



        @endphp
            <div class="p-3 fs-15 fw-600 p-3 border-bottom">
                <div class="d-flex flex-row " style="display: flex;align-items: center;justify-content: space-between">
                    <div class="d-flex flex-column p-2">
                      <span>{{translate('Cart Items')}}</span>

                        <div class="d-flex flex-row" style="justify-content: space-around">
                            @if (!empty($special_offer_cart))
                             <span style="font-size: 12px;background: var(--primary);border-radius: 20px;color: #fff;padding: 5px;width: fit-content" >{{ translate("There is a special offer for a limited time")  }}</span>

                             @endif
                         </div>

                </div>

                <div class="p-2">
                    <button onclick="removeAllCarts()" class="btn btn-icon btn-primary " data-toggle="tooltip" data-placement="bottom" title="{{ translate("remove all carts") }}"><i class="lab la-bitbucket"></i></button>

                </div>
                </div>



            </div>
            <ul class="h-250px overflow-auto c-scrollbar-light list-group list-group-flush">
                @php
                    $total = 0;
                @endphp
                @foreach($carts as $key => $cartItem)

                    @php
                       $total_price = 0;
                        $product = $cartItem->product;
                        $total_price = $total_price + ($cartItem['price'] + $cartItem['tax']) *$cartItem['quantity'];
                       $total = $total + ($cartItem['price'] + $cartItem['tax']) *$cartItem['quantity'];
                    @endphp
                    @if ($product != null)
                        <li class="list-group-item">
                            <span class="d-flex align-items-center">
                                <a href="{{ route('product', $product->slug) }}" class="text-reset d-flex align-items-center flex-grow-1">
                                    <img
                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                        data-src="{{ uploaded_asset($product->thumbnail_img) }}"
                                        class="img-fit lazyload size-60px rounded"
                                        alt="{{$product->name}}"
                                    >
                                    <span class="minw-0 pl-2 flex-grow-1">
                                        <span class="fw-600 mb-1 text-truncate-2">
                                            {{$product->name}}
                                                {{-- {{  $product->getTranslation('name')  }} --}}
                                        </span>
                                        <span class="">{{ $cartItem['quantity'] }}x</span>
                                        <span class="">{{ single_price($total_price) }}</span>
                                    </span>
                                </a>
                                <span class="">
                                    <button onclick="removeFromCart({{$key}},{{ $cartItem['id'] }})" class="btn btn-sm btn-icon stop-propagation">
                                        <i class="la la-close"></i>
                                    </button>
                                </span>
                            </span>
                        </li>
                    @endif
                @endforeach
            </ul>
            <div class="px-3 py-2 fs-15 border-top d-flex justify-content-between">
                <span class="opacity-60">{{translate('Subtotal')}}</span>
                <span class="fw-600">{{ single_price($total) }}</span>
            </div>
            <div class="px-3 py-2 text-center border-top">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <a href="{{ route('cart') }}" class="btn btn-soft-primary btn-sm">
                            {{translate('View cart')}}
                        </a>
                    </li>
                    {{-- @if (Auth::check())
                    <li class="list-inline-item">
                        <a href="{{ route('checkout.shipping_info') }}" class="btn btn-primary btn-sm">
                            {{translate('Checkout')}}
                        </a>
                    </li>
                    @endif --}}
                </ul>
            </div>
        @else
            <div class="text-center p-3">
                <i class="las la-frown la-3x opacity-60 mb-3"></i>
                <h3 class="h6 fw-700">{{translate('Your Cart is empty')}}</h3>
            </div>
        @endif
    @else
        <div class="text-center p-3">
            <i class="las la-frown la-3x opacity-60 mb-3"></i>
            <h3 class="h6 fw-700">{{translate('Your Cart is empty')}}</h3>
        </div>
    @endif


    @else
    @if(Session::has('cart'))

        @if( count($cart = Session::get('cart'))  > 0)
            <div class="p-3 fs-15 fw-600 p-3 border-bottom">
                <div class="d-flex flex-row" style="justify-content: space-between">
                    <span>{{translate('Cart Items')}}</span>
                <button onclick="removeAllCarts()" class="btn btn-icon btn-primary " data-toggle="tooltip" data-placement="bottom" title="{{ translate("remove all carts") }}"><i class="lab la-bitbucket"></i></button>

                </div>

            </div>
            <ul class="h-250px overflow-auto c-scrollbar-light list-group list-group-flush">
                @php

                 $total =0;

                       @endphp
                @foreach($cart as $key => $cartItem)


                    @php
                                $total_price = 0;
                        $total_price = $total_price + ($cartItem['price'] + $cartItem['tax']) *$cartItem['quantity'];

                        $product = \App\Product::find($cartItem['id']);
                        $total = $total + ($cartItem['price'] + $cartItem['tax'])*$cartItem['quantity'];
                    @endphp
                    @if ($product != null)
                        <li class="list-group-item">
                            <span class="d-flex align-items-center">
                                <a href="{{ route('product', $product->slug) }}" class="text-reset d-flex align-items-center flex-grow-1">
                                    <img
                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                        data-src="{{ uploaded_asset($product->thumbnail_img) }}"
                                        class="img-fit lazyload size-60px rounded"
                                        alt="{{ $product->name}}"
                                    >
                                    <span class="minw-0 pl-2 flex-grow-1">
                                        <span class="fw-600 mb-1 text-truncate-2">
                                                {{-- {{  $product->getTranslation('name')  }} --}}
                                                {{$product->name}}
                                        </span>
                                        <span class="">{{ $cartItem['quantity'] }}x</span>
                                        <span class="">{{ single_price($total_price) }}</span>
                                    </span>
                                </a>
                                <span class="">
                                    <button onclick="removeFromCart({{ $key  }})" class="btn btn-sm btn-icon stop-propagation">
                                        <i class="la la-close"></i>
                                    </button>
                                </span>
                            </span>
                        </li>
                    @endif
                @endforeach
            </ul>
            <div class="px-3 py-2 fs-15 border-top d-flex justify-content-between">
                <span class="opacity-60">{{translate('Subtotal')}}</span>
                <span class="fw-600">{{ single_price($total) }}</span>
            </div>
            <div class="px-3 py-2 text-center border-top">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">
                        <a href="{{ route('cart') }}" class="btn btn-soft-primary btn-sm">
                            {{translate('View cart')}}
                        </a>
                    </li>
                    @if (Auth::check())
                    <li class="list-inline-item">
                        <a href="{{ route('checkout.shipping_info') }}" class="btn btn-primary btn-sm">
                            {{translate('Checkout')}}
                        </a>
                    </li>
                    @endif
                </ul>
            </div>
        @else
            <div class="text-center p-3">
                <i class="las la-frown la-3x opacity-60 mb-3"></i>
                <h3 class="h6 fw-700">{{translate('Your Cart is empty')}}</h3>
            </div>
        @endif
    @else
        <div class="text-center p-3">
            <i class="las la-frown la-3x opacity-60 mb-3"></i>
            <h3 class="h6 fw-700">{{translate('Your Cart is empty')}}</h3>
        </div>
    @endif
    @endif
</div>
