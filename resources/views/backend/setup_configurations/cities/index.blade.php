@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
    	<div class="row align-items-center">
    		<div class="col-md-12">
    			<h1 class="h3">{{translate('All cities')}}</h1>
    		</div>
    	</div>
    </div>
    <div class="row">
        <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal" action="{{ route('CitesImport') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                                                    <div class="alert" style="color: #004085;background-color: #cce5ff;border-color: #b8daff;margin-bottom:0;margin-top:10px;">
                                                        <strong>{{ translate('Step 1')}}:</strong>
                                                        <p>1. {{translate('Download the skeleton file and fill it with proper data')}}.</p>
                                                        <p>2. {{translate('You can download the example file to understand how the data must be filled')}}.</p>
                                                        <p>3. {{translate('Once you have downloaded and filled the skeleton file, upload it in the form below and submit')}}.</p>

                                                    </div>
                                                    <br>
                                                    <div class="">
                                                        <a class="btn btn-info" href="{{route('CitesExport')}}" download>{{ translate('Download CSV')}}</a>
                                                    </div>
                                                    <div class="alert" style="color:#004085;background-color:#cce5ff;border-color:#b8daff;margin-bottom:0;margin-top:10px;" >
                                                        <strong>{{translate('Step 2')}}:</strong>
                                                        <p>1. {{translate('Governorates should be in numerical id')}}.</p>
                                                        <p>2. {{translate('You can download the pdf to get Governorates id')}}.</p>
                                                    </div>
                                                    <br>
                                                    <div class="">
                                                        <a class="btn btn-info" href="{{ route('pdf.download_governorate') }}" download>{{translate('Download Governorates')}}</a>
                                                    </div>
                                                    <br>
                <div class="alert" style="color:#004085;background-color:#cce5ff;border-color:#b8daff;margin-bottom:0;margin-top:10px;" >
                                                        <strong>{{translate('Step 3')}}:</strong>
                                                        <p>1. {{translate('Enter Your File')}}.</p>
                                                    </div>
                                                    <br>
                            <div class="form-group mb-0" style="margin-block: 10px">
                <div class="input-group" data-toggle="aizuploader"  data-multiple="false" data-type="document">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                                    </div>
                                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                                    <input type="hidden" name="city_file" class="selected-files" required>

                                                </div>
                                                <br />
                                <button type="submit" class="btn btn-info">{{translate('Upload CSV')}}</button>
                            </div>
                        </form>
                    </div>

                </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                            <label class="col-lg-3 col-from-label">{{translate("Choose Tax Shipping")}}</label>

                </div>
                <div class="card-body">
    <div class="form-group row" >

                            <div class="form-group col-md-3">


                                    <select  class="form-control tax_select"  name="tax[]">
                                    @foreach(\App\Tax::where('tax_status', 1)->get() as $tax)
                                        <option value="{{$tax->id}}"  {{get_setting("shipping_tax") == $tax->id?"selected":""}} >{{$tax->name}}</option>
                                    @endforeach
                                    </select>

                            </div>
                    </div>

        </div>
                </div>
            </div>

        <div class="col-md-7">
            <div class="card">
                <div class="card-header row gutters-5">
                    <div class="col text-center text-md-left">
                        <h5 class="mb-md-0 h6">{{ translate('Cities') }}</h5>
                    </div>
                    <div class="col-md-4">
                        <form class="" id="sort_cities" action="" method="GET">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" id="search" name="search"@isset($sort_search) value="{{ $sort_search }}" @endisset placeholder="{{ translate('Type name & Enter') }}">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table aiz-table mb-0">
                        <thead>
                            <tr>
                                <th data-breakpoints="lg">#</th>
                                <th>{{translate('Country')}}</th>
                                <th>{{translate('Governorate')}}</th>
                                <th>{{translate('City')}}</th>
                                <th data-breakpoints="lg">{{translate('Cost')}}</th>
                                <th data-breakpoints="lg">{{translate('Pool Area')}}</th>
                                <th data-breakpoints="lg">{{translate('Shipping Days')}}</th>

                                <th data-breakpoints="lg" class="text-right">{{translate('Options')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cities as $key => $city)
                                <tr>
                                    <td>{{ ($key+1) + ($cities->currentPage() - 1)*$cities->perPage() }}</td>
                                    <td>{{ $city->governorate->country->name }}</td>
                                    <td>{{ $city->governorate->name }}</td>
                                    <td>{{ $city->name }}</td>
                                    <td>{{ $city->cost }}</td>
                                    <td>{{ $city->pool_area == "1"?translate("pool area"):translate("area") }}</td>
                                    <td>{{ $city->shipping_days }}</td>

                                    <td class="text-right">
                                        <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{ route('admin.cities.edit', ['id'=>$city->id, 'lang'=>env('DEFAULT_LANGUAGE')]) }}" title="{{ translate('Edit') }}">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete" data-href="{{route('cities.destroy', $city->id)}}" title="{{ translate('Delete') }}">
                                            <i class="las la-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="aiz-pagination">
                        {{ $cities->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-5">
    		<div class="card">
    			<div class="card-header">
    				<h5 class="mb-0 h6">{{ translate('Add New city') }}</h5>
    			</div>
    			<div class="card-body">
    				<form action="{{ route('cities.store') }}" method="POST">
    					@csrf
    					<div class="form-group mb-3">
    						<label for="name">{{translate('Name')}}</label>
    						<input type="text" placeholder="{{translate('Name')}}" name="name" class="form-control" required>
    					</div>
                        <div class="form-group">
                            <label for="governorate">{{translate('Countries')}}</label>
                            <select class="select2 form-control aiz-selectpicker" id="country_id" name="country_id" data-toggle="select2" data-placeholder="Choose ..." data-live-search="true">
                               <option value="">{{translate("choose country")}}</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="governorate">{{translate('Governorate')}}</label>
                            <select class="select2 form-control " id="governorate_selection" name="governorate_id" data-toggle="select2" data-placeholder="Choose ..." data-live-search="true" required>

                            </select>
                        </div>

                        <div class="form-group mb-3">
    						<label for="name">{{translate('Cost')}}</label>
                            <span  class='badge badge-primary' style='width:auto;'> {{ translate("The cost is including tax") }}</span>
    						<input type="number" min="0" step="0.01" placeholder="{{translate('Cost')}}" name="cost" class="form-control" required>
    					</div>

                        <div class="form-group mb-3">
    						<label for="name">{{translate('Shipping Days')}}</label>
    						<input type="number" min="0" step="0.01" placeholder="{{translate('Shipping Days')}}" name="shipping_days" class="form-control" required>
    					</div>

                        <div class="form-group mb-3 d-none">
    						<label for="name">{{translate('Pool Areas')}}</label>
                            <select class="select2 form-control aiz-selectpicker" name="pool_area" data-toggle="select2" data-placeholder="Choose ..." data-live-search="true">
                                <option value="0">{{ translate("area") }}</option>
                                 <option value="1">{{ translate("pool area") }}</option>
                            </select>
    					</div>

    					<div class="form-group mb-3 text-right">
    						<button type="submit" class="btn btn-primary">{{translate('Save')}}</button>
    					</div>
    				</form>
    			</div>
    		</div>
    	</div>
    </div>
@endsection

@section('modal')
    @include('modals.delete_modal')
@endsection

@section('script')
    <script type="text/javascript">

        function update_status(el){
            if(el.checked){
                var status = 1;
            }
            else{
                var status = 0;
            }
        }

        $("#country_id").change(function (e) {

        let  id = $(this).val();
        if(id == ""){
                                          $("#governorate_selection").html("");

        }else{
 $.ajax({
            type: "get",
            url: "{{ url("admin/cities/governorates/") }}/"+id,
            success: function (response) {
                              $("#governorate_selection").html("");

                response.forEach(item => {
               $("#governorate_selection").append("<option value="+item.id+" >"+item.name+"</option>");

                });
            }
        });
        }

        });

        "shipping_tax_percent"
        $(".tax_select").change(function (e) {


            e.preventDefault();
              let type = "shipping_tax";
            let value = $(this).val();
                   $.post('{{ route('business_settings.update.activation') }}', {_token:'{{ csrf_token() }}', type:type, value:value}, function(data){
                if(data == '1'){
                    AIZ.plugins.notify('success', 'Settings updated successfully');
                }
                else{
                    AIZ.plugins.notify('danger', 'Something went wrong');
                }
            });
        });
    // function updateSettings(el, type){
    //         if($(el).is(':checked')){
    //             var value = 1;
    //         }
    //         else{
    //             var value = 0;
    //         }
    //         // console.log({typpe});
    //         $.post('{{ route('business_settings.update.activation') }}', {_token:'{{ csrf_token() }}', type:type, value:value}, function(data){
    //             if(data == '1'){
    //                 AIZ.plugins.notify('success', 'Settings updated successfully');
    //             }
    //             else{
    //                 AIZ.plugins.notify('danger', 'Something went wrong');
    //             }
    //         });
    //     }

    </script>
@endsection
