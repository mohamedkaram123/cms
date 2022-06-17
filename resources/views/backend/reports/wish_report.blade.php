@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
	<div class=" align-items-center">
       <h1 class="h3">{{translate('Product Wish Report')}}</h1>
	</div>
</div>

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-body">
                <form   action="{{ route('wish_report.index') }}" method="GET">
                    <div class="row" style="align-items: center">

                          <div class="col-md-4 col-sm-12">
                              <div class="form-group ">
                                    <label >{{ translate('Date from') }}:</label>
                                    <input type="date" value="{{request()->has("date_from")?request("date_from"):""}}" class="form-control " id="search" name="date_from" placeholder="{{ translate('Daterange') }}">
                              </div>
                        </div>

                                                 <div class="col-md-4 col-sm-12">
                              <div class="form-group ">
                                    <label >{{ translate('Date to') }}:</label>
                                    <input type="date" value="{{request()->has("date_to")?request("date_to"):""}}" class="form-control " id="search" name="date_to" placeholder="{{ translate('Daterange') }}">
                              </div>
                        </div>

                         <div class="col-md-3 col-sm-12">
                              <div class="form-group ">
                                    <label >{{ translate('Arrange Type') }}:</label>
                              <select  class="from-control w-100 aiz-selectpicker" name="arrange_type" >
                                <option value="">{{translate("Choose Arrange")}}</option>
                                <option @if(request("arrange_type") == "desc") selected @endif value="desc">{{translate("Desc")}}</option>
                                <option @if(request("arrange_type") == "asc") selected @endif value="asc">{{translate("Asc")}}</option>
                            </select>
                           </div>
                        </div>


                    </div>
                    <div class="row" style="align-items: center">
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group ">
                            <label >{{ translate('Sort by Category') }}:</label>
                             <select class="from-control w-100 aiz-selectpicker" name="category_id" >
                            <option value="">{{translate("Choose Category")}}</option>
                                @foreach (\App\Category::all() as $key => $category)
                                    <option value="{{ $category->id }}" @if($category->id == $sort_by) selected @endif>{{ $category->getTranslation('name') }}</option>
                                @endforeach
                            </select>
                            </div>
                           </div>

                           <div class="col-md-3">
                               <button class="btn btn-primary">{{translate("search")}}</button>
                           </div>
                    </div>
                </form>

                <table class="table table-bordered aiz-table mb-0">
                    <thead>
                        <tr>
                            <th>{{ translate('Product Name') }}</th>
                            <th>{{ translate('Number of Wish') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $product)
                            @if($product->wishlists != null)
                                <tr>
                                    <td>{{ $product->getTranslation('name') }}</td>
                                    <td>{{ $product->wishlists->count() }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                <div class="aiz-pagination mt-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
