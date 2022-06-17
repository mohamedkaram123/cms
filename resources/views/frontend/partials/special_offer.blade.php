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
            ->join('coupons', function ($join) {
                $join->on('coupons.id', '=', 'special_offers.coupon_id');
            })
            ->where("special_offers_customer_purchase.offer_applies_type", 1)
            ->where("special_offers.end_date", ">", now())

            ->select("special_offers_customer_purchase.*", "special_offers.*", "coupons.id as coupon_id","coupons.code")
            ->first();

            $coupon_usage = 1;
            if(!empty($special_offer_cart)){
        $coupon_usage = App\Models\CouponUsage::where("coupon_id", $special_offer_cart->coupon_id)->where("user_id", auth()->user()->id)->count();

            }

            // return dd($special_offer_cart);



        @endphp
            <div class="p-3 fs-15 fw-600 p-3 border-bottom">
                <div class="d-flex flex-row " style="display: flex;align-items: center;justify-content: space-between">
                    <div class="d-flex flex-column p-2">
                      <span>{{translate('Cart Items')}}</span>

                        <div class="d-flex flex-row" style="justify-content: space-around">
                            @if ($coupon_usage < 1)
                             <span style="font-size: 12px;background: var(--primary);border-radius: 20px;color: #fff;padding: 5px;width: fit-content" >{{ translate("Special Offer for a limited time")  }}</span>
                                  <span style="font-size: 12px;background: #333;border-radius: 20px;color: #fff;padding: 5px;width: fit-content">{{ translate("code") . ":" . $special_offer_cart->code }}</span>

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
                                        <span class="">{{ single_price($cartItem['price']) }}</span>
                                    </span>
                                </a>
                                <span class="">
                                    <button onclick="removeFromCart({{$key}},{{ $cartItem['id'] }})" class="btn btn-sm btn-icon stop-propagation">
                                        <i class="la la-close"></i>
                                    </button>
                                </span>
                            </span>
                        </li>
                @endforeach
            </ul>

        @else
            <div class="text-center p-3">
                <i class="las la-frown la-3x opacity-60 mb-3"></i>
                <h3 class="h6 fw-700">{{translate('There are no offers available')}}</h3>
            </div>
        @endif
    @else
        <div class="text-center p-3">
            <i class="las la-frown la-3x opacity-60 mb-3"></i>
            <h3 class="h6 fw-700">{{translate('There are no offers available')}}</h3>
        </div>
    @endif


      @endif
</div>
