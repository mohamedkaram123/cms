@extends('backend.layouts.app')

@section('content')

{{--
@php
            $products = App\Product::offset(10)->limit(10)->get();

return dd($products);
@endphp --}}
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Coupon Information Adding')}}</h5>
            </div>
            <div class="card-body">
              <form class="form-horizontal" action="{{ route('coupon.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label class="col-lg-3 col-from-label" for="name">{{translate('Coupon Type')}}</label>
                    <div class="col-lg-9">
                        <select name="coupon_type" id="coupon_type" class="form-control aiz-selectpicker" onchange="coupon_form()" required>
                            <option value="">{{translate('Select One') }}</option>
                            <option value="product_base">{{translate('For Products')}}</option>
                            <option value="cart_base">{{translate('For Total Orders')}}</option>
                        </select>
                    </div>
                </div>

                <div id="coupon_form">

                </div>
                <div class="form-group mb-0 text-right">
                    <button type="submit" class="btn btn-primary">{{translate('Save')}}</button>
                </div>
              </from>
            </div>
        </div>
    </div>

@endsection
@section('script')

<script type="text/javascript">

let limit = 10;
let offset = 0;

    function coupon_form(){
        var coupon_type = $('#coupon_type').val();
		$.post('{{ route('coupon.get_coupon_form') }}',{_token:'{{ csrf_token() }}', coupon_type:coupon_type}, function(data){
            $('#coupon_form').html(data);

            $("#multi_selection_product").click(function(e){
                console.log("vvvvvvvvvvvv");
                e.preventDefault();

                $("#modal_search_product").modal();
                })

                $("#btn_search_product").click(function(e){
                e.preventDefault();


                    let data = {
                        name:$("#name").val(),
                        discount:$("#discount").val(),
                        unit_price:$("#unit_price").val(),
                        brand_id:$("#brand_id").val(),
                        category_id:$("#category_id").val(),
                        current_stock:$("#current_stock").val(),
                        purchase_price:$("#purchase_price").val(),
                        shipping_cost:$("#shipping_cost").val(),
                        limit,
                        offset,
                        "_token": "{{ csrf_token() }}",
                    }

                    $(this).append('<img style="marginInline:10" src={{asset("public/assets/img/loading.gif")}} width="15px" height="15px" />');

                    $(this).attr("disabled",true);
              //      $(this)
                    let btn = $(this)
                    $.ajax({
                        type: "post",
                        url: "{{ route("search.product.list") }}",
                        data,
                        success: function (response) {

                        btn.html("{{translate('Save')}}")
                       btn.removeAttr("disabled");



                          $("#product_list").html(response.view)

                           arrayCheckboxes();
                            //$("#bottom_modal").addClass("d-none")


                                      $("#list_inner_products").scroll(function() {
                                          console.log({
                                              "height inner":$("#list_inner_products").scrollTop + $("#list_inner_products").clientHeight,
                                              "height":$("#list_inner_products").scrollHeight,

                                          });
                                      if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
                                                $("#bottom_modal").removeClass("d-none")
                                                offset +=limit


                    let data = {
                        name:$("#name").val(),
                        discount:$("#discount").val(),
                        unit_price:$("#unit_price").val(),
                        brand_id:$("#brand_id").val(),
                        category_id:$("#category_id").val(),
                        current_stock:$("#current_stock").val(),
                        purchase_price:$("#purchase_price").val(),
                        shipping_cost:$("#shipping_cost").val(),
                                                list_type:"coupon",

                        limit,
                        offset,
                        "_token": "{{ csrf_token() }}",
                    }
                    console.log({data});

                                                // $("#btn_search_product").trigger("click");

                                                                    $.ajax({
                                                                    type: "post",
                                                                    url: "{{ route("search.product.list") }}",
                                                                    data,
                                                                    success: function (response) {

                                                                  //  btn.html("{{translate('Save')}}")
                                                               // btn.removeAttr("disabled");

                                                                $("#list_inner_products").append(response.views)

                                                                arrayCheckboxes();
                                                                    $("#bottom_modal").addClass("d-none")

                                                                    }
                                                                })

                                            }
                                            });

                        }
                    });
                })



                getdata = ()=>{

                }

         //    $('#demo-dp-range .input-daterange').datepicker({
         //        startDate: '-0d',
         //        todayBtn: "linked",
         //        autoclose: true,
         //        todayHighlight: true
        	// });
		});
    }


function arrayCheckboxes(){

    $("#save_changes_modal").click(function(event){
    event.preventDefault();
    var searchIDs = $(".product_list:checkbox:checked").map(function(){
      return $(this).val();
    }).get(); // <----
    console.log(searchIDs);
    $("#modal_search_product").modal("hide");
    // $('[name=product_ids]').val(searchIDs);
    $('[name="product_ids"]').val( JSON.stringify( searchIDs ) );

    var str = "{{ translate("Is Selected var_num Items") }}";
var res = str.replace("var_num", searchIDs.length);

$("#number_item_selecte").text(res);

});


}

</script>

@endsection
