<div class="card-header mb-2">
    <h5 class="mb-0 h6">{{translate('Add Your Product Base Coupon')}}</h5>
</div>
<div class="form-group row">
    <label class="col-lg-3 control-label" for="coupon_code">{{translate('Coupon code')}}</label>
    <div class="col-lg-9">
        <input type="text" placeholder="{{translate('Coupon code')}}" id="coupon_code" name="coupon_code" value="{{ $coupon->code }}" class="form-control" required>
    </div>
</div>
<div class="product-choose-list">
    <div class="product-choose">
        <div class="form-group row ">
            <label class="col-lg-3 control-label" for="name">{{translate('Product')}}</label>
            <div class="col-lg-9 products-flashdeals">
                <input type="hidden" name="product_ids" />
                <button id="multi_selection_product"  class="btn btn-primary">{{ translate("Edit Product") }}</button>

                <span id="number_item_selecte">{{ str_replace("var_num",count(json_decode($coupon->details)),translate("Is Selected var_num Items")) }}</span>
            </div>
        </div>
    </div>
</div>
@php
  $start_date = date('m/d/Y', $coupon->start_date);
  $end_date = date('m/d/Y', $coupon->end_date);
@endphp
<div class="form-group row">
    <label class="col-sm-3 control-label" for="start_date">{{translate('Date')}}</label>
    <div class="col-sm-9">
      <input type="text" class="form-control aiz-date-range" value="{{ $start_date .' - '. $end_date }}" name="date_range" placeholder="Select Date">
    </div>
</div>

<div class="form-group row">
   <label class="col-lg-3 col-from-label">{{translate('Discount')}}</label>
   <div class="col-lg-3">
       <input type="number" lang="en" min="0" step="0.01" placeholder="{{translate('Discount')}}" value="{{ $coupon->discount }}" name="discount" class="form-control" required>

   </div>
   <div class="col-lg-6">
       <select class="form-control aiz-selectpicker" name="discount_type">
           <option value="amount" @if ($coupon->discount_type == 'amount') selected  @endif>{{translate('Amount Total Customer Purchasers')}}</option>
           <option value="percent" @if ($coupon->discount_type == 'percent') selected  @endif>{{translate('Rate Total Customer Purchasers')}}</option>
       </select>
   </div>
</div>



<div class="form-group row">
    <label class="col-sm-3 control-label" >{{translate('Minimum Amount of Purchases')}}</label>
    <div class="col-sm-9">
      <input type="number"  value="{{ $coupon->minimum_amount_of_purchases }}" id="minimum_amount_of_purchases"  min="1" class="form-control " name="minimum_amount_of_purchases" placeholder="{{ translate("Minimum Amount of Purchases") }}">
    </div>
</div>


<div class="form-group row">
    <label class="col-sm-3 control-label" >{{translate('Total Usage For All')}}</label>
    <div class="col-sm-9">
      <input type="number" value="{{ $coupon->total_usage_for_all }}" id="total_usage_for_all"  min="1" class="form-control " name="total_usage_for_all" placeholder="{{translate('Total Usage For All')}}">
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-3 control-label" >{{translate('Total Usage For One User')}}</label>
    <div class="col-sm-9">
      <input type="number" value="{{ $coupon->total_usage_for_one_user }}" id="total_user_usage"  min="1" class="form-control " name="total_usage_for_one_user" placeholder="{{translate('Total Usage For One User')}}">
    </div>
</div>


<div >

    @include('backend.marketing.coupons.search_product',[
        "coupon"=>$coupon
    ])
</div>


<script type="text/javascript">

    $(document).ready(function(){
        $('.aiz-date-range').daterangepicker();
        AIZ.plugins.bootstrapSelect('refresh');
    });

</script>
