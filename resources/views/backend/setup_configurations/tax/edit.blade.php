@extends('backend.layouts.app')

@section('content')

<div class="aiz-titlebar text-left mt-2 mb-3">
    <h5 class="mb-0 h6">{{translate('Tax Information')}}</h5>
</div>

<div class="row">
    <div class="col-lg-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('update Tax Info')}}</h5>
            </div>
            <div class="card-body p-0">
                <form class="p-4" action="{{ route('tax.update', $tax->id) }}" method="POST">
                    <input name="_method" type="hidden" value="PATCH">
                    @csrf
                    <div class="form-group row">
                        <div class="col-lg-3">
                            <label class="control-label">{{ translate('Name') }}</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" class="form-control" name="name" placeholder="{{ translate('Name') }}" value="{{ $tax->name }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                            <div class=" row">
                                <label class="col-sm-3 control-label" for="name">
                                    {{translate('Tax Rate')}}
                                </label>
                                <div class="col-sm-9">
                                    <input type="number" value="{{ $tax->tax }}" placeholder="{{translate('Tax Rate')}}" id="tax" name="tax" class="form-control" required>
                                </div>
                            </div>
                        </div>

                         <div class="form-group">
                            <div class=" row">
                                <label class="col-sm-3 control-label" for="name">
                                    {{translate('Tax Type')}}
                                </label>
                                <div class="col-sm-9">
                                    <select class="form-control "  name="tax_type">
                                    <option value="percent" {{$tax->tax_type == "percent"?"selected":""}} >{{ translate("Percent") . " %" }}</option>
                                    <option value="amount" {{$tax->tax_type == "amount"?"selected":""}} >{{ translate("Fixed")}}</option>
                                </select>
                                </div>

                            </div>
                        </div>

                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
