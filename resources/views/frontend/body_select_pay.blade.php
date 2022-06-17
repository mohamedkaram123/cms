@php
$lang = Session::get('locale', Config::get('app.locale'));
@endphp
<div class="row">
@foreach ($pays as $pay )
         <div class="col-6 col-md-4">
            <label class="aiz-megabox d-block mb-3">
                <input name="fekra_pay_method_data" value="{{$pay->PaymentMethodId}}" class="fekra_payment" type="radio" />
                <span class="d-block p-3 aiz-megabox-elem">
                <img src="{{$pay->ImageUrl}}" class="img-fluid mb-2">
                <span class="d-block text-center">
                    <span class="d-block fw-600 fs-15">{{$lang == "ar"?$pay->PaymentMethodAr:$pay->PaymentMethodEn}}</span>
                </span>
            </span>
            </label>
        </div>
@endforeach
</div>

