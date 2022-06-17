@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">{{translate('City Information')}}</h5>
</div>

<div class="row">
  <div class="col-lg-8 mx-auto">
      <div class="card">
          <div class="card-body p-0">
              <ul class="nav nav-tabs nav-fill border-light">
    				@foreach (\App\Language::all() as $key => $language)
    					<li class="nav-item">
    						<a class="nav-link text-reset @if ($language->code == $lang) active @else bg-soft-dark border-light border-left-0 @endif py-3" href="{{ route('cities.edit', ['id'=>$city->id, 'lang'=> $language->code] ) }}">
    							<img src="{{ static_asset('assets/img/flags/'.$language->code.'.png') }}" height="11" class="mr-1">
    							<span>{{ $language->name }}</span>
    						</a>
    					</li>
  	            @endforeach
    			</ul>
              <form class="p-4" action="{{ route('cities.update', $city->id) }}" method="POST" enctype="multipart/form-data">
                  <input name="_method" type="hidden" value="PATCH">
                  <input type="hidden" name="lang" value="{{ $lang }}">
                  @csrf
                  <div class="form-group mb-3">
                      <label for="name">{{translate('Name')}}</label>
                      <input type="text" placeholder="{{translate('Name')}}" value="{{ $city->getTranslation('name', $lang) }}" name="name" class="form-control" required>
                  </div>

                  <div class="form-group">
                      <label for="country">{{translate('Country')}}</label>
                      <select id="country_id" class="select2 form-control aiz-selectpicker countries" name="country_id" data-toggle="select2" data-placeholder="Choose ..." data-live-search="true">
                          @foreach ($countries as $country)
                              <option value="{{ $country->id }}" @if($country->id == $city->country_id) selected @endif>{{ $country->name }}</option>
                          @endforeach
                      </select>
                  </div>

                  <div class="form-group">
                      <label for="country">{{translate('Governorate')}}</label>
                      <select id="governorate" class=" form-control " name="governorate_id"  data-placeholder="Choose ..." data-live-search="true">
                          @foreach ($governorates as $governorate)
                              <option value="{{ $governorate->id }}" @if($governorate->id == $city->governorate_id) selected @endif>{{ $governorate->name }}</option>
                          @endforeach
                      </select>
                  </div>

                  <div class="form-group mb-3">
                      <label for="name">{{translate('Cost')}}</label>
                      <input type="number" min="0" step="0.01" placeholder="{{translate('Cost')}}" name="cost" class="form-control" value="{{ $city->cost }}" required>
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
                                          $("#governorate").html("");

        }else{

 $.ajax({
            type: "get",
            url: "{{ url("admin/cities/governorates/") }}/"+id,
            success: function (response) {

                $("#governorate").html("");

                response.forEach(item => {
               $("#governorate").append("<option value="+item.id+" >"+item.name+"</option>");

                });
            }
        });
        }

        });


    </script>
@endsection
