@extends('frontend.layouts.app')

@section('content')

    <section class="pt-4 mb-4">
        <div class="container text-center">
            <div class="row">
                <div class="col-lg-6 text-center text-lg-left">
                    <h1 class="fw-600 h4">{{ translate('Compare') }}</h1>
                </div>
                <div class="col-lg-6">
                    <ul class="breadcrumb bg-transparent p-0 justify-content-center justify-content-lg-end">
                        <li class="breadcrumb-item opacity-50">
                            <a class="text-reset" href="{{ route('home') }}">{{ translate('Home') }}</a>
                        </li>
                        <li class="text-dark fw-600 breadcrumb-item">
                            <a class="text-reset"
                                href="{{ route('compare.reset') }}">"{{ translate('Compare') }}"</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="mb-4">
        <div class="container text-left">
            <div class="bg-white shadow-sm rounded">
                <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
                    <div class="fs-15 fw-600">{{ translate('Comparison') }}</div>
                    <a href="{{ route('compare.reset') }}" style="text-decoration: none;"
                        class="btn btn-soft-primary btn-sm fw-600">{{ translate('Reset Compare List') }}</a>
                </div>
                @if (Session::has('compare'))
                    @if (count(Session::get('compare')) > 0)
                        @php

                            $cat_id = \App\Product::find(Session::get('compare')->first())->category_id;
                            $parent_cat = \App\MyClasses\Cat::get_main_parent($cat_id);

                        @endphp
                        <div class="p-3">
                            <table class="table table-responsive table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col" style="width:16%" class="font-weight-bold">
                                            {{ translate('Name') }}
                                        </th>
                                        @foreach (Session::get('compare') as $key => $item)
                                            <th scope="col" style="width:28%" class="font-weight-bold">
                                                <a class="text-reset fs-15"
                                                    href="{{ route('product', \App\Product::find($item)->slug) }}">{{ \App\Product::find($item)->getTranslation('name') }}</a>
                                            </th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">{{ translate('Image') }}</th>
                                        @foreach (Session::get('compare') as $key => $item)
                                            <td>
                                                <img loading="lazy"
                                                    src="{{ uploaded_asset(\App\Product::find($item)->thumbnail_img) }}"
                                                    style="width: 30%;height: 30%;"
                                                    alt="{{ translate('Product Image') }}" class="img-fluid py-4">
                                            </td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ translate('Price') }}</th>
                                        @foreach (Session::get('compare') as $key => $item)
                                            <td>{{ single_price(\App\Product::find($item)->unit_price) }}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <th scope="row">{{ translate('Brand') }}</th>
                                        @foreach (Session::get('compare') as $key => $item)
                                            <td>
                                                @if (\App\Product::find($item)->brand != null)
                                                    {{ \App\Product::find($item)->brand->getTranslation('name') }}
                                                @endif
                                            </td>
                                        @endforeach
                                    </tr>
                                    @foreach (\App\MyClasses\Attributes::get_attrs_and_attrs_child($parent_cat->id) as $attr)
                                        <tr>

                                            <th scope="row">{{ $attr->getTranslation('name') }}</th>
                                            @foreach (Session::get('compare') as $key => $product_id)
                                                <td>
                                                    @php
                                                        $values = \App\MyClasses\Attributes::get_values_product($attr->id, $product_id);
                                                    @endphp
                                                    @if (count($values) > 0)
                                                        @foreach ($values as $key => $item)
                                                            @if (count($values) - 1 == $key)
                                                                {{ $item }}
                                                            @else
                                                                {{ $item . ' - ' }}
                                                            @endif
                                                        @endforeach
                                                    @endif

                                                </td>
                                            @endforeach

                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th scope="row"></th>
                                        @foreach (Session::get('compare') as $key => $item)
                                            <td class="text-center py-4">
                                                <button type="button" class="btn btn-primary fw-600"
                                                    onclick="showAddToCartModal({{ $item }})">
                                                    {{ translate('Add to cart') }}
                                                </button>
                                            </td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @endif
                @else
                    <div class="text-center p-4">
                        <p class="fs-17">{{ translate('Your comparison list is empty') }}</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

@endsection
