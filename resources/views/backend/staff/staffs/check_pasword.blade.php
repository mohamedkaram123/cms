@extends('backend.layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 h6">{{translate('Staff Information')}}</h5>
            </div>

            <div class="card-body">
                <form class="form-horizontal"  action="{{ route('staffs.check_old_password') }}" method="POST" enctype="multipart/form-data">
            	@csrf

                    <div class="form-group row" >
                        <label class="col-sm-3"  for="password">{{translate('Your Password')}}</label>
                        <div class="col-sm-9">
                            <input type="password" placeholder="{{translate('Your Password')}}" id="password" name="password" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group mb-0 text-right">
                        <button type="submit" class="btn btn-sm btn-primary">{{translate('Save')}}</button>
                    </div>
                </div>
            </form>

            </div>
        </div>
    </div>
</div>

@endsection
