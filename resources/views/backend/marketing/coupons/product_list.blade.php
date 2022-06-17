  <div id="list_inner_products" style="border:1px solid #eee;max-height: 400px;overflow: auto" >



    @if (isset($coupon))

    @foreach (json_decode($coupon->details) as $item )

    @php
      $product =  \App\Product::find($item->product_id);
    @endphp

    <div style="border:1px solid #eee;padding:10px;margin: 10px;">
        <span class="d-flex align-items-center">
            <div  class="text-reset d-flex align-items-center flex-grow-1">


                <img
                    src="{{uploaded_asset($product->photos)}}"
                    class="img-fit lazyload size-60px rounded"
                />
                <span class="minw-0 pl-2 flex-grow-1">
                    <span class="fw-600 mb-1 text-truncate-2">
                            {{ $product->getTranslation("name") }}
                    </span>
                    <span style="color:#fd7e14;fontWeight:400" >{{ trans("Price") . ": " . $product->purchase_price }}</span>

                </span>

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

    @foreach ($products as $item )

    <div style="border:1px solid #eee;padding:10px;margin: 10px;">
        <span class="d-flex align-items-center">
            <div  class="text-reset d-flex align-items-center flex-grow-1">


                <img
                    src="{{uploaded_asset($item->photos)}}"
                    class="img-fit lazyload size-60px rounded"
                />
                <span class="minw-0 pl-2 flex-grow-1">
                    <span class="fw-600 mb-1 text-truncate-2">
                            {{ $item->getTranslation("name") }}
                    </span>
                    <span style="color:#fd7e14;fontWeight:400" >{{ trans("Price") . ": " . $item->purchase_price }}</span>

                </span>

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
