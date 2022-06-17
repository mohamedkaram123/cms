@extends('backend.layouts.app')
@section('content')
    <form class="form-horizontal" action="{{ route('business_settings.update') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xl-10 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h1 class="mb-0 h6">{{ translate('choose Register Page') }}</h1>
                    </div>
                    <div class="card-body">

                        <input type="hidden" name="types[]" value="register_page">

                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label">{{ translate('choose register page') }}</label>
                            <div class="col-sm-9">
                                <select id="select_register_page" class="form-control" name="register_page">
                                    <option {{ get_setting('register_page') == '1' ? 'selected' : '' }} value="1">
                                        {{ translate('register One') }}</option>
                                    <option {{ get_setting('register_page') == '2' ? 'selected' : '' }} value="2">
                                        {{ translate('register Two') }}</option>
                                </select>
                                <div class="file-preview box sm"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row d-none data_register_2">
            <div class="col-xl-10 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h1 class="mb-0 h6">{{ translate('General Settings') }}</h1>
                    </div>
                    <div class="card-body">


                        <div class="form-group row">
                            <label
                                class="col-sm-3 col-from-label">{{ translate('user register page background') }}</label>
                            <div class="col-sm-9">
                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary">{{ translate('Browse') }}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ translate('Choose Files') }}</div>
                                    <input type="hidden" name="types[]" value="user_register_background">
                                    <input type="hidden" name="user_register_background"
                                        value="{{ get_setting('user_register_background') }}" class="selected-files">
                                </div>
                                <div class="file-preview box sm"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row d-none data_register_2">
            <div class="col-xl-10 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h1 class="mb-0 h6">{{ translate('General Settings') }}</h1>
                    </div>
                    <div class="card-body">


                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label">{{ translate('user register title') }}</label>
                            <div class="col-12">
                                <input type="hidden" name="types[]" value="user_register_title">
                                <input class="form-control" type="text" name="user_register_title"
                                    value="{{ get_setting('user_register_title') }}" class="class-form">
                            </div>

                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label">{{ translate('user register description') }}</label>
                            <div class="col-12">
                                <input type="hidden" name="types[]" value="user_register_desc">
                                <input class="form-control" type="text" name="user_register_desc"
                                    value="{{ get_setting('user_register_desc') }}" class="class-form">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class=" text-right my-4" style="margin-inline-end: 50px">
            <button type="submit" class="btn btn-primary">{{ translate('Update') }}</button>
        </div>
    </form>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {

            @if (get_setting('register_page') == '2')
                console.log("Dddddd");
                $(".data_register_2").removeClass("d-none");
            @endif

            $("#select_register_page").change(function(e) {
                e.preventDefault();
                if ($(this).val() == "2") {
                    $(".data_register_2").removeClass("d-none");

                } else {
                    $(".data_register_2").addClass("d-none");

                }

            });
            AIZ.plugins.bootstrapSelect('refresh');
        });
    </script>
@endsection
