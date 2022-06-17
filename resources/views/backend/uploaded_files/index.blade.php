@extends('backend.layouts.app')

@section('content')
    <div class="aiz-titlebar text-left mt-2 mb-3">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="h3">{{ translate('All uploaded files') }}</h1>
            </div>
            <div class="d-flex flex-row col-md-6 " style="justify-content: flex-end">
                <div class="mx-2 ">
                    <button id="btn_add_extension" class=" btn btn-primary">
                        <span style="color: #fff">{{ translate('add extentions') }}</span>
                    </button>
                </div>
                <div>
                    <a href="{{ route('uploaded-files.create') }}" class="btn btn-primary">
                        <span>{{ translate('Upload New File') }}</span>
                    </a>
                </div>

            </div>
        </div>
    </div>

    <div class="card">
        <form id="sort_uploads" action="">
            <div class="card-header row gutters-5">
                <div class="col-md-3">
                    <h5 class="mb-0 h6">{{ translate('All files') }}</h5>
                </div>
                <div class="col-md-3 ml-auto mr-0">
                    <select class="form-control form-control-xs aiz-selectpicker" name="sort" onchange="sort_uploads()">
                        <option value="newest" @if ($sort_by == 'newest') selected="" @endif>
                            {{ translate('Sort by newest') }}</option>
                        <option value="oldest" @if ($sort_by == 'oldest') selected="" @endif>
                            {{ translate('Sort by oldest') }}</option>
                        <option value="smallest" @if ($sort_by == 'smallest') selected="" @endif>
                            {{ translate('Sort by smallest') }}</option>
                        <option value="largest" @if ($sort_by == 'largest') selected="" @endif>
                            {{ translate('Sort by largest') }}</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control form-control-xs" name="search"
                        placeholder="{{ translate('Search your files') }}" value="{{ $search }}">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">{{ translate('Search') }}</button>
                </div>
            </div>
        </form>
        <div class="card-body">
            <div class="row gutters-5">
                @foreach ($all_uploads as $key => $file)
                    @php
                        if ($file->file_original_name == null) {
                            $file_name = translate('Unknown');
                        } else {
                            $file_name = $file->file_original_name;
                        }
                    @endphp
                    <div class="col-auto w-140px w-lg-220px">
                        <div class="aiz-file-box">
                            <div class="dropdown-file">
                                <a class="dropdown-link" data-toggle="dropdown">
                                    <i class="la la-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="javascript:void(0)" class="dropdown-item" onclick="detailsInfo(this)"
                                        data-id="{{ $file->id }}">
                                        <i class="las la-info-circle mr-2"></i>
                                        <span>{{ translate('Details Info') }}</span>
                                    </a>
                                    <a href="{{ my_asset($file->file_name) }}" target="_blank"
                                        download="{{ $file_name }}.{{ $file->extension }}" class="dropdown-item">
                                        <i class="la la-download mr-2"></i>
                                        <span>{{ translate('Download') }}</span>
                                    </a>
                                    <a href="javascript:void(0)" class="dropdown-item" onclick="copyUrl(this)"
                                        data-url="{{ my_asset($file->file_name) }}">
                                        <i class="las la-clipboard mr-2"></i>
                                        <span>{{ translate('Copy Link') }}</span>
                                    </a>
                                    <a href="javascript:void(0)" class="dropdown-item confirm-alert"
                                        data-href="{{ route('uploaded-files.destroy', $file->id) }}"
                                        data-target="#delete-modal">
                                        <i class="las la-trash mr-2"></i>
                                        <span>{{ translate('Delete') }}</span>
                                    </a>
                                </div>
                            </div>
                            <div class="card card-file aiz-uploader-select c-default"
                                title="{{ $file_name }}.{{ $file->extension }}">
                                <div class="card-file-thumb">
                                    @if ($file->type == 'image')
                                        <img src="{{ my_asset($file->file_name) }}" class="img-fit">
                                    @elseif($file->type == 'video')
                                        <i class="las la-file-video"></i>
                                    @else
                                        <i class="las la-file"></i>
                                    @endif
                                </div>
                                <div class="card-body">
                                    <h6 class="d-flex">
                                        <span class="text-truncate title">{{ $file_name }}</span>
                                        <span class="ext">.{{ $file->extension }}</span>
                                    </h6>
                                    <p>{{ formatBytes($file->file_size) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="aiz-pagination mt-3">
                {{ $all_uploads->appends(request()->input())->links() }}
            </div>
        </div>
    </div>
@endsection
@section('modal')
    <div id="delete-modal" class="modal fade">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title h6">{{ translate('Delete Confirmation') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body text-center">
                    <p class="mt-1">{{ translate('Are you sure to delete this file?') }}</p>
                    <button type="button" class="btn btn-link mt-2"
                        data-dismiss="modal">{{ translate('Cancel') }}</button>
                    <a href="" class="btn btn-primary mt-2 comfirm-link">{{ translate('Delete') }}</a>
                </div>
            </div>
        </div>
    </div>
    <div id="info-modal" class="modal fade">
        <div class="modal-dialog modal-dialog-right">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h6">{{ translate('File Info') }}</h5>
                    <button type="button" class="close" data-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body c-scrollbar-light position-relative" id="info-modal-content">
                    <div class="c-preloader text-center absolute-center">
                        <i class="las la-spinner la-spin la-3x opacity-70"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="extenion-modal" class="modal fade">
        <div class="modal-dialog ">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h6">{{ translate('Setting Extention') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body text-center">
                    <input id="tag_data"
                        value="{{ implode(',', array_keys(json_decode(get_setting('extension_upload'), true))) }}"
                        type="text" data-on-change="update_data" class="form-control aiz-tag-input">
                    <button type="button" class="btn btn-link mt-2"
                        data-dismiss="modal">{{ translate('Cancel') }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $("#btn_add_extension").click(function(e) {
            e.preventDefault();
            $("#extenion-modal").modal()
            AIZ.plugins.tagify();

        });

        function update_data(e, type) {
            console.log({
                data: $("#tag_data").val()
            });
            var data = {
                _token: '{{ csrf_token() }}',
                value: $("#tag_data").val(),
                type
            };
            $.ajax({
                type: "POST",
                url: '{{ route('upload.update_extension') }}',
                data,
                success: function(data) {
                    console.log({
                        data
                    });

                }
            });
        }


        function detailsInfo(e) {
            $('#info-modal-content').html(
                '<div class="c-preloader text-center absolute-center"><i class="las la-spinner la-spin la-3x opacity-70"></i></div>'
            );
            var id = $(e).data('id')
            $('#info-modal').modal('show');
            $.post('{{ route('uploaded-files.info') }}', {
                _token: AIZ.data.csrf,
                id: id
            }, function(data) {
                $('#info-modal-content').html(data);
                // console.log(data);
            });
        }

        function copyUrl(e) {
            var url = $(e).data('url');
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val(url).select();
            try {
                document.execCommand("copy");
                AIZ.plugins.notify('success', '{{ translate('Link copied to clipboard') }}');
            } catch (err) {
                AIZ.plugins.notify('danger', '{{ translate('Oops, unable to copy') }}');
            }
            $temp.remove();
        }

        function sort_uploads(el) {
            $('#sort_uploads').submit();
        }
    </script>
@endsection
