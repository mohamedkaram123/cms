@extends('backend.layouts.app')
@section('content')
     <form class="form-horizontal" action="{{ route('business_settings.update') }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf
  <div class="row">
        <div class="col-xl-10 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h1 class="mb-0 h6">{{translate('choose Login Page')}}</h1>
                </div>
                <div class="card-body">

                                    <input type="hidden" name="types[]" value="login_page">

                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label">{{translate('choose login page')}}</label>
                            <div class="col-sm-9">
                                 <select id="select_login_page" class="form-control" name="login_page">
                                     <option {{ get_setting('login_page') == "1"?"selected":""}}  value="1">{{translate("Login One")}}</option>
                                      <option {{ get_setting('login_page') == "2"?"selected":""}} value="2">{{translate("Login Two")}}</option>
                                 </select>
                                <div class="file-preview box sm"></div>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
<div class="row d-none data_login_2">
	<div class="col-xl-10 mx-auto">
		<h6 class="fw-600">{{ translate('Login Page Settings') }}</h6>


		{{-- Home Banner 1 --}}
		<div class="card">
			<div class="card-header">
				<h6 class="mb-0">{{ translate('Login Slides (Max 3)') }}</h6>
			</div>
			<div class="card-body">

					<div class="form-group">
						<label>{{ translate('Login Slides') }}</label>
						<div class="home-banner1-target">
							<input type="hidden" name="types[]" value="login_sliders">
                            <input type="hidden" name="types[]" value="login_slider_pragraph_shops">
							{{-- <input type="hidden" name="types[]" value="shops_name"> --}}

							@if (get_setting('login_sliders') != null)
								@foreach (json_decode(get_setting('login_sliders'), true) as $key => $value)
									<div class="row gutters-5">
										<div class="col-md-4">
											<div class="form-group">
												<div class="input-group" data-toggle="aizuploader" data-type="image">
					                                <div class="input-group-prepend">
					                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
					                                </div>
					                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
													<input type="hidden" name="types[]" value="login_sliders">
					                                <input type="hidden" name="login_sliders[]" class="selected-files" value="{{ json_decode(get_setting('login_sliders'), true)[$key] }}" >
					                            </div>
					                            <div class="file-preview box sm">
					                            </div>
				                            </div>
										</div>
                                        <div class="col-md-6">
											<div class="form-group">
												<input type="hidden" name="types[]" value="login_slider_pragraph_shops">
												 <textarea rows="3" name="login_slider_pragraph_shops[]" class="form-control" required>{{ json_decode(get_setting('login_slider_pragraph_shops'), true)[$key] }}</textarea>
											</div>
										</div>

										<div class="col-md-auto">
											<div class="form-group">
												<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
													<i class="las la-times"></i>
												</button>
											</div>
										</div>
									</div>
								@endforeach
							@endif
						</div>
						<button
							type="button"
							class="btn btn-soft-secondary btn-sm"
							data-toggle="add-more"
							data-content='
							<div class="row gutters-5">
								<div class="col-md-4">
									<div class="form-group">
										<div class="input-group" data-toggle="aizuploader" data-type="image">
											<div class="input-group-prepend">
												<div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
											</div>
											<div class="form-control file-amount">{{ translate('Choose File') }}</div>
											<input type="hidden" name="types[]" value="login_sliders">
											<input type="hidden" name="login_sliders[]" class="selected-files" >
										</div>
										<div class="file-preview box sm">
										</div>
									</div>
								</div>
                                <div class="col-md-6">
											<div class="form-group">
												<input type="hidden" name="types[]" value="login_slider_pragraph_shops">
												 <textarea rows="3" name="login_slider_pragraph_shops[]" class="form-control" required></textarea>
											</div>
										</div>
								<div class="col-md-auto">
									<div class="form-group">
										<button type="button" class="mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger" data-toggle="remove-parent" data-parent=".row">
											<i class="las la-times"></i>
										</button>
									</div>
								</div>
							</div>'
							data-target=".home-banner1-target">
							{{ translate('Add New') }}
						</button>
					</div>

			</div>
		</div>

	</div>
</div>
    <div class="row d-none data_login_2"  >
        <div class="col-xl-10 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h1 class="mb-0 h6">{{translate('General Settings')}}</h1>
                </div>
                <div class="card-body">


                        <div class="form-group row">
                            <label class="col-sm-3 col-from-label">{{translate('user login page background')}}</label>
                            <div class="col-sm-9">
                                <div class="input-group" data-toggle="aizuploader" data-type="image">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text bg-soft-secondary">{{ translate('Browse') }}</div>
                                    </div>
                                    <div class="form-control file-amount">{{ translate('Choose Files') }}</div>
                                    <input type="hidden" name="types[]" value="user_login_background">
                                    <input type="hidden" name="user_login_background" value="{{ get_setting('user_login_background') }}" class="selected-files">
                                </div>
                                <div class="file-preview box sm"></div>
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
		$(document).ready(function(){

            @if(get_setting('login_page') == "2")
            console.log("Dddddd");
              $(".data_login_2").removeClass("d-none");
            @endif

            $("#select_login_page").change(function (e) {
                e.preventDefault();
                if($(this).val() == "2"){
                      $(".data_login_2").removeClass("d-none");

                }else{
                     $(".data_login_2").addClass("d-none");

                }

            });
		    AIZ.plugins.bootstrapSelect('refresh');
		});
    </script>
@endsection
