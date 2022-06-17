@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">{{translate('Flash Deal Information')}}</h5>
</div>

<div class="row">
    <div class="col-lg-10 mx-auto">
        <div class="card">
            <div class="card-body p-0">
              <ul class="nav nav-tabs nav-fill border-light">
                @foreach (\App\Language::all() as $key => $language)
                  <li class="nav-item">
                    <a class="nav-link text-reset @if ($language->code == $lang) active @else bg-soft-dark border-light border-left-0 @endif py-3" href="{{ route('flash_deals.edit', ['id'=>$flash_deal->id, 'lang'=> $language->code] ) }}">
                      <img src="{{ static_asset('assets/img/flags/'.$language->code.'.png') }}" height="11" class="mr-1">
                      <span>{{$language->name}}</span>
                    </a>
                  </li>
                 @endforeach
              </ul>
              <form class="p-4" action="{{ route('flash_deals.update', $flash_deal->id) }}" method="POST">
                @csrf
                  <input type="hidden" name="_method" value="PATCH">
                  <input type="hidden" name="lang" value="{{ $lang }}">

                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="name">{{translate('Title')}} <i class="las la-language text-danger" title="{{translate('Translatable')}}"></i></label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="{{translate('Title')}}" id="name" name="title" value="{{ $flash_deal->getTranslation('title', $lang) }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-from-label" for="background_color">{{translate('Background Color')}}<small>(Hexa-code)</small></label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="{{translate('#0000ff')}}" id="background_color" name="background_color" value="{{ $flash_deal->background_color }}" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-from-label" for="text_color">{{translate('Text Color')}}</label>
                        <div class="col-lg-9">
                            <select name="text_color" id="text_color" class="form-control demo-select2" required>
                                <option value="">Select One</option>
                                <option value="white" @if ($flash_deal->text_color == 'white') selected @endif>{{translate('White')}}</option>
                                <option value="dark" @if ($flash_deal->text_color == 'dark') selected @endif>{{translate('Dark')}}</option>
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
                                <input type="hidden" name="banner" value="{{ $flash_deal->banner }}" class="selected-files">
                            </div>
                            <div class="file-preview box sm">
                            </div>
                        </div>
                    </div>

                    @php
                      $start_date = date('d-m-Y H:i:s', $flash_deal->start_date);
                      $end_date = date('d-m-Y H:i:s', $flash_deal->end_date);
                    @endphp

                    <div class="form-group row" >
                        <label class="col-sm-3 col-from-label" for="start_date">{{translate('Date')}}</label>
                        <div class="col-sm-9">
                          <input type="text" style="direction: ltr" class="form-control aiz-date-range" value="{{ $start_date.' to '.$end_date }}" name="date_range" placeholder="Select Date" data-time-picker="true" data-format="DD-MM-Y HH:mm:ss" data-separator=" to " autocomplete="off" required="">
                        </div>
                    </div>
                    <div class="product-choose-list">
                        <div class="product-choose">
                            <div class="form-group row ">
                                <label class="col-lg-3 control-label" for="name">{{translate('Product')}}</label>
                                <div class="col-lg-9 products-flashdeals">
                                    <input type="hidden" name="product_ids" />
                                    <button id="multi_selection_product"  class="btn btn-primary">{{ translate("Edit Product") }}</button>

                                    <span id="number_item_selecte">{{ str_replace("var_num",count($flash_deal->flash_deal_products),translate("Is Selected var_num Items")) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="products" value="{{$prducts_encode}}" name="products" required>

                    <br>
                    <div class="form-group row" id="discount_table">

                    </div>
                    <div class="form-group mb-0 text-right">
                        <button id="btn_submit_form" type="submit" class="btn btn-primary">{{translate('Save')}}</button>
                    </div>
                  </form>
              </div>
        </div>
    </div>
</div>
<div >

    @include('backend.marketing.flash_deals.search_product',[
                      "flashDeal"=>$flash_deal

    ])
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
                        list_type:"flashDeal",
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

arrayCheckboxes()
coupon_form()
                } ) ;



    </script>
@endsection
