@extends('backend.layouts.app')
@section('content')

    <div class="row">
        <div class="col-xl-10 mx-auto">
            <h6 class="fw-600">{{ translate('Back To School Page Settings') }}</h6>

            {{-- Home Slider --}}
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">{{ translate('Back To School Slider') }}</h6>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        {{ translate('We have limited banner height to maintain UI. We had to crop from both left & right side in view for different devices to make it responsive. Before designing banner keep these points in mind.') }}
                    </div>
                    <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>{{ translate('Photos & Links') }}</label>
                            <div class="home-slider-target">
                                <input type="hidden" name="types[]" value="back_to_school_slider_images">
                                <input type="hidden" name="types[]" value="back_to_school_slider_links">
                                @if (get_setting('back_to_school_slider_images') != null)
                                    @foreach (json_decode(get_setting('back_to_school_slider_images'), true) as $key => $value)
                                        <div class="row gutters-5">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                        <div class="input-group-prepend">
                                                            <div
                                                                class="input-group-text bg-soft-secondary font-weight-medium">
                                                                {{ translate('Browse') }}</div>
                                                        </div>
                                                        <div class="form-control file-amount">
                                                            {{ translate('Choose File') }}</div>
                                                        <input type="hidden" name="types[]"
                                                            value="back_to_school_slider_images">
                                                        <input type="hidden" name="back_to_school_slider_images[]"
                                                            class="selected-files"
                                                            value="{{ json_decode(get_setting('back_to_school_slider_images'), true)[$key] }}">
                                                    </div>
                                                    <div class="file-preview box sm">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <input type="hidden" name="types[]" value="back_to_school_slider_links">
                                                    <input type="text" class="form-control" placeholder="http://"
                                                        name="back_to_school_slider_links[]"
                                                        value="{{ json_decode(get_setting('back_to_school_slider_links'), true)[$key] }}">
                                                </div>
                                            </div>
                                            <div class="col-md-auto">
                                                <div class="form-group">
                                                    <button type="button"
                                                        class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger"
                                                        data-toggle="remove-parent" data-parent=".row">
                                                        <i class="las la-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <button type="button" class="btn btn-soft-secondary btn-sm" data-toggle="add-more" data-content='
                                            <div class="row gutters-5">
                                                <div class="col-md-5">
                                                <div class="form-group">
                                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
                                                </div>
                                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                                <input type="hidden" name="types[]" value="back_to_school_slider_images">
                                                <input type="hidden" name="back_to_school_slider_images[]" class="selected-files">
                                                </div>
                                                <div class="file-preview box sm">
                                                </div>
                                                </div>
                                                </div>
                                                <div class="col-md">
                                                <div class="form-group">
                                                <input type="hidden" name="types[]" value="back_to_school_slider_links">
                                                <input type="text" class="form-control" placeholder="http://" name="back_to_school_slider_links[]">
                                                </div>
                                                </div>
                                                <div class="col-md-auto">
                                                <div class="form-group">
                                                <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
                                                <i class="las la-times"></i>
                                                </button>
                                                </div>
                                                </div>
                                            </div>' data-target=".home-slider-target">
                                {{ translate('Add New') }}
                            </button>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Home Banner 1 --}}
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">{{ translate('Back To School Banner 1 (Max 3)') }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>{{ translate('Banner & Links') }}</label>
                            <div class="home-banner1-target">
                                <input type="hidden" name="types[]" value="back_to_school_banner1_images">
                                <input type="hidden" name="types[]" value="back_to_school_banner1_links">
                                @if (get_setting('back_to_school_banner1_images') != null)
                                    @foreach (json_decode(get_setting('back_to_school_banner1_images'), true) as $key => $value)
                                        <div class="row gutters-5">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                        <div class="input-group-prepend">
                                                            <div
                                                                class="input-group-text bg-soft-secondary font-weight-medium">
                                                                {{ translate('Browse') }}</div>
                                                        </div>
                                                        <div class="form-control file-amount">
                                                            {{ translate('Choose File') }}</div>
                                                        <input type="hidden" name="types[]"
                                                            value="back_to_school_banner1_images">
                                                        <input type="hidden" name="back_to_school_banner1_images[]"
                                                            class="selected-files"
                                                            value="{{ json_decode(get_setting('back_to_school_banner1_images'), true)[$key] }}">
                                                    </div>
                                                    <div class="file-preview box sm">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <input type="hidden" name="types[]"
                                                        value="back_to_school_banner1_links">
                                                    <input type="text" class="form-control" placeholder="http://"
                                                        name="back_to_school_banner1_links[]"
                                                        value="{{ json_decode(get_setting('back_to_school_banner1_links'), true)[$key] }}">
                                                </div>
                                            </div>
                                            <div class="col-md-auto">
                                                <div class="form-group">
                                                    <button type="button"
                                                        class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger"
                                                        data-toggle="remove-parent" data-parent=".row">
                                                        <i class="las la-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <button type="button" class="btn btn-soft-secondary btn-sm" data-toggle="add-more" data-content='
                                            <div class="row gutters-5">
                                                <div class="col-md-5">
                                                <div class="form-group">
                                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
                                                </div>
                                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                                <input type="hidden" name="types[]" value="back_to_school_banner1_images">
                                                <input type="hidden" name="back_to_school_banner1_images[]" class="selected-files">
                                                </div>
                                                <div class="file-preview box sm">
                                                </div>
                                                </div>
                                                </div>
                                                <div class="col-md">
                                                <div class="form-group">
                                                <input type="hidden" name="types[]" value="back_to_school_banner1_links">
                                                <input type="text" class="form-control" placeholder="http://" name="back_to_school_banner1_links[]">
                                                </div>
                                                </div>
                                                <div class="col-md-auto">
                                                <div class="form-group">
                                                <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
                                                <i class="las la-times"></i>
                                                </button>
                                                </div>
                                                </div>
                                            </div>' data-target=".home-banner1-target">
                                {{ translate('Add New') }}
                            </button>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Home Banner 2 --}}
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">{{ translate('Back To School Banner 2 (Max 3)') }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>{{ translate('Banner & Links') }}</label>
                            <div class="home-banner2-target">
                                <input type="hidden" name="types[]" value="back_to_school_banner2_images">
                                <input type="hidden" name="types[]" value="back_to_school_banner2_links">
                                @if (get_setting('back_to_school_banner2_images') != null)
                                    @foreach (json_decode(get_setting('back_to_school_banner2_images'), true) as $key => $value)
                                        <div class="row gutters-5">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                        <div class="input-group-prepend">
                                                            <div
                                                                class="input-group-text bg-soft-secondary font-weight-medium">
                                                                {{ translate('Browse') }}</div>
                                                        </div>
                                                        <div class="form-control file-amount">
                                                            {{ translate('Choose File') }}</div>
                                                        <input type="hidden" name="types[]"
                                                            value="back_to_school_banner2_images">
                                                        <input type="hidden" name="back_to_school_banner2_images[]"
                                                            class="selected-files"
                                                            value="{{ json_decode(get_setting('back_to_school_banner2_images'), true)[$key] }}">
                                                    </div>
                                                    <div class="file-preview box sm">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <input type="hidden" name="types[]"
                                                        value="back_to_school_banner2_links">
                                                    <input type="text" class="form-control" placeholder="http://"
                                                        name="back_to_school_banner2_links[]"
                                                        value="{{ json_decode(get_setting('back_to_school_banner2_links'), true)[$key] }}">
                                                </div>
                                            </div>
                                            <div class="col-md-auto">
                                                <div class="form-group">
                                                    <button type="button"
                                                        class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger"
                                                        data-toggle="remove-parent" data-parent=".row">
                                                        <i class="las la-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <button type="button" class="btn btn-soft-secondary btn-sm" data-toggle="add-more"
                                data-content='
                                                    <div class="row gutters-5">
                                                        <div class="col-md-5">
                                                        <div class="form-group">
                                                        <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
                                                        </div>
                                                        <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                                        <input type="hidden" name="types[]" value="back_to_school_banner2_images">
                                                        <input type="hidden" name="back_to_school_banner2_images[]" class="selected-files">
                                                        </div>
                                                        <div class="file-preview box sm">
                                                        </div>
                                                        </div>
                                                        </div>
                                                        <div class="col-md">
                                                        <div class="form-group">
                                                        <input type="hidden" name="types[]" value="back_to_school_banner2_links">
                                                        <input type="text" class="form-control" placeholder="http://" name="back_to_school_banner2_links[]">
                                                        </div>
                                                        </div>
                                                        <div class="col-md-auto">
                                                        <div class="form-group">
                                                        <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
                                                        <i class="las la-times"></i>
                                                        </button>
                                                        </div>
                                                        </div>
                                                    </div>' data-target=".home-banner2-target">
                                {{ translate('Add New') }}
                            </button>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Home categories --}}
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">{{ translate('Back To School Categories') }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>{{ translate('Categories') }}</label>
                            <div class="home-categories-target">
                                <input type="hidden" name="types[]" value="back_to_school_categories">
                                @if (get_setting('back_to_school_categories') != null)
                                    @foreach (json_decode(get_setting('back_to_school_categories'), true) as $key => $value)
                                        <div class="row gutters-5">
                                            <div class="col">
                                                <div class="form-group">
                                                    <select class="form-control aiz-selectpicker"
                                                        name="back_to_school_categories[]" data-live-search="true"
                                                        data-selected={{ $value }} required>
                                                        @foreach (\App\Category::where('parent_id', 0)->with('childrenCategories')->get()
        as $category)
                                                            <option value="{{ $category->id }}">
                                                                {{ $category->getTranslation('name') }}</option>
                                                            @foreach ($category->childrenCategories as $childCategory)
                                                                @include('categories.child_category', [
                                                                    'child_category' => $childCategory,
                                                                ])
                                                            @endforeach
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button type="button"
                                                    class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger"
                                                    data-toggle="remove-parent" data-parent=".row">
                                                    <i class="las la-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <button type="button" class="btn btn-soft-secondary btn-sm" data-toggle="add-more"
                                data-content='<div class="row gutters-5">
                                                    <div class="col">
                                                    <div class="form-group">
                                                    <select class="form-control aiz-selectpicker" name="back_to_school_categories[]" data-live-search="true" required>
                                                    @foreach (\App\Category::all() as $key => $category)
    <option value="{{ $category->id }}">{{ $category->getTranslation('name') }}</option>
    @endforeach
                                                    </select>
                                                    </div>
                                                    </div>
                                                    <div class="col-auto">
                                                    <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
                                                    <i class="las la-times"></i>
                                                    </button>
                                                    </div>
                                                </div>' data-target=".home-categories-target">
                                {{ translate('Add New') }}
                            </button>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>


            {{-- Home Banner 3 --}}
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">{{ translate('Back To School Banner 3 (Max 3)') }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('business_settings.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>{{ translate('Banner & Links') }}</label>
                            <div class="home-banner3-target">
                                <input type="hidden" name="types[]" value="back_to_school_banner3_images">
                                <input type="hidden" name="types[]" value="back_to_school_banner3_links">
                                <input type="hidden" name="types[]" value="back_to_school_banner3_imgs">
                                <input type="hidden" name="types[]" value="back_to_school_banner3_txt_link">

                                @if (get_setting('back_to_school_banner3_images') != null)
                                    @foreach (json_decode(get_setting('back_to_school_banner3_images'), true) as $key => $value)
                                        <div class="row gutters-5">
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <input type="hidden" name="types[]" value="back_to_school_banner3_imgs">
                                                    <input type="text" class="form-control" placeholder="title banner"
                                                        name="back_to_school_banner3_imgs[]"
                                                        value="{{ json_decode(get_setting('back_to_school_banner3_imgs'), true)[$key] }}">
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <div class="input-group" data-toggle="aizuploader"
                                                        data-type="image">
                                                        <div class="input-group-prepend">
                                                            <div
                                                                class="input-group-text bg-soft-secondary font-weight-medium">
                                                                {{ translate('Browse') }}</div>
                                                        </div>
                                                        <div class="form-control file-amount">
                                                            {{ translate('Choose File') }}</div>
                                                        <input type="hidden" name="types[]"
                                                            value="back_to_school_banner3_images">
                                                        <input type="hidden" name="back_to_school_banner3_images[]"
                                                            class="selected-files"
                                                            value="{{ json_decode(get_setting('back_to_school_banner3_images'), true)[$key] }}">
                                                    </div>
                                                    <div class="file-preview box sm">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <input type="hidden" name="types[]"
                                                        value="back_to_school_banner3_txt_link">
                                                    <input type="text" class="form-control"
                                                        placeholder="txext link banner"
                                                        name="back_to_school_banner3_txt_link[]"
                                                        value="{{ json_decode(get_setting('back_to_school_banner3_txt_link'), true)[$key] }}">
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-group">
                                                    <input type="hidden" name="types[]"
                                                        value="back_to_school_banner3_links">
                                                    <input type="text" class="form-control" placeholder="http://"
                                                        name="back_to_school_banner3_links[]"
                                                        value="{{ json_decode(get_setting('back_to_school_banner3_links'), true)[$key] }}">
                                                </div>
                                            </div>

                                            <div class="col-md-auto">
                                                <div class="form-group">
                                                    <button type="button"
                                                        class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger"
                                                        data-toggle="remove-parent" data-parent=".row">
                                                        <i class="las la-times"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="col-md-auto">
                                                <div class="form-group">
                                                    <a type="button"
                                                        href="{{ route('genenral_trans.index', [
                                                            'table_name' => 'business_settings_home_banner3',
                                                            'row_id' => $key,
                                                        ]) }}"
                                                        class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-success">
                                                        <i class="las la-globe-europe"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <button type="button" class="btn btn-soft-secondary btn-sm" data-toggle="add-more"
                                data-content='
                                                        <div class="row gutters-5">
                                                                                    <div class="col-md">
                                                            <div class="form-group">
                                                                <input type="hidden" name="types[]" value="back_to_school_banner3_imgs">
                                                                <input type="text" class="form-control" placeholder="title banner" name="back_to_school_banner3_imgs[]" >
                                                            </div>
                                                            </div>
                                                            <div class="col-md-5">
                                                            <div class="form-group">
                                                            <div class="input-group" data-toggle="aizuploader" data-type="image">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse') }}</div>
                                                            </div>
                                                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                                            <input type="hidden" name="types[]" value="back_to_school_banner3_images">
                                                            <input type="hidden" name="back_to_school_banner3_images[]" class="selected-files">
                                                            </div>
                                                            <div class="file-preview box sm">
                                                            </div>
                                                            </div>
                                                            </div>
                                                                                            <div class="col-md">
                                                            <div class="form-group">
                                                                <input type="hidden" name="types[]" value="back_to_school_banner3_txt_link">
                                                                <input type="text" class="form-control" placeholder="text link banner" name="back_to_school_banner3_txt_link[]" >
                                                            </div>
                                                            </div>
                                                            <div class="col-md">
                                                            <div class="form-group">
                                                            <input type="hidden" name="types[]" value="back_to_school_banner3_links">
                                                            <input type="text" class="form-control" placeholder="http://" name="back_to_school_banner3_links[]">
                                                            </div>
                                                            </div>

                                                            <div class="col-md-auto">
                                                            <div class="form-group">
                                                            <button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
                                                            <i class="las la-times"></i>
                                                            </button>
                                                            </div>
                                                            </div>
                                                        </div>' data-target=".home-banner3-target">
                                {{ translate('Add New') }}
                            </button>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            AIZ.plugins.bootstrapSelect('refresh');
        });
    </script>
@endsection
