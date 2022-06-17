@extends('frontend.layouts.app')

@section('content')


<section class="pt-5 mb-4">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 mx-auto">
                <div class="row aiz-steps arrow-divider">
                    <div class="col done">
                        <div class="text-center text-success">
                               <a href="{{ route("cart") }}" class="text-success">
                            <i class="la-3x mb-2 las la-shopping-cart"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block text-capitalize">{{ translate('1. My Cart')}}</h3>
                               </a>
                        </div>
                    </div>
                    <div class="col active">
                        <div class="text-center text-primary">

                            <i class="la-3x mb-2 las la-shopping-bag"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block text-capitalize">{{ translate('2. Choose Products')}}</h3>

                        </div>
                    </div>
                    <div class="col ">
                        <div class="text-center ">
                            <i class="la-3x mb-2 las la-truck"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block text-capitalize">{{ translate('3. Delivery info')}}</h3>
                        </div>
                    </div>
                    <div class="col">
                        <div class="text-center">
                            <i class="la-3x mb-2 opacity-50 las la-credit-card"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50 text-capitalize">{{ translate('4. Payment')}}</h3>
                        </div>
                    </div>
                    <div class="col">
                        <div class="text-center">
                            <i class="la-3x mb-2 opacity-50 las la-check-circle"></i>
                            <h3 class="fs-14 fw-600 d-none d-lg-block opacity-50 text-capitalize">{{ translate('5. Confirmation')}}</h3>
                        </div>
                    </div>
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

@if(get_setting("multy_vendors") == 1)
@include('frontend.vendors.multy_vendors')
@else
@include('frontend.vendors.single_vendor')

@endif
@endsection

@section('script')
    <script type="text/javascript">


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


        @if(get_setting("multy_vendors") == 1)

   let arr = [];

        $(".check_product").change(function (e) {
            e.preventDefault();


            let owner_id = $(this).data("owner_id");
            let product_id = $(this).data("product_id");
            let data = {
                owner_id,
                product_id
            }


                   console.log({lastOpenSite});

            if(arr.length != 0){
                if(arr[0].owner_id != owner_id){

// lastOpenSite.forEach(element => {
//     console.log({element});

//     element.attr("checked",true);

// });
                                    AIZ.plugins.notify('warning', "{{ translate("please check product from same shop") }}");

                }else{

                     if($(this).prop('checked')){
                  arr.push(data);



          }else{
          arr = arr.filter(item => item.product_id !== product_id);

          }
                }
            }else{

                console.log({arr});


               if($(this).prop('checked')){

                  arr.push(data);

                    var lastOpenSite = $(".check_product").not('.check_product_'+owner_id);
                   lastOpenSite.attr("disabled",true);
          }else{
          arr = arr.filter(item => item.product_id !== product_id);


          }
            }

    if(arr.length == 0){
                  var lastOpenSite = $(".check_product");
                   lastOpenSite.attr("disabled",false);
            }
           $("#products_btn_"+owner_id).val( JSON.stringify(arr))

        });




 function removeArr(owner_id) {
     console.log('ssssssccccccccc');
arr =  arr.filter(function( obj ) {
    return obj.owner_id !== owner_id;
});
arr = myArra
  }


$(".products_btn").click(function (e) {


  if(arr.length != 0){


    }else{
            e.preventDefault();

                        AIZ.plugins.notify('warning', "{{ translate("please check product") }}");

    }


});



//     $(".choose_all").click(function (e) {

//         let seller_id = $(this).data("seller_id");
//         e.preventDefault();

//         $(".check_product").trigger("click");
//    if(arr.length == 0){
//                   var lastOpenSite = $(".check_product");
//                    lastOpenSite.attr("disabled",false);
//             }

//         if(arr.length == 0){
//         $(this).removeClass("active")
//         }else{
//         $(this).addClass("active")
//         }

//     });
        @else
                    let arr = [];

                        $(".check_product").change(function (e) {
                            e.preventDefault();



                            let owner_id = $(this).data("owner_id");
                            let product_id = $(this).data("product_id");
                            let data = {
                                owner_id,
                                product_id
                            }

                        console.log($(this).prop('checked'));
                            if($(this).prop('checked')){
                                arr.push(data);

                        }else{
                        arr = arr.filter(item => item.product_id !== product_id);

                        }
                            console.log(arr);

                        $("#products_btn").val( JSON.stringify(arr))

                        });




                function removeArr(owner_id) {
                    console.log('ssssssccccccccc');
                arr =  arr.filter(function( obj ) {
                    return obj.owner_id !== owner_id;
                });
                arr = myArra
                }


                $("#products_btn").click(function (e) {

                if(arr.length != 0){


                    }else{
                            e.preventDefault();

                                        AIZ.plugins.notify('warning', "{{ translate("please check product") }}");

                    }


                });



                    $("#choose_all").click(function (e) {
                        e.preventDefault();


                        $(".check_product").trigger("click");

                        if(arr.length == 0){
                        $(this).removeClass("active")
                        }else{
                        $(this).addClass("active")
                        }

                    });
        @endif


    </script>
@endsection
