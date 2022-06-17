@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <h5 class="mb-0 h6">{{ translate('Attribute Value Information') }}</h5>
    </div>

    <div class="col-lg-8 mx-auto">
        <div class="card">
            <div class="card-body p-0">

                <form class="p-4" action="{{ route('attribute_values.update', $attributeValue->id) }}"
                    method="POST">
                    <input name="_method" type="hidden" value="PATCH">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="name">{{ translate('Attribute Value') }}</label>
                        <select class="form-control aiz-selectpicker" required name="attribute_id" id="attribute_id"
                            data-live-search="true">
                            <option value="">{{ 'Select Attribute' }}</option>
                            @foreach (\App\Attribute::all() as $attribute)
                                <option {{ $attributeValue->attribute_id == $attribute->id ? 'selected' : null }}
                                    value="{{ $attribute->id }}">{{ $attribute->getTranslation('name') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="name">{{ translate('Value') }}</label>
                        <input type="text" value="{{ $attributeValue->value }}" placeholder="{{ translate('Value') }}"
                            id="name" name="value" class="form-control" required>
                    </div>
                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-primary">{{ translate('Save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
