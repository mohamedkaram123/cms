@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-10 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Flash Deal Information')}}</h5>
            </div>
            <div class="card-body">
                <form id="create_flashDealForm" action="{{ route('flash_deals.store') }}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-3 control-label" for="name">{{translate('Title')}}</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="{{translate('Title')}}" id="name" name="title" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label" for="background_color">{{translate('Background Color')}} <small>(Hexa-code)</small></label>
                        <div class="col-sm-9">
                            <input type="text" value="#fff" placeholder="{{translate('#FFFFFF')}}" id="background_color" name="background_color" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 control-label" for="name">{{translate('Text Color')}}</label>
                        <div class="col-lg-9">
                            <select name="text_color" id="text_color" class="form-control aiz-selectpicker" required>
                                <option value="">{{translate('Select One')}}</option>
                                <option value="white">{{translate('White')}}</option>
                                <option value="dark">{{translate('Dark')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="signinSrEmail">{{translate('Banner')}} <small>(1920x500)</small></label>
                        <div class="col-md-9">
                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="banner" class="selected-files">
                            </div>
                            <div class="file-preview box sm">
                            </div>
                            <span class="small text-muted">{{ translate('This image is shown as cover banner in flash deal details page.') }}</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 control-label" for="start_date">{{translate('Date')}}</label>
                        <div class="col-sm-9">
                          <input type="text" style="direction: ltr" class="form-control aiz-date-range" name="date_range" placeholder="Select Date" data-time-picker="true" data-format="DD-MM-Y HH:mm:ss" data-separator=" to " autocomplete="off" required="">
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-sm-3 control-label" for="products">{{translate('Products')}}</label>
                        <div class="col-sm-9">
                            <div class="product-choose-list" >
    <div class="product-choose" >
        <div class="form-group row products-flashdeals">

                <input type="hidden" name="product_ids" />
                <button  id="multi_selection_product"  class="btn btn-primary">{{ translate("Add Product") }}</button>

                <span id="number_item_selecte">{{translate("No Item Selected")}}</span>


        </div>
    </div>
</div>

<input type="hidden" id="products" name="products" required>
                            {{-- <select name="products[]" id="products" class="form-control aiz-selectpicker" multiple required data-placeholder="{{ translate('Choose Products') }}" data-live-search="true" data-selected-text-format="count"> --}}
                                {{-- @foreach(\App\Product::orderBy('created_at', 'desc')->get() as $product)
                                    <option value="{{$product->id}}">{{ $product->getTranslation('name') }}</option>
                                @endforeach --}}
                            {{-- </select> --}}
                        </div>
                    </div>
                    <br>
                    <div class="form-group row" id="discount_table">

                    </div>
                    <div class="form-group mb-0 text-right">
                        <button type="submit" id="btn_submit_form" class="btn btn-primary">{{translate('Save')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div >

    @include('backend.marketing.flash_deals.search_product')
</div>



@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){


              $("#btn_submit_form").click(function(e){

       if($("#products").val() != ""){
              //  $("#create_flashDealForm").submit();
                $('#create_flashDealForm').trigger('click');
       }else{
                   e.preventDefault();

             AIZ.plugins.notify('warning', '{{ translate('Please Enter Products') }}');

       }

    });


    // $("#btn_submit_form").click(function (e) {
    //            if($("#products").val() == ""){
    //                                AIZ.plugins.notify('warning', '{{ translate('Please Enter Products') }}');

    //            }
    // });



    function coupon_form(){

        var coupon_type = $('#coupon_type').val();
		$.post('{{ route('coupon.get_coupon_form') }}',{_token:'{{ csrf_token() }}', coupon_type:coupon_type}, function(data){
            $('#coupon_form').html(data);

            $("#multi_selection_product").click(function(e){
                e.preventDefault();

                $("#modal_search_product").modal();
                })

                $("#btn_search_product").click(function(e){
                e.preventDefault();

let limit = 10;
let offset = 0;
                    let data = {
                        name:$("#name_product").val(),
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
                        url: "{{ route("search.product.list.discount") }}",
                        data,
                        success: function (response) {

                        btn.html("{{translate('Search')}}")
                       btn.removeAttr("disabled");



                          $("#product_list").html(response.view)

                           arrayCheckboxes();
                            //$("#bottom_modal").addClass("d-none")


                                      $("#list_inner_products").scroll(function() {

                                      if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
                                                $("#bottom_modal").removeClass("d-none")
                                                offset +=limit


                    let data = {
                        name:$("#name_product").val(),
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

                                                // $("#btn_search_product").trigger("click");

                                                                    $.ajax({
                                                                    type: "post",
                                                                    url: "{{ route("search.product.list.discount.list") }}",
                                                                    data,
                                                                    success: function (response) {
                                                                        console.log({response});

                                                                  //  btn.html("{{translate('Save')}}")
                                                               // btn.removeAttr("disabled");

                                                                $("#list_inner_products").append(response.view)

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
        let id = $(this).val()
        let type = $("#type_" + id).val()
        let discount = $("#discount_" + id).val()

      return {
          id,
          discount:discount == ''?0:discount,
          type
      }
    }).get(); // <----
    $("#modal_search_product").modal("hide");
    // $('[name=product_ids]').val(searchIDs);
    $('[name="products"]').val( JSON.stringify( searchIDs ) );

    var str = "{{ translate("Is Selected var_num Items") }}";
var res = str.replace("var_num", searchIDs.length);

$("#number_item_selecte").text(res);

});


}


coupon_form()
                } ) ;



    </script>
@endsection
