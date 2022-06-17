  <div id="list_inner_products" style="border:1px solid #eee;max-height: 400px;overflow: auto" >



@if (isset($flashDeal))

    @foreach ($flashDeal->flash_deal_products as $item )

    @php
      $product =  \App\Product::find($item->product_id);
     // return dd($product);
    @endphp

    <div style="border:1px solid #eee;padding:10px;margin: 10px;">
        <span class="d-flex align-items-center">
            <div  class="text-reset d-flex align-items-center flex-grow-1">


                <img
                    src="{{uploaded_asset($product->photos)}}"
                    class="img-fit lazyload size-60px rounded"
                />
                <span style="overflow-wrap: break-word;width: 20%"  class="minw-0 pl-2 flex-grow-1">
                    <span class="fw-600 mb-1 text-truncate-2">
                            {{ $product->getTranslation("name") }}
                    </span>
                    <span style="color:#fd7e14;fontWeight:400" >{{ trans("Price") . ": " . single_price($product->unit_price) }}</span>

                </span>

                <div class="d-flex flex-row" style="justify-content: space-between;margin-inline: 100px">
                    <input id="discount_{{$product->id}}" value="{{$item->discount}}" class="form-control" type="number" style="margin-inline: 10px" />

                    <select class="form-control" id="type_{{$product->id}}">
                      <option <?php if($item->discount_type == 'amount') echo "selected";?> value="amount">{{translate("Amount")}}</option>
                        <option <?php if($item->discount_type == 'percent') echo "selected";?> value="percent">{{translate("Percent")}}</option>
                    </select>
                </div>

                  <div>
                      <div class="form-check">
                          <input checked class="form-check-input product_list" type="checkbox" value="{{$product->id}}" id="checked_product">

                        </div>
                  </div>


            </div>


        </span>
    </div>

    @endforeach

@else
<input type="hidden" value="{{ count($products) }}" />

    @foreach ($products as $item )

    <div style="border:1px solid #eee;padding:10px;margin: 10px;">
        <span class="d-flex align-items-center">
            <div  class="text-reset d-flex align-items-center flex-grow-1">


                <img
                    src="{{uploaded_asset($item->photos)}}"
                    class="img-fit lazyload size-60px rounded"
                />
                <span style="overflow-wrap: break-word;width: 20%"  class="minw-0 pl-2 flex-grow-1">
                    <span class="fw-600 mb-1 text-truncate-2">
                            {{ $item->getTranslation("name") }}
                    </span>
                    <span style="color:#fd7e14;fontWeight:400" >{{ translate("Price") . ": " . single_price($item->unit_price) }}</span>

                </span>

                <div class="d-flex flex-row" style="justify-content: space-between;margin-inline: 100px">
                    <input id="discount_{{$item->id}}" placeholder="{{ translate("Discount") }}" class="form-control" type="number" style="margin-inline: 10px" />

                    <select class="form-control" id="type_{{$item->id}}">
                      <option value="amount">{{translate("Amount")}}</option>
                        <option value="percent">{{translate("Percent")}}</option>
                    </select>
                </div>
                  <div>
                      <div class="form-check">
                          <input class="form-check-input product_list" type="checkbox" value="{{$item->id}}" id="checked_product">

                        </div>
                  </div>


            </div>



        </span>
    </div>

    @endforeach
    @endif

</div>


<div id="bottom_modal" style="display: flex;justify-content: center;align-items: center" class="d-none" style="margin: 20px">
    <img style="marginInline:10" src={{asset("public/assets/img/loading.gif")}} width="30px" height="30px" />
</div>
