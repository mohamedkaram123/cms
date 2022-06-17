@extends('frontend.layouts.user_panel')

@section('panel_content')

@php
    $user = auth()->user();
@endphp

<input type="hidden" value="{{$user}}" id="user_data" />

    <div class="aiz-titlebar mt-2 mb-4">
    <div class="row align-items-center">
      <div class="col-md-6">
          <h1 class="h3">{{ translate('My Wallet') }}</h1>
      </div>
    </div>
    </div>
    <div class="row gutters-10">
      <div class="col-md-4 mx-auto mb-3" >
          <div class="bg-grad-1 text-white rounded-lg overflow-hidden">
            <span class="size-30px rounded-circle mx-auto bg-soft-primary d-flex align-items-center justify-content-center mt-3">
                <i class="las la-dollar-sign la-2x text-white"></i>
            </span>
            <div class="px-3 pt-3 pb-3">
                <div class="h4 fw-700 text-center">{{ single_price(Auth::user()->balance) }}</div>
                <div class="opacity-50 text-center">{{ translate('Wallet Balance') }}</div>
            </div>
          </div>
      </div>
      <div class="col-md-4 mx-auto mb-3" >
        <div class="p-3 rounded mb-3 c-pointer text-center bg-white shadow-sm hov-shadow-lg has-transition" onclick="show_wallet_modal()">
            <span class="size-60px rounded-circle mx-auto bg-secondary d-flex align-items-center justify-content-center mb-3">
                <i class="las la-plus la-3x text-white"></i>
            </span>
            <div class="fs-18 text-primary">{{ translate('Recharge Wallet') }}</div>
        </div>
      </div>
      @if (\App\Addon::where('unique_identifier', 'offline_payment')->first() != null && \App\Addon::where('unique_identifier', 'offline_payment')->first()->activated)
          <div class="col-md-4 mx-auto mb-3" >
              <div class="p-3 rounded mb-3 c-pointer text-center bg-white shadow-sm hov-shadow-lg has-transition" onclick="show_make_wallet_recharge_modal()">
                  <span class="size-60px rounded-circle mx-auto bg-secondary d-flex align-items-center justify-content-center mb-3">
                      <i class="las la-plus la-3x text-white"></i>
                  </span>
                  <div class="fs-18 text-primary">{{ translate('Offline Recharge Wallet') }}</div>
              </div>
          </div>
      @endif
    </div>
    <div class="card">
      <div class="card-header">
          <h5 class="mb-0 h6">{{ translate('Wallet recharge history')}}</h5>
      </div>
        <div class="card-body">
            <table class="table aiz-table mb-0">
                <thead>
                  <tr>
                      <th>#</th>
                      <th data-breakpoints="lg">{{  translate('Date') }}</th>
                      <th>{{ translate('Amount')}}</th>
                      <th data-breakpoints="lg">{{ translate('Payment Method')}}</th>
                      <th class="text-right">{{ translate('Approval')}}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($wallets as $key => $wallet)
                      <tr>
                          <td>{{ $key+1 }}</td>
                          <td>{{ date('d-m-Y', strtotime($wallet->created_at)) }}</td>
                          <td>{{ single_price($wallet->amount) }}</td>
                          <td>{{ ucfirst(str_replace('_', ' ', $wallet ->payment_method)) }}</td>
                          <td class="text-right">
                              @if ($wallet->offline_payment)
                                  @if ($wallet->approval)
                                      <span class="badge badge-inline badge-success">{{translate('Approved')}}</span>
                                  @else
                                      <span class="badge badge-inline badge-info">{{translate('Pending')}}</span>
                                  @endif
                              @else
                                  N/A
                              @endif
                          </td>
                      </tr>
                  @endforeach

                </tbody>
            </table>
            <div class="aiz-pagination">
                {{ $wallets->links() }}
            </div>
        </div>
    </div>
@endsection

@section('modal')

  <div class="modal fade" id="wallet_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ translate('Recharge Wallet') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
              </div>
              <form class="" id="recharge_form" action="{{ route('wallet.recharge') }}" method="post">
                  @csrf
                  <div class="modal-body gry-bg px-3 pt-3">
                      <div class="row">
                          <div class="col-md-4">
                              <label>{{ translate('Amount')}} <span class="text-danger">*</span></label>
                          </div>
                          <div class="col-md-8 mb-3">
                              <input type="number" id="amount_val" lang="en" class="form-control " name="amount" placeholder="{{ translate('Amount')}}" required>
                               <small id="amount_require" class="require_data d-none">{{translate("please enter your amount")}}</small>
                            </div>
                      </div>
                      <div class="row">
                          <div class="col-md-4">
                              <label>{{ translate('Payment Method')}} <span class="text-danger">*</span></label>
                          </div>
                          <div class="col-md-8">
                              <div class="mb-3">
                                  <select class="form-control " id="payment_options" data-minimum-results-for-search="Infinity" name="payment_option" data-live-search="true">



                                    @if (\App\BusinessSetting::where('type', 'paytab_sandbox')->first()->value == 1)
                                    <option value="paytab">{{ translate('paytab')}}</option>
                                    @endif

                                    @if (\App\BusinessSetting::where('type', 'TapPayment_sandbox')->first()->value == 1)
                                    <option value="tappayment">{{ translate('TapPayment')}}</option>
                                @endif


                                @if (\App\BusinessSetting::where('type', 'fawry_sandbox')->first()->value == 1)
                                <option value="fawry">{{ translate('Fawry')}}</option>
                            @endif
                              @if (\App\BusinessSetting::where('type', 'fekra_pay_sandbox')->first()->value == 1)
                                <option value="fekrapay">{{ translate('Fekra Pay')}}</option>
                            @endif
                                  </select>
                              </div>
                          </div>
                      </div>
                      <div class="form-group text-right">
                          <button type="submit" id="btn_confirmed" class="btn btn-sm btn-primary transition-3d-hover mr-1">{{translate('Confirm')}}</button>
                      </div>
                  </div>
              </form>
          </div>
      </div>
  </div>


  <!-- offline payment Modal -->
  <div class="modal fade" id="offline_wallet_recharge_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">{{ translate('Offline Recharge Wallet') }}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
              </div>
              <div id="offline_wallet_recharge_modal_body"></div>
          </div>
      </div>
  </div>

@endsection

@section('script')



<script type="module">

    import { checkout} from '../../../cart/public/assets/js/fawry.js';

    document.getElementById("btn_confirmed").addEventListener("click", function(e) {

    if(document.getElementById("amount_val").value != ""){
     if(document.getElementById("payment_options").value == "fawry"){
       checkout(
            "{{get_setting("fawry_merchant_code")}}",
            "{{ md5(rand(1,6))}}",
            "{{ md5(rand(1,6))}}",
            document.getElementById("amount_val").value,
            "{{get_setting("fawry_security_key")}}",
            "{{route("fawryCallback",["payment_type"=>"wallet_payment","user_id"=>$user->id])}}",
            JSON.parse(document.getElementById("user_data").value))
        }
    }


});

</script>

    <script type="text/javascript">



      $("#btn_confirmed").click(function (e) {
          e.preventDefault();

          if($("#amount_val").val() == ""){
          $("#amount_require").removeClass("d-none");

          }else{
          $("#amount_require").addClass("d-none");

          }
          if($("#payment_options").val() != "fawry"){

       if($("#amount_val").val() != 0 && $("#amount_val").val() != ""){
 $("#recharge_form").submit();
       }


          }
      });
        function show_wallet_modal(){
            $('#wallet_modal').modal('show');
        }


        function show_make_wallet_recharge_modal(){
            $.post('{{ route('offline_wallet_recharge_modal') }}', {_token:'{{ csrf_token() }}'}, function(data){
                $('#offline_wallet_recharge_modal_body').html(data);
                $('#offline_wallet_recharge_modal').modal('show');
            });
        }
    </script>
@endsection