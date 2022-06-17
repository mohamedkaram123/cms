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
                          <input class="form-check-input product_list" type="checkbox" value="{{$product->id}}" id="checked_product">

                        </div>
                  </div>


            </div>



        </span>
    </div>
