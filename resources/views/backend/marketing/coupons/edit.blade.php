@extends('backend.layouts.app')

@section('content')

    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <h3 class="mb-0 h6">{{translate('Coupon Information Update')}}</h3>
            </div>
            <form action="{{ route('coupon.update', $coupon->id) }}" method="POST">
                <input name="_method" type="hidden" value="PATCH">
            	@csrf
                <div class="card-body">
                    <input type="hidden" name="id" value="{{ $coupon->id }}" id="id">
                    <div class="form-group row">
                        <label class="col-lg-3 col-from-label" for="name">{{translate('Coupon Type')}}</label>
                        <div class="col-lg-9">
                            <select name="coupon_type" id="coupon_type" class="form-control aiz-selectpicker" onchange="coupon_form()" required>
                                @if ($coupon->type == "product_base"))
                                    <option value="product_base" selected>{{translate('For Products')}}</option>
                                @elseif ($coupon->type == "cart_base")
                                    <option value="cart_base">{{translate('For Total Orders')}}</option>
                                @endif
                            </select>
                        </div>
                    </div>

                    <div id="coupon_form">

                    </div>
                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">{{translate('Save')}}</button>
                    </div>
            </form>

        </div>
    </div>


@endsection
@section('script')

<script type="text/javascript">

    function coupon_form(){
        var coupon_type = $('#coupon_type').val();
        var id = $('#id').val();
		$.post('{{ route('coupon.get_coupon_form_edit') }}',{_token:'{{ csrf_token() }}', coupon_type:coupon_type, id:id}, function(data){
            $('#coupon_form').html(data);



            $("#multi_selection_product").click(function(e){
                console.log("vvvvvvvvvvvv");
                e.preventDefault();

                $("#modal_search_product").modal();
                })

                $("#btn_search_product").click(function(e){
             //   e.preventDefault();


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

                        "_token": "{{ csrf_token() }}",


                    }
                    console.log({data});
                    $.ajax({
                        type: "post",
                        url: "{{ route("search.product.list") }}",
                        data,
                        success: function (response) {

                            $("#product_list").html(response.view)

                            arrayCheckboxes();



                        }
                    });
                })

                arrayCheckboxes();

         //    $('#demo-dp-range .input-daterange').datepicker({
         //        startDate: '-0d',
         //        todayBtn: "linked",
         //        autoclose: true,
         //        todayHighlight: true
        	// });
		});
    }

    function arrayCheckboxes(){
console.log("dsdsds");
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
    $(document).ready(function(){
        coupon_form();
        // arrayCheckboxes();

    });


</script>

@endsection
