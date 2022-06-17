@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <h5 class="mb-0 h5">{{ translate('Edit Digital Product') }}</h5>
    </div>
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <form class="form form-horizontal mar-top" action="{{ route('digitalproducts.update', $product->id) }}"
                method="POST" enctype="multipart/form-data" id="choice_form">
                <input name="_method" type="hidden" value="POST">
                <input type="hidden" name="id" value="{{ $product->id }}">
                <input type="hidden" name="lang" value="{{ $lang }}">
                @csrf
                <div class="card">
                    <div class="card-body p-0">
                        <ul class="nav nav-tabs nav-fill border-light">
                            @foreach (\App\Language::all() as $key => $language)
                                <li class="nav-item">
                                    <a class="nav-link text-reset @if ($language->code == $lang) active @else bg-soft-dark border-light border-left-0 @endif py-3"
                                        href="{{ route('digitalproducts.edit', ['id' => $product->id, 'lang' => $language->code]) }}">
                                        <img src="{{ static_asset('assets/img/flags/' . $language->code . '.png') }}"
                                            height="11" class="mr-1">
                                        <span>{{ $language->name }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">{{ translate('General') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-2 col-from-label">{{ translate('Product Name') }}</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control" name="name"
                                    placeholder="{{ translate('Product Name') }}"
                                    value="{{ $product->getTranslation('name', $lang) }}" required>
                            </div>
                        </div>
                        <div class="form-group row" id="category">
                            <label class="col-lg-2 col-from-label">{{ translate('Category') }}</label>
                            <div class="col-lg-8">
                                <select class="form-control aiz-selectpicker" name="category_id" id="category_id"
                                    data-selected="{{ $product->category_id }}" required>
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
                            <label class="col-lg-2 col-from-label">{{ translate('Product File') }}</label>
                            <div class="col-lg-8">
                                <div class="input-group" data-toggle="aizuploader" data-type="all" data-multiple="false">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary font-weight-medium">
                                            {{ translate('Browse') }}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                    <input type="hidden" name="file" class="selected-files"
                                        value="{{ $product->file_name }}">
                                </div>
                                <div class="file-preview box sm">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-from-label">{{ translate('Tags') }}</label>
                            <div class="col-lg-8">
                                <input type="text" class="form-control aiz-tag-input" name="tags[]" id="tags"
                                    value="{{ $product->tags }}" placeholder="{{ translate('Type to add a tag') }}">
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
                                    <input type="hidden" name="photos" value="{{ $product->photos }}"
                                        class="selected-files" required>
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
                                    <input type="hidden" name="thumbnail_img" value="{{ $product->thumbnail_img }}"
                                        class="selected-files" required>
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
                            <div class="col-lg-3">
                                <input type="text" class="form-control" value="{{ translate('Attributes') }}" disabled>
                            </div>
                            <div class="col-lg-8">
                                <select name="choice_attributes[]" id="choice_attributes" data-selected-text-format="count"
                                    data-live-search="true" class="form-control aiz-selectpicker attr_choice" multiple
                                    data-placeholder="{{ translate('Choose Attributes') }}">

                                </select>
                            </div>
                        </div>

                        <div class="">
                            <p>{{ translate('Choose the attributes of this product and then input values of each attribute') }}
                            </p>
                            <br>
                        </div>

                        <div class="customer_choice_options" id="customer_choice_options">
                            @foreach (json_decode($product->choice_options) as $key => $choice_option)
                                <div class="form-group row">
                                    <div class="col-lg-3">
                                        <input type="hidden" name="choice_no[]"
                                            value="{{ $choice_option->attribute_id }}">
                                        <input type="text" class="form-control" name="choice[]"
                                            value="{{ \App\Attribute::find($choice_option->attribute_id)->getTranslation('name') }}"
                                            placeholder="{{ translate('Choice Title') }}" disabled>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control aiz-tag-input"
                                            name="choice_options_{{ $choice_option->attribute_id }}[]"
                                            placeholder="{{ translate('Enter choice values') }}"
                                            value="{{ implode(',', $choice_option->values) }}"
                                            data-on-change="update_sku">
                                    </div>
                                </div>
                            @endforeach
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
                                    value="{{ $product->meta_title }}" placeholder="{{ translate('Meta Title') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-from-label">{{ translate('Description') }}</label>
                            <div class="col-lg-8">
                                <textarea name="meta_description" rows="8" class="form-control">{{ $product->meta_description }}</textarea>
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
                                    <input type="hidden" name="meta_img" value="{{ $product->meta_img }}"
                                        class="selected-files">
                                </div>
                                <div class="file-preview box sm">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-form-label">{{ translate('Slug') }}</label>
                            <div class="col-lg-8">
                                <input type="text" placeholder="{{ translate('Slug') }}" id="slug" name="slug"
                                    value="{{ $product->slug }}" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0 h6">{{ translate('Price') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-2 col-from-label">{{ translate('Unit price') }}</label>
                            <div class="col-lg-8">
                                <input type="text" placeholder="{{ translate('Unit price') }}" name="unit_price"
                                    class="form-control" value="{{ $product->unit_price }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-2 col-from-label">{{ translate('Purchase price') }}</label>
                            <div class="col-lg-8">
                                <input type="number" lang="en" min="0" step="0.01"
                                    placeholder="{{ translate('Purchase price') }}" name="purchase_price"
                                    class="form-control" value="{{ $product->purchase_price }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-2 col-from-label">{{ translate('Discount') }}</label>
                            <div class="col-lg-6">
                                <input type="number" lang="en" min="0" step="0.01"
                                    placeholder="{{ translate('Discount') }}" name="discount" class="form-control"
                                    value="{{ $product->discount }}" required>
                            </div>
                            <div class="col-lg-2">
                                <select class="form-control aiz-selectpicker" name="discount_type" required>
                                    <option value="amount" <?php if ($product->discount_type == 'amount') {
                                        echo 'selected';
                                    } ?>>{{ translate('Flat') }}</option>
                                    <option value="percent" <?php if ($product->discount_type == 'percent') {
                                        echo 'selected';
                                    } ?>>{{ translate('Percent') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">


                            {{-- {{dd($product)}} --}}

                            <label class="col-md-2 col-from-label">{{ translate('Choose Tax') }}</label>

                            {{-- <div class="form-group col-md-6">
                                <input type="number" lang="en" min="0" value="0" step="0.01"
                                        placeholder="{{ translate('Tax') }}" name="tax[]" class="form-control" required>
                                </div> --}}
                            <div class="form-group col-md-3">

                                <input id="tax_id" type="hidden" value="{{ $product->taxe->tax_id }}" name="tax_id[]">
                                <input id="tax_type" type="hidden" value="{{ $product->taxe->tax_type }}"
                                    name="tax_type[]">

                                <select class="form-control tax_select" name="tax[]">
                                    @foreach (\App\Tax::where('tax_status', 1)->get() as $taxs)
                                        <option value="{{ $taxs->tax }}"
                                            {{ $product->taxe->tax_id == $taxs->id ? 'selected' : '' }}
                                            data-tax_id="{{ $taxs->id }}" data-tax_type="{{ $taxs->tax_type }}">
                                            {{ $taxs->name }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-lg-3 col-from-label">{{ translate('Choose Tax Type') }}</label>

                            <div class="form-group col-md-3">

                                <select class="form-control " name="include_tax">
                                    <option {{ $product->include_tax == 1 ? 'selected' : '' }} value="1">
                                        {{ translate('Include Tax') }}</option>
                                    <option {{ $product->include_tax == 0 ? 'selected' : '' }} value="0">
                                        {{ translate('Not Include Tax') }}</option>
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
                        <h5 class="mb-0 h6">{{ translate('Description') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="col-lg-2 col-from-label">{{ translate('Description') }}</label>
                            <div class="col-lg-9">
                                <textarea class="aiz-text-editor" name="description">{{ $product->getTranslation('description', $lang) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3 text-right">
                    <button type="submit" name="button"
                        class="btn btn-primary">{{ translate('Update Product') }}</button>
                </div>
        </div>
        </form>
    </div>
@endsection




@section('script')
    <script type="text/javascript">
        $(document).ready(function() {

            $("#btn_submit").click(function(e) {
                e.preventDefault();
                if ($("#product_file").val() != "" && $("#product_file").val() != null) {
                    $("#choice_form").submit();
                } else {
                    AIZ.plugins.notify('danger',
                        '{{ translate('You Must Put Files To Digital Product') }}');
                }
            });

            update_sku();
            get_attrs("{{ $product->category_id }}")

            $("#sku_combination").on("keyup", "#attr_1", function() {
                $("#unit_price").val($(this).val())
            });
            $('.remove-files').on('click', function() {
                $(this).parents(".col-md-4").remove();
            });

            $("#category_id").change(function(e) {
                get_attrs($(this).val())
                $('#customer_choice_options').html("")
                update_sku();

            });

            // $('#choice_attributes').on('change', function() {
            //     $('#customer_choice_options').html(null);
            //     $.each($("#choice_attributes option:selected"), function() {
            //         add_more_customer_choice_option($(this).val(), $(this).text());
            //     });
            //     update_sku();
            // });


            function new_update_sku() {
                console.log($('#choice_form').serialize());
                $.ajax({
                    type: "POST",
                    url: '{{ route('products.sku_combination') }}',
                    data: $('#choice_form').serialize(),
                    success: function(data) {

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

            function get_attrs(category_id) {

                let data = {
                    _token: '{{ csrf_token() }}',
                    category_id,
                    product_id: '{{ $product->id }}'
                }
                $.ajax({
                    type: "POST",
                    data,
                    url: '{{ route('products.get_from_category_attrs_update') }}',
                    success: function(data) {
                        if (data == "") {
                            $("#choice_arr_value").addClass("d-none")
                        } else {
                            $("#choice_attributes").html(data);
                            $("#choice_attributes").selectpicker("refresh");
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
            $.ajax({
                type: "POST",
                url: '{{ route('products.sku_combination_edit') }}',
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




        $('#choice_attributes').on('change', function() {
            $.each($("#choice_attributes option:selected"), function(j, attribute) {
                flag = false;
                $('input[name="choice_no[]"]').each(function(i, choice_no) {
                    if ($(attribute).val() == $(choice_no).val()) {
                        flag = true;
                    }
                });
                if (!flag) {
                    add_more_customer_choice_option($(attribute).val(), $(attribute).text());
                }
            });

            var str = @php echo $product->attributes @endphp;

            $.each(str, function(index, value) {
                flag = false;
                $.each($("#choice_attributes option:selected"), function(j, attribute) {
                    if (value == $(attribute).val()) {
                        flag = true;
                    }
                });
                if (!flag) {
                    $('input[name="choice_no[]"][value="' + value + '"]').parent().parent().remove();
                }
            });

            update_sku();
        });
        $(document).ready(function() {



            $(".tax_select").on("change", function() {
                var selected = $(this).find('option:selected');
                var tax_id = selected.data('tax_id')
                var tax_type = selected.data('tax_type')

                $("#tax_id").val(tax_id);
                $("#tax_type").val(tax_type);

            })
        })
    </script>
@endsection
