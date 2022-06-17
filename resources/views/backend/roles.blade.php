@extends('backend.layouts.app')

@section('content')
<section class="text-center py-6">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 mx-auto">
				<img src="{{ static_asset('assets/img/404.svg') }}" class="mw-100 mx-auto mb-5" height="300">
			    <h1 class="fw-700">{{ translate('Not Allowed Open This Page') }}</h1>
			    <p class="fs-16 opacity-60">{{ translate('Please check with your administrator to review your access permissions on this page.') }}</p>
			</div>
		</div>
    </div>
</section>
@endsection
