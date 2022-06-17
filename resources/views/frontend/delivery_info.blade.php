@extends('frontend.layouts.app')

@section('content')


<section class="pt-5 mb-4">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 mx-auto">
                <div class="row ">
                    <div class="col done">
                        <div class="text-center text-success">
                               <a href="{{ route("cart") }}" class="text-success">
                            <i class="la-3x mb-2 las la-shopping-cart"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block text-capitalize">{{ translate('1. My Cart')}}</h3>
                               </a>
                        </div>
                    </div>
                    {{-- <div class="col done">
                        <div class="text-center text-success">
                                                    <a href="{{ route("checkout.choose_products") }}" class="text-success">

                            <i class="la-3x mb-2 las la-shopping-bag"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block text-capitalize">{{ translate('2. Choose Products')}}</h3>
                                                    </a>
                        </div>
                    </div> --}}
                    <div class="col active">
                        <div class="text-center text-primary">
                            <i class="la-3x mb-2 las la-truck"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block text-capitalize">{{ translate('2. Delivery info')}}</h3>
                        </div>
                    </div>
                    <div class="col">
                        <div class="text-center">
                            <i class="la-3x mb-2 opacity-50 las la-credit-card"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50 text-capitalize">{{ translate('3. Payment')}}</h3>
                        </div>
                    </div>
                    {{-- <div class="col">
                        <div class="text-center">
                            <i class="la-3x mb-2 opacity-50 las la-check-circle"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50 text-capitalize">{{ translate('5. Confirmation')}}</h3>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</section>
{{-- @include("frontend.shipping_info") --}}
{{--
<section class="py-4 gry-bg">
    <div class="container" style="width: 50%">

                                    <div  class="row gutters-5">
                                        <div class="col-6">
                                            <label class="aiz-megabox d-block bg-white mb-0">
                                                <input
                                                    type="radio"
                                                    name="shipping_type_{{ \App\User::where('user_type', 'admin')->first()->id }}"
                                                    value="home_delivery"
                                                    onchange="show_pickup_point(this)"
                                                    data-target=".pickup_point_id_admin"
                                                    checked
                                                >
                                                <span class="d-flex p-3 aiz-megabox-elem">
                                                    <span class="aiz-rounded-check flex-shrink-0 mt-1"></span>
                                                    <span class="flex-grow-1 pl-3 fw-600">{{  translate('Home Delivery') }}</span>
                                                </span>
                                            </label>
                                        </div>
                                        <div class="col-6">
                                            <label class="aiz-megabox d-block bg-white mb-0">
                                                <input
                                                    type="radio"
                                                    name="shipping_type_{{ \App\User::where('user_type', 'admin')->first()->id }}"
                                                    value="pickup_point"
                                                    onchange="show_pickup_point(this)"
                                                    data-target=".pickup_point_id_admin"
                                                >
                                                <span class="d-flex p-3 aiz-megabox-elem">
                                                    <span class="aiz-rounded-check flex-shrink-0 mt-1"></span>
                                                    <span class="flex-grow-1 pl-3 fw-600">{{  translate('Local Pickup') }}</span>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
    </div>
</section> --}}
<section class="py-4 gry-bg">
    <div class="container">
<div class="row cols-xs-space cols-sm-space cols-md-space">

            <div class="col-xxl-8 col-xl-10 mx-auto text-left">
  <form class="form-default form-store_delivery_info" action="{{ route('checkout.store_delivery_info') }}" role="form" method="POST">

                    @csrf
                    <input type="hidden" name="productss" value="{{$products}}" />
                    <div id="shipping_data" data-product_manage_by_admin="{{ get_setting('product_manage_by_admin') }}" data-seller_id="{{ $seller_id }}">

                    </div>

                    <div class="card-footer "  >

                                    <button type="submit"  class="btn fw-600 btn-primary">{{ translate('Continue to Payment')}}</a>

                            {{-- <button type="submit" name="owner_id" value="{{ App\User::where('user_type', 'admin')->first()->id }}" class="btn fw-600 btn-primary">{{ translate('Continue to Payment')}}</a> --}}
                        </div>

  </form>
            </div>


        </div>
<div class="pt-4">
                    <a href="{{ route('home') }}" >
                        <i class="la la-angle-left"></i>
                        {{ translate('Return to shop')}}
                    </a>
                </div>
    </div>
</section>
@endsection

@section('script')
    <script type="text/javascript">

      $(".shipping_btn").click(function (e) {
          e.preventDefault();

      });

        function display_option(key){

        }
        function show_pickup_point(el) {
        	var value = $(el).val();
        	var target = $(el).data('target');

            // console.log(value);

        	if(value == 'home_delivery'){
                if(!$(target).hasClass('d-none')){
                    $(target).addClass('d-none');
                }
        	}else{
        		$(target).removeClass('d-none');
        	}
        }



    </script>
@endsection
