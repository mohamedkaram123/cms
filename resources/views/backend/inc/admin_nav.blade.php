<div class="aiz-topbar px-15px px-lg-25px d-flex align-items-stretch justify-content-between">
    <div class="d-xl-none d-flex">
        <div class="aiz-topbar-nav-toggler d-flex align-items-center justify-content-start mr-2 mr-md-3" data-toggle="aiz-mobile-nav">
            <button class="aiz-mobile-toggler">
                <span></span>
            </button>
        </div>
        <div class="aiz-topbar-logo-wrap d-flex align-items-center justify-content-start">
            @php
                $logo = get_setting('header_logo');
            @endphp
            <a href="{{ route('admin.dashboard') }}" class="d-block">
                @if($logo != null)
                    <img src="{{ uploaded_asset($logo) }}" class="brand-icon" alt="{{ get_setting('website_name') }}">
                @else
                    <img src="{{ static_asset('assets/img/logos.png') }}" class="brand-icon" alt="{{ get_setting('website_name') }}">
                @endif
            </a>
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-stretch flex-grow-xl-1">
        <div class="d-none d-md-flex justify-content-around align-items-center align-items-stretch">
            <div class="d-none d-md-flex justify-content-around align-items-center align-items-stretch">
                <div class="aiz-topbar-item">
                    <div class="d-flex align-items-center">
                        <a class="btn btn-icon btn-circle btn-light" href="{{ route('home')}}" target="_blank" title="{{ translate('Browse Website') }}">
                            <i class="las la-globe"></i>
                        </a>
                    </div>
                </div>
            </div>
                        @php
                            $placeholder =  translate("Search By")  ." , ". translate("Product Name") ." , " .translate("Categorey Name") .  " , " . translate("Product Desc") ;
                                 if(request("type") == "products"){


                 $placeholder = translate("Search By") ." , ". translate("Product Name") ." , " .translate("Categorey Name") .  " , " . translate("Product Desc");
            }else if(request("type") ==  "sales"){


              $placeholder =  translate("Search By") ." , " . translate("Order Id") ." , " .translate("Order Code") .  " , " . translate("Customer Name") ;
            }else if(request("type") ==   "customers"){


             $placeholder =  translate("Search By") ." , " . translate("Customer Name") ." , " .translate("Phone Number")  ;
            }else if(request("type") ==  "sellers"){


              $placeholder =  translate("Search By") ." , ". translate("Seller Name") ." , " .translate("Seller Phone") ;
            }

                       @endphp
            <div style="margin-inline: 5%"  class="d-none d-md-flex justify-content-around align-items-center align-items-stretch">
{{-- {{dd(request("type"))}} --}}
                <div class="aiz-topbar-item">

                        <form class="d-flex align-items-center" action="{{route("search.navbar")}}" method="POST">

                            @csrf
                            <input  style="width:420px;border-radius: 0" id="input_search" name="search" value="{{request("search") != null?request("search"):""}}"
                            placeholder="{{ $placeholder }}"    type="text" class="form-control input_search_nav" />
                             <input type="hidden" name="type" id="type_search" value="{{request()->has("type")?request("type"):"products" }}" />
                            <select id="select_search"  style="max-width: 120px;border-radius: 0" class="form-control">
                                <option {{request("type") == "products"?"selected":"" }} value="products">{{ translate("Products") }}</option>
                                <option {{request("type") == "customers"?"selected":"" }} value="customers">{{ translate("Customers") }}</option>
                                <option {{request("type") == "sales"?"selected":"" }} value="sales">{{ translate("Sales") }}</option>
                                <option {{request("type") == "sellers"?"selected":"" }} value="sellers">{{ translate("Sellers") }}</option>

                            </select>
                            <button style="width: 60px;border-radius: 0" class="btn btn-icon btn-primary"><i style="font-size: 18px" class="las la-search"></i></button>

                        </form>


                </div>
            </div>
            @if (\App\Addon::where('unique_identifier', 'pos_system')->first() != null && \App\Addon::where('unique_identifier', 'pos_system')->first()->activated)
                <div class="d-none d-md-flex justify-content-around align-items-center align-items-stretch ml-3">
                    <div class="aiz-topbar-item">
                        <div class="d-flex align-items-center">
                            <a class="btn btn-icon btn-circle btn-light" href="{{ route('poin-of-sales.index') }}" target="_blank" title="{{ translate('POS') }}">
                                <i class="las la-print"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="d-flex justify-content-around align-items-center align-items-stretch">
            {{-- @php
                $orders = DB::table('orders')
                            ->orderBy('code', 'desc')
                            ->join('order_details', 'orders.id', '=', 'order_details.order_id')
                            ->where('order_details.seller_id', \App\User::where('user_type', 'admin')->first()->id)
                            ->where('orders.viewed', 0)
                            ->select('orders.id')
                            ->distinct()
                            ->count();
                $sellers = \App\Seller::where('verification_status', 0)->where('verification_info', '!=', null)->count();
            @endphp --}}

            <div class="aiz-topbar-item ml-2">
                <div class="align-items-stretch d-flex dropdown">
                    <a class="dropdown-toggle no-arrow" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false">
                        <span class="btn btn-icon p-1">
                            <span class=" position-relative d-inline-block">
                                <i class="las la-bell la-2x"></i>
                                    <span id="notify_counter" class="badge badge-circle badge-primary position-absolute absolute-top-right">{{ count(\App\Models\Notification::where("user_id",auth()->user()->id)->where("show",0)->get()) }}</span>
                            </span>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated  py-0 " style="min-width: 450px"  >
                        <div class="p-3 bg-light border-bottom">
                            <h6 class="mb-0">{{ translate('Notifications') }}</h6>
                        </div>
                        <div id="Notififcation_items">

                        </div>


{{--
                            @if($orders > 0)
                            <li class="list-group-item">
                                <a href="{{ route('inhouse_orders.index') }}" class="text-reset">
                                    <span class="ml-2">{{ $orders }} {{translate('new orders')}}</span>
                                </a>
                            </li>
                            @endif
                            @if($sellers > 0)
                            <li class="list-group-item">
                                <a href="{{ route('sellers.index') }}" class="text-reset">
                                    <span class="ml-2">{{translate('New verification request(s)')}}</span>
                                </a>
                            </li>
                            @endif --}}


                    </div>
                </div>
            </div>

            {{-- language --}}
            @php
                if(Session::has('locale')){
                    $locale = Session::get('locale', Config::get('app.locale'));
                }
                else{
                    $locale = env('DEFAULT_LANGUAGE');
                }
            @endphp
            <div class="aiz-topbar-item ml-2">
                <div class="align-items-stretch d-flex dropdown " id="lang-change">
                    <a class="dropdown-toggle no-arrow" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false">
                        <span class="btn btn-icon">
                            <img src="{{ static_asset('assets/img/flags/'.$locale.'.png') }}" height="11">
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-menu-xs">

                        @foreach (\App\Language::all() as $key => $language)
                            <li>
                                <a href="javascript:void(0)" data-flag="{{ $language->code }}" class="dropdown-item @if($locale == $language->code) active @endif">
                                    <img src="{{ static_asset('assets/img/flags/'.$language->code.'.png') }}" class="mr-2">
                                    <span class="language">{{ $language->name }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="aiz-topbar-item ml-2">
                <div class="align-items-stretch d-flex dropdown">
                    <a class="dropdown-toggle no-arrow text-dark" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <span class="avatar avatar-sm mr-md-2">
                                <img
                                    src="{{ uploaded_asset(Auth::user()->avatar_original) }}"
                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/avatar-place.png') }}';"
                                >
                            </span>
                            <span class="d-none d-md-block">
                                <span class="d-block fw-500">{{Auth::user()->name}}</span>
                                <span class="d-block small opacity-60">{{Auth::user()->user_type}}</span>
                            </span>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated dropdown-menu-md">
                        <a href="{{ route('profile.index') }}" class="dropdown-item">
                            <i class="las la-user-circle"></i>
                            <span>{{translate('Profile')}}</span>
                        </a>

                        <a href="{{ route('logout')}}" class="dropdown-item">
                            <i class="las la-sign-out-alt"></i>
                            <span>{{translate('Logout')}}</span>
                        </a>
                    </div>
                </div>
            </div><!-- .aiz-topbar-item -->
        </div>
    </div>
</div><!-- .aiz-topbar -->
