@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="align-items-center">
            <h1 class="h3">{{ translate('All Attributes Values') }}</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{ translate('Attributes Values') }}</h5>
                </div>
                <div class="card-body">
                    <table class="table aiz-table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ translate('Attribute Name') }}</th>
                                <th>{{ translate('Value') }}</th>
                                <th class="text-right">{{ translate('Options') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($attributes as $key => $attributeValue)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $attributeValue->attribute->getTranslation('name') }}</td>
                                    <td>{{ $attributeValue->value }}</td>
                                    <td class="text-right">
                                        <a class="btn btn-soft-primary btn-icon btn-circle btn-sm"
                                            href="{{ route('attribute_values.edit', ['id' => $attributeValue->id]) }}"
                                            title="{{ translate('Edit') }}">
                                            <i class="las la-edit"></i>
                                        </a>
                                        <a href="#" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"
                                            data-href="{{ route('attribute_values.destroy', $attributeValue->id) }}"
                                            title="{{ translate('Delete') }}">
                                            <i class="las la-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0 h6">{{ translate('Add New Attribute Value') }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('attribute_values.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name">{{ translate('Attribute') }}</label>
                            <select class="form-control aiz-selectpicker" required name="attribute_id" id="attribute_id"
                                data-live-search="true">
                                <option value="">{{ 'Select Attribute' }}</option>
                                @foreach (\App\Attribute::all() as $attribute)
                                    <option value="{{ $attribute->id }}">{{ $attribute->getTranslation('name') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="name">{{ translate('Value') }}</label>
                            <input type="text" placeholder="{{ translate('Value') }}" id="name" name="value"
                                class="form-control" required>
                        </div>
                        <div class="form-group mb-3 text-right">
                            <button type="submit" class="btn btn-primary">{{ translate('Save') }}</button>
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
