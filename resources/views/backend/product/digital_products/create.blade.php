@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <h5 class="mb-0 h5">{{ translate('Add New Digital Product') }}</h5>
    </div>
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <form class="form form-horizontal mar-top" action="{{ route('digitalproducts.store') }}" method="POST"
                enctype="multipart/form-data" id="choice_form">
                @csrf
                <input type="hidden" name="added_by" value="admin">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">{{ translate('General') }}</h5>
                    </div>

                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-2 col-from-label">{{ translate('Product Name') }}</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="name"
                                    placeholder="{{ translate('Product Name') }}" required>
                            </div>
                        </div>
                        <div class="form-group row" id="category">
                            <label class="col-md-2 col-from-label">{{ translate('Category') }} <span
                                    class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <select class="form-control aiz-selectpicker" name="category_id" id="category_id"
                                    data-live-search="true" required>
                                    <option value="">{{ translate('choose category') }}</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->getTranslation('name') }}
                                        </option>
                                        @foreach ($category->childrenCategories as $childCategory)
                                            @include('categories.child_category', [
                                                'child_category' => $childCategory,
                                            ])
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-2 col-from-label">{{ translate('Product File') }} <span
                                    class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <div class="input-group" data-toggle="aizuploader" data-type="all" data-multiple="false">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">
                                            {{ translate('Browse') }}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                    <input type="hidden" name="file" id="product_file" class="selected-files">
                                </div>
                                <div class="file-preview box sm">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-from-label">{{ translate('Tags') }}</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control aiz-tag-input" name="tags[]"
                                    placeholder="{{ translate('Type to add a tag') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">{{ translate('Images') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label"
                                for="signinSrEmail">{{ translate('Main Images') }}</label>
                            <div class="col-md-8">
                                <div class="input-group" data-toggle="aizuploader" data-type="image"
                                    data-multiple="true">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">
                                            {{ translate('Browse') }}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                    <input type="hidden" name="photos" class="selected-files">
                                </div>
                                <div class="file-preview box sm">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label" for="signinSrEmail">{{ translate('Thumbnail Image') }}
                                <small>(290x300)</small></label>
                            <div class="col-md-8">
                                <div class="input-group" data-toggle="aizuploader" data-type="image"
                                    data-multiple="false">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">
                                            {{ translate('Browse') }}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                    <input type="hidden" name="thumbnail_img" class="selected-files">
                                </div>
                                <div class="file-preview box sm">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" id="choice_arr_value">
                    <div class="card-header">
                        <h5 class="mb-0 h6">{{ translate('Product Variation') }}</h5>
                    </div>
                    <div class="card-body">

                        <div class="form-group row">
                            <div class="col-md-3">
                                <input type="text" class="form-control" value="{{ translate('Attributes') }}" disabled>
                            </div>
                            <div class="col-md-8">
                                <select name="choice_attributes[]" id="choice_attributes"
                                    class="form-control aiz-selectpicker attr_choice" data-selected-text-format="count"
                                    data-live-search="true" multiple
                                    data-placeholder="{{ translate('Choose Attributes') }}">

                                </select>
                            </div>
                        </div>
                        <div>
                            <p>{{ translate('choose attribute belong to category') }}
                            </p>
                            <br>
                        </div>

                        <div class="customer_choice_options" id="customer_choice_options">

                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">{{ translate('Meta Tags') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-2 col-from-label">{{ translate('Meta Title') }}</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="meta_title"
                                    placeholder="{{ translate('Meta Title') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-from-label">{{ translate('Description') }}</label>
                            <div class="col-lg-8">
                                <textarea name="meta_description" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-2 col-form-label"
                                for="signinSrEmail">{{ translate('Meta Image') }}</label>
                            <div class="col-md-8">
                                <div class="input-group" data-toggle="aizuploader" data-type="image"
                                    data-multiple="false">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">
                                            {{ translate('Browse') }}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                    <input type="hidden" name="meta_img" class="selected-files">
                                </div>
                                <div class="file-preview box sm">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">{{ translate('Product price + stock') }}</h5>


                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-md-3 col-from-label">{{ translate('Unit price') }} <span
                                    class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <input id="unit_price" type="number" lang="en" min="0" value="0" step="0.01"
                                    placeholder="{{ translate('Unit price') }}" name="unit_price" class="form-control"
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-from-label">{{ translate('Purchase price') }} <span
                                    class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <input id="purchase_price" type="number" lang="en" min="0" value="0" step="0.01"
                                    placeholder="{{ translate('Purchase price') }}" name="purchase_price"
                                    class="form-control" required>
                            </div>
                        </div>
                        {{-- <div class="form-group row">
                            <label class="col-md-3 col-from-label">{{translate('Tax')}} <span class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <input type="number" lang="en" min="0" value="0" step="0.01" placeholder="{{ translate('Tax') }}" name="tax" class="form-control" required>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control aiz-selectpicker" name="tax_type">
                                    <option value="amount">{{translate('Flat')}}</option>
                                    <option value="percent">{{translate('Percent')}}</option>
                                </select>
                            </div>
                        </div> --}}
                        <div class="form-group row">
                            <label class="col-md-3 col-from-label">{{ translate('Discount') }} <span
                                    class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <input type="number" lang="en" min="0" value="0" step="0.01"
                                    placeholder="{{ translate('Discount') }}" name="discount" class="form-control"
                                    required>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control aiz-selectpicker" name="discount_type">
                                    <option value="amount">{{ translate('Flat') }}</option>
                                    <option value="percent">{{ translate('Percent') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" id="quantity">
                            <label class="col-md-3 col-from-label">{{ translate('Quantity') }} <span
                                    class="text-danger">*</span></label>
                            <div class="col-md-6">
                                <input type="number" lang="en" min="1" value="1" step="1"
                                    placeholder="{{ translate('Quantity') }}" name="current_stock"
                                    class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group row">



                            <label class="col-lg-3 col-from-label">{{ translate('Choose Tax') }}</label>

                            {{-- <div class="form-group col-md-6">
                                <input type="number" lang="en" min="0" value="0" step="0.01"
                                        placeholder="{{ translate('Tax') }}" name="tax[]" class="form-control" required>
                                </div> --}}
                            <div class="form-group col-md-3">

                                <input id="tax_id" value="1" type="hidden" name="tax_id[]">
                                <input id="tax_type" value="percent" type="hidden" name="tax_type[]">

                                <select class="form-control tax_select" name="tax[]">
                                    @foreach (\App\Tax::where('tax_status', 1)->get() as $tax)
                                        <option value="{{ $tax->tax }}" data-tax_id="{{ $tax->id }}"
                                            data-tax_type="{{ $tax->tax_type }}">{{ $tax->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-from-label">{{ translate('Choose Tax Type') }}</label>

                            <div class="form-group col-md-3">

                                <select class="form-control " name="include_tax">
                                    <option value="1">{{ translate('Include Tax') }}</option>
                                    <option value="0">{{ translate('Not Include Tax') }}</option>
                                </select>

                            </div>
                        </div>
                        <br>
                        <div class="sku_combination" id="sku_combination">

                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">{{ translate('Product Information') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-2 col-from-label">{{ translate('Description') }}</label>
                            <div class="col-lg-9">
                                <textarea class="aiz-text-editor" name="description"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3 text-right">
                    <button type="button" id="btn_submit" name="button"
                        class="btn btn-primary">{{ translate('Save Product') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#sku_combination").on("keyup", "#attr_1", function() {
                $("#unit_price").val($(this).val())
            });
            $("#btn_submit").click(function(e) {
                e.preventDefault();
                if ($("#product_file").val() != "" && $("#product_file").val() != null) {
                    $("#choice_form").submit();
                } else {
                    AIZ.plugins.notify('danger',
                        '{{ translate('You Must Put Files To Digital Product') }}');
                }
            });


            function update_sku() {
                console.log($('#choice_form').serialize());
                $.ajax({
                    type: "POST",
                    url: '{{ route('products.sku_combination') }}',
                    data: $('#choice_form').serialize(),
                    success: function(data) {
                        console.log({
                            data
                        });
                        $('#sku_combination').html(data);
                        AIZ.plugins.fooTable();

                        if (data.length > 1) {
                            $('#quantity').hide();
                        } else {
                            $('#quantity').show();
                        }

                    }
                });
            }
            $("#category_id").change(function(e) {
                get_attrs($(this).val())
                $('#customer_choice_options').html("")
                update_sku();

            });

            $('#choice_attributes').on('change', function() {
                $('#customer_choice_options').html(null);
                $.each($("#choice_attributes option:selected"), function() {
                    add_more_customer_choice_option($(this).val(), $(this).text());
                });
                update_sku();
            });



            function get_attrs(category_id) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/') }}" + '/admin/products/get_from_category_attrs/' + category_id,
                    success: function(data) {
                        if (data == "") {
                            $("#choice_arr_value").addClass("d-none")
                        } else {
                            $("#choice_attributes").html(data);
                            $("#choice_attributes").selectpicker("refresh")
                            $("#choice_arr_value").removeClass("d-none")
                        }
                    }
                });
            }
            $(".tax_select").on("change", function() {
                var selected = $(this).find('option:selected');
                var tax_id = selected.data('tax_id')
                var tax_type = selected.data('tax_type')

                $("#tax_id").val(tax_id);
                $("#tax_type").val(tax_type);

            })



        })

        function update_sku() {
            console.log($('#choice_form').serialize());
            $.ajax({
                type: "POST",
                url: '{{ route('products.sku_combination') }}',
                data: $('#choice_form').serialize(),
                success: function(data) {
                    console.log({
                        data
                    });
                    $('#sku_combination').html(data);
                    AIZ.plugins.fooTable();

                    if (data.length > 1) {
                        $('#quantity').hide();
                    } else {
                        $('#quantity').show();
                    }

                }
            });
        }

        function add_more_customer_choice_option(i, name) {
            $.ajax({
                type: "GET",
                url: "{{ url('/') }}" + '/admin/products/set_optionce/' + i,
                success: function(data) {

                    $('#customer_choice_options').append(
                        '<div class="form-group row"><div class="col-md-3"><input type="hidden" name="choice_no[]" value="' +
                        i + '"><input type="text" id="option_attr_' + i +
                        '" class="form-control" name="choice[]" value="' +
                        name +
                        '" placeholder="{{ translate('Choice Title') }}" readonly></div><div class="col-md-8"><input type="text" value="' +
                        data.text +
                        '" class="form-control aiz-tag-input" name="choice_options_' +
                        i +
                        '[]" placeholder="{{ translate('Enter choice values') }}" data-on-change="update_sku" ></div></div>'
                    );
                    AIZ.plugins.tagify();
                    update_sku();


                }
            });



        }
    </script>
@endsection
