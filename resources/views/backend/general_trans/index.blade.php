@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">{{translate('General Translation')}}</h5>
</div>

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-body p-0">
                <ul class="nav nav-tabs nav-fill border-light">
                    @foreach (\App\Language::all() as $key => $language)
                    <li class="nav-item">
                        <a class="nav-link text-reset @if ($language->code == $lang) active @else bg-soft-dark border-light border-left-0 @endif py-3"
                             href="{{ route('genenral_trans.index',
                              ['table_name'=>request("table_name"),
                              'row_id'=>request("row_id"),
                               'lang'=> $language->code] ) }}">
                            <img src="{{ static_asset('assets/img/flags/'.$language->code.'.png') }}" height="11" class="mr-1">
                            <span>{{$language->name}}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
                <form class="p-4" action="{{ route('genenral_trans.update') }}" method="POST" enctype="multipart/form-data">
                    <input name="_method" type="hidden" value="PATCH">
    	            <input type="hidden" name="lang" value="{{ $lang }}">
                	@csrf
                     @foreach ($general_trans as $item)

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">{{translate('name')}} <i class="las la-language text-danger" title="{{translate('Translatable')}}"></i></label>
                                <div class="col-md-9">
                                    <input type="hidden" name="trans_ids[]" value="{{$item->id}}" />
                                    <input type="text" name="trans[]" value="{{$item->trans}}" class="form-control"  required>
                                </div>
                            </div>
                    @endforeach
                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">{{translate('Save')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection
