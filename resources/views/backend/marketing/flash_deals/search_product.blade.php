<!-- Modal -->
<div  class="modal  fade" id="modal_search_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">


        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="exampleModalLongTitle">{{translate("search product")}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
            </div>





        <div class="modal-body">
            <div class="py-1 px-4 ">
                <div class="row clearfix mt-3">

                    <div class="form-group col-6">
                        <input id="name_product" name="name_product" class="form-control" type="text" placeholder="{{ translate("Product Name") }}" />
                   </div>

                   <div  class="form-group col-6">
                      <select id="category_id" name="category_id" class="form-control aiz-selectpicker">
                        <option value="">{{ translate("Choose Category") }}</option>

                          @foreach (\App\Category::all() as $item )
                          <option value="{{ $item->id }}">{{ $item->name }}</option>
                          @endforeach
                       </select>
                   </div>
                   </div>


                <div class="row clearfix mt-3">
                    <div class="form-group col-6">
                        <select id="brand_id" name="brand_id" class="form-control aiz-selectpicker">
                            <option value="">{{ translate("Choose Brand") }}</option>

                            @foreach (\App\Brand::all() as $item )
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                         </select>
                     </div>
                     <div class="form-group col-6">
                        <input id="unit_price" name="unit_price" class="form-control" type="number" placeholder="{{ translate("Unit Price") }}" />
                   </div>
                </div>
                <div class="row clearfix mt-3">

                    <div class="form-group col-6">
                       <input id="current_stock" name="current_stock" class="form-control" type="number" placeholder="{{ translate("Quantity") }}" />
                  </div>
                  <div class="form-group col-6">
                    <input id="discount" name="discount_product" class="form-control" type="number" placeholder="{{ translate("Discount") }}" />
               </div>
               </div>

               <div class="row clearfix mt-3">

                <div class="form-group col-6">
                   <input id="purchase_price" name="purchase_price" class="form-control" type="number" placeholder="{{ translate("Purchase Price") }}" />
              </div>
              <div class="form-group col-6">
                <input id="shipping_cost" name="shipping_cost" class="form-control" type="number" placeholder="{{ translate("Shipping Cost") }}" />
           </div>
           </div>

        </div>

        <div class="row clearfix mt-3">

            <div class="col-12 form-group  text-right">

            <button id="btn_search_product" class="btn btn-primary">{{ translate("Search") }}</button>
        </div>
       </div>



       <div id="product_list" >
           @if(isset($flashDeal))

           @include("backend.marketing.flash_deals.product_list",[
               "flashDeal"=>$flashDeal
           ])

           @else

           @endif

       </div>

    </div>


        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ translate("Close") }}</button>
          <button type="button" id="save_changes_modal" class="btn btn-primary">{{translate("Save Changes")}}</button>
        </div>
      </div>
    </div>
  </div>
