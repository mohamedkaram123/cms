<div class="aiz-sidebar-wrap">
    <div class="aiz-sidebar left c-scrollbar">
        <div class="aiz-side-nav-logo-wrap">
            <a href="{{ route('admin.dashboard') }}" class="d-block text-left">
                @if (get_setting('system_logo_white') != null)
                    <img class="mw-100" src="{{ uploaded_asset(get_setting('system_logo_white')) }}"
                        class="brand-icon" alt="{{ get_setting('site_name') }}">
                @else
                    <img class="mw-100" src="{{ static_asset('assets/img/logo.png') }}" class="brand-icon"
                        alt="{{ get_setting('site_name') }}">
                @endif
            </a>
        </div>
        <div class="aiz-side-nav-wrap">
            <div class="px-20px mb-3">
                <input class="form-control bg-soft-secondary border-0 form-control-sm text-white" type="text" name=""
                    placeholder="{{ translate('Search in menu') }}" id="menu-search" onkeyup="menuSearch()">
            </div>
            <ul class="aiz-side-nav-list" id="search-menu">
            </ul>
            <ul class="aiz-side-nav-list" id="main-menu" data-toggle="aiz-side-menu">
                <li class="aiz-side-nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="aiz-side-nav-link">
                        <i class="las la-home aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text">{{ translate('Dashboard') }}</span>
                    </a>
                </li>

                <!-- POS Addon-->
                {{-- @if (\App\Addon::where('unique_identifier', 'pos_system')->first() != null && \App\Addon::where('unique_identifier', 'pos_system')->first()->activated)
                    @if (Auth::user()->user_type == 'admin' || in_array('1', json_decode(Auth::user()->staff->role->permissions)))
                      <li class="aiz-side-nav-item">
                        <a href="#" class="aiz-side-nav-link">
                            <i class="las la-tasks aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{translate('POS System')}}</span>
                            @if (env('DEMO_MODE') == 'On')
                            <span class="badge badge-inline badge-danger">Addon</span>
                            @endif
                            <span class="aiz-side-nav-arrow"></span>
                        </a>
                        <ul class="aiz-side-nav-list level-2">
                            <li class="aiz-side-nav-item">
                                <a href="{{route('poin-of-sales.index')}}" class="aiz-side-nav-link {{ areActiveRoutes(['poin-of-sales.index', 'poin-of-sales.create'])}}">
                                    <span class="aiz-side-nav-text">{{translate('POS Manager')}}</span>
                                </a>
                            </li>
                            <li class="aiz-side-nav-item">
                                <a href="{{route('poin-of-sales.activation')}}" class="aiz-side-nav-link">
                                    <span class="aiz-side-nav-text">{{translate('POS Configuration')}}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif
                @endif --}}

                <!-- Product -->
                @if (Roles::Check('1'))
                    <li class="aiz-side-nav-item">
                        <a href="#" class="aiz-side-nav-link">
                            <i class="las la-shopping-cart aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{ translate('Products') }}</span>
                            <span class="aiz-side-nav-arrow"></span>
                        </a>
                        <!--Submenu-->
                        <ul class="aiz-side-nav-list level-2">
                            {{-- <li class="aiz-side-nav-item">
                                <a class="aiz-side-nav-link" href="{{route('products_js')}}">
                                    <span class="aiz-side-nav-text">{{translate('Products')}}</span>
                                </a>
                            </li> --}}
                            @if (Roles::Check('2'))
                                <li class="aiz-side-nav-item">
                                    <a class="aiz-side-nav-link {{ areActiveRoutes(['products.create', ['role_id' => encrypt('2')]]) }}"
                                        href="{{ route('products.create', ['role_id' => encrypt('2')]) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Add New product') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (Roles::Check('3'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('products.all', ['role_id' => encrypt('3')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['products.all', ['role_id' => encrypt('3')]]) }}">
                                        <span class="aiz-side-nav-text">{{ translate('All Products') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (Roles::Check('4'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('products.admin', ['role_id' => encrypt('4')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['products.admin', ['role_id' => encrypt('4')]]) }}">
                                        <span class="aiz-side-nav-text">{{ translate('In House Products') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (Roles::Check('14'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('products.archive', ['role_id' => encrypt('14')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['products.archive', ['role_id' => encrypt('14')]]) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Products Archive') }}</span>
                                    </a>
                                </li>
                            @endif
                            {{-- @if (\App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
                            @if (Roles::Check('5'))

                                <li class="aiz-side-nav-item">
                                    <a href="{{route('products.seller',["role_id"=>encrypt("5")])}}" class="aiz-side-nav-link {{ areActiveRoutes(['products.seller',["role_id"=>encrypt("5")], 'products.seller.edit',["role_id"=>encrypt("5")]]) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Seller Products') }}</span>
                                    </a>
                                </li>
                            @endif
                            @endif --}}
                            @if (Roles::Check('247'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('digitalproducts.index', ['role_id' => encrypt('247')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['digitalproducts.index', ['role_id' => encrypt('6')], 'digitalproducts.create', ['role_id' => encrypt('6')], 'digitalproducts.edit', ['role_id' => encrypt('6')]]) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Digital Products') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (Roles::Check('11'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('product_bulk_upload.index', ['role_id' => encrypt('11')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['product_bulk_upload.index', ['role_id' => encrypt('11')]]) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Bulk Import') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (Roles::Check('12'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('product_bulk_export.index', ['role_id' => encrypt('12')]) }}"
                                        class="aiz-side-nav-link">
                                        <span class="aiz-side-nav-text">{{ translate('Bulk Export') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (Roles::Check('261'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('categories.index', ['role_id' => encrypt('261')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['categories.index', ['role_id' => encrypt('261')], 'categories.create', ['role_id' => encrypt('261')], 'categories.edit', ['role_id' => encrypt('261')]]) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Category') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (Roles::Check('281'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('brands.index', ['role_id' => encrypt('281')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['brands.index', ['role_id' => encrypt('281')], 'brands.create', ['role_id' => encrypt('281')], 'brands.edit', ['role_id' => encrypt('281')]]) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Brand') }}</span>
                                    </a>
                                </li>
                            @endif

                            @if (Roles::Check('13'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('reviews.index', ['role_id' => encrypt('13')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['reviews.index', ['role_id' => encrypt('13')]]) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Product Reviews') }}</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if (Roles::Check('301'))
                    <li class="aiz-side-nav-item">
                        <a href="#" class="aiz-side-nav-link">
                            <i class="las la-shopping-cart aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{ translate('Attribute') }}</span>
                            <span class="aiz-side-nav-arrow"></span>
                        </a>
                        <!--Submenu-->
                        <ul class="aiz-side-nav-list level-2">
                            @if (Roles::Check('301'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('attributes.index', ['role_id' => encrypt('301')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['attributes.index', ['role_id' => encrypt('301')], 'attributes.create', ['role_id' => encrypt('301')], 'attributes.edit', ['role_id' => encrypt('301')]]) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Attribute') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (Roles::Check('305'))
                                <li class="aiz-side-nav-item">
                                    <a class="aiz-side-nav-link {{ areActiveRoutes(['attribute_values.index', ['role_id' => encrypt('305')]]) }}"
                                        href="{{ route('attribute_values.index', ['role_id' => encrypt('305')]) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Attribute values') }}</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                <!-- Sale -->
                @if (Roles::Check('20'))
                    <li class="aiz-side-nav-item">
                        <a href="#" class="aiz-side-nav-link">
                            <i class="las la-money-bill aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{ translate('Sales') }}</span>
                            <span class="aiz-side-nav-arrow"></span>
                        </a>
                        <!--Submenu-->
                        <ul class="aiz-side-nav-list level-2">
                            @if (Roles::Check('21'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('NewerOrders.index', ['role_id' => encrypt('21')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['NewerOrders.index', ['role_id' => encrypt('21')], 'NewerOrders.index', ['role_id' => encrypt('21')]]) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Orders') }}</span>
                                    </a>
                                </li>
                            @endif
                            {{-- @if (Auth::user()->user_type == 'admin' || in_array('3', json_decode(Auth::user()->staff->role->permissions)))
                            <li class="aiz-side-nav-item">
                                <a href="{{ route('all_orders.index') }}" class="aiz-side-nav-link {{ areActiveRoutes(['all_orders.index', 'all_orders.show'])}}">
                                    <span class="aiz-side-nav-text">{{translate('All Orders')}}</span>
                                </a>
                            </li>
                        @endif --}}

                            {{-- @if (Auth::user()->user_type == 'admin' || in_array('4', json_decode(Auth::user()->staff->role->permissions))) --}}
                            @if (Roles::Check('22'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('inhouse_orders.index', ['role_id' => encrypt('22')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['inhouse_orders.index', ['role_id' => encrypt('22')], 'inhouse_orders.show', ['role_id' => encrypt('22')]]) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Inhouse orders') }}</span>
                                    </a>
                                </li>
                            @endif
                            {{-- @endif --}}
                            {{-- @if (Auth::user()->user_type == 'admin' || in_array('5', json_decode(Auth::user()->staff->role->permissions))) --}}
                            @if (\App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
                                @if (Roles::Check('23'))
                                    <li class="aiz-side-nav-item">
                                        <a href="{{ route('seller_orders.index', ['role_id' => encrypt('23')]) }}"
                                            class="aiz-side-nav-link {{ areActiveRoutes(['seller_orders.index', ['role_id' => encrypt('23')], 'seller_orders.show', ['role_id' => encrypt('23')]]) }}">
                                            <span class="aiz-side-nav-text">{{ translate('Seller Orders') }}</span>
                                        </a>
                                    </li>
                                @endif
                            @endif
                            {{-- @endif --}}
                            {{-- @if (Auth::user()->user_type == 'admin' || in_array('6', json_decode(Auth::user()->staff->role->permissions)))
                            <li class="aiz-side-nav-item">
                                <a href="{{ route('pick_up_point.order_index') }}" class="aiz-side-nav-link {{ areActiveRoutes(['pick_up_point.order_index','pick_up_point.order_show'])}}">
                                    <span class="aiz-side-nav-text">{{translate('Pick-up Point Order')}}</span>
                                </a>
                            </li>
                        @endif --}}

                            @if (Roles::Check('24'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('ordersLog.index', ['role_id' => encrypt('24')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['ordersLog.index', ['role_id' => encrypt('24')]]) }}">
                                        <span class="aiz-side-nav-text">{{ translate('log orders') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (Roles::Check('25'))
                                @php
                                    $refund_requests = DB::table('refund_requests')
                                        ->where('viewed', 0)
                                        ->select('id')
                                        ->count();
                                @endphp
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('refund_request.index', ['role_id' => encrypt('25')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['support_ticket.admin_index', ['role_id' => encrypt('25')], 'refund_request.index']) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Refund Requests') }}</span>
                                        @if ($refund_requests > 0)
                                            <span class="badge badge-info">{{ $refund_requests }}</span>
                                        @endif
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                <!-- Refund addon -->
                {{-- @if (\App\Addon::where('unique_identifier', 'refund_request')->first() != null && \App\Addon::where('unique_identifier', 'refund_request')->first()->activated)
                    @if (Auth::user()->user_type == 'admin' || in_array('7', json_decode(Auth::user()->staff->role->permissions)))
                      <li class="aiz-side-nav-item">
                          <a href="#" class="aiz-side-nav-link">
                              <i class="las la-backward aiz-side-nav-icon"></i>
                              <span class="aiz-side-nav-text">{{ translate('Refunds') }}</span>
                              @if (env('DEMO_MODE') == 'On')
                                <span class="badge badge-inline badge-danger">Addon</span>
                                @endif
                              <span class="aiz-side-nav-arrow"></span>
                          </a>
                          <ul class="aiz-side-nav-list level-2">
                              <li class="aiz-side-nav-item">
                                  <a href="{{route('refund_requests_all')}}" class="aiz-side-nav-link {{ areActiveRoutes(['refund_requests_all', 'reason_show'])}}">
                                      <span class="aiz-side-nav-text">{{translate('Refund Requests')}}</span>
                                  </a>
                              </li>
                              <li class="aiz-side-nav-item">
                                  <a href="{{route('paid_refund')}}" class="aiz-side-nav-link">
                                      <span class="aiz-side-nav-text">{{translate('Approved Refunds')}}</span>
                                  </a>
                              </li>
                              <li class="aiz-side-nav-item">
                                  <a href="{{route('rejected_refund')}}" class="aiz-side-nav-link">
                                      <span class="aiz-side-nav-text">{{translate('rejected Refunds')}}</span>
                                  </a>
                              </li>
                              <li class="aiz-side-nav-item">
                                  <a href="{{route('refund_time_config')}}" class="aiz-side-nav-link">
                                      <span class="aiz-side-nav-text">{{translate('Refund Configuration')}}</span>
                                  </a>
                              </li>
                          </ul>
                      </li>
                    @endif
                @endif --}}


                <!-- Customers -->
                @if (Roles::Check('40'))
                    <li class="aiz-side-nav-item">
                        <a href="#" class="aiz-side-nav-link">
                            <i class="las la-user-friends aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{ translate('Customers') }}</span>
                            <span class="aiz-side-nav-arrow"></span>
                        </a>
                        <ul class="aiz-side-nav-list level-2">
                            @if (Roles::Check('41'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('customers.indexjs', ['role_id' => encrypt('41')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['customers.indexjs', ['role_id' => encrypt('41')]]) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Customers') }}</span>
                                    </a>
                                </li>
                            @endif
                            {{-- @if (Roles::Check('42'))
                            <li class="aiz-side-nav-item">
                                <a href="{{ route('customers.index',["role_id"=>encrypt("42")]) }}" class="aiz-side-nav-link {{ areActiveRoutes(['customers.index',["role_id"=>encrypt("42")]])}}">
                                    <span class="aiz-side-nav-text">{{ translate('Customer list') }}</span>
                                </a>
                            </li>
                            @endif --}}
                            @if (\App\BusinessSetting::where('type', 'classified_product')->first()->value == 1)
                                @if (Roles::Check('43'))
                                    <li class="aiz-side-nav-item">
                                        <a href="{{ route('classified_products', ['role_id' => encrypt('43')]) }}"
                                            class="aiz-side-nav-link {{ areActiveRoutes(['classified_products', ['role_id' => encrypt('43')]]) }}">
                                            <span
                                                class="aiz-side-nav-text">{{ translate('Classified Products') }}</span>
                                        </a>
                                    </li>
                                @endif
                                @if (Roles::Check('44'))
                                    <li class="aiz-side-nav-item">
                                        <a href="{{ route('customer_packages.index', ['role_id' => encrypt('44')]) }}"
                                            class="aiz-side-nav-link {{ areActiveRoutes(['customer_packages.index', 'customer_packages.create', 'customer_packages.edit']) }}">
                                            <span
                                                class="aiz-side-nav-text">{{ translate('Classified Packages') }}</span>
                                        </a>
                                    </li>
                                @endif
                            @endif
                        </ul>
                    </li>
                @endif

                <!-- Sellers -->
                {{-- @if ((Auth::user()->user_type == 'admin' || in_array('9', json_decode(Auth::user()->staff->role->permissions))) && \App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1) --}}
                @if (Roles::Check('60'))
                    @if (\App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)

                        <li class="aiz-side-nav-item">
                            <a href="#" class="aiz-side-nav-link">
                                <i class="las la-user aiz-side-nav-icon"></i>
                                <span class="aiz-side-nav-text">{{ translate('Sellers') }}</span>
                                <span class="aiz-side-nav-arrow"></span>
                            </a>
                            <ul class="aiz-side-nav-list level-2">
                                @if (Roles::Check('61'))
                                    <li class="aiz-side-nav-item">
                                        <a href="{{ route('sellers.indexjs', ['role_id' => encrypt('61')]) }}"
                                            class="aiz-side-nav-link {{ areActiveRoutes(['sellers.indexjs', ['role_id' => encrypt('61')]]) }}">
                                            <span class="aiz-side-nav-text">{{ translate('Sellers') }}</span>
                                        </a>
                                    </li>
                                @endif
                                @if (Roles::Check('62'))
                                    <li class="aiz-side-nav-item">
                                        @php
                                            $sellers = \App\Seller::where('verification_status', 0)
                                                ->where('verification_info', '!=', null)
                                                ->count();
                                        @endphp
                                        <a href="{{ route('sellers.index', ['role_id' => encrypt('62')]) }}"
                                            class="aiz-side-nav-link {{ areActiveRoutes(['sellers.index', ['role_id' => encrypt('62')], 'sellers.create', 'sellers.edit', 'sellers.payment_history', 'sellers.approved', 'sellers.profile_modal', 'sellers.show_verification_request']) }}">
                                            <span class="aiz-side-nav-text">{{ translate('All Seller') }}</span>
                                            @if ($sellers > 0)
                                                <span class="badge badge-info">{{ $sellers }}</span>
                                            @endif
                                        </a>
                                    </li>
                                @endif
                                @if (Roles::Check('63'))
                                    <li class="aiz-side-nav-item">
                                        <a href="{{ route('sellers.payment_histories', ['role_id' => encrypt('63')]) }}"
                                            class="aiz-side-nav-link {{ areActiveRoutes(['sellers.payment_histories', ['role_id' => encrypt('63')]]) }}">
                                            <span class="aiz-side-nav-text">{{ translate('Payouts') }}</span>
                                        </a>
                                    </li>
                                @endif
                                @if (Roles::Check('64'))
                                    <li class="aiz-side-nav-item">
                                        <a href="{{ route('withdraw_requests_all', ['role_id' => encrypt('64')]) }}"
                                            class="aiz-side-nav-link {{ areActiveRoutes(['withdraw_requests_all', ['role_id' => encrypt('64')]]) }}">
                                            <span
                                                class="aiz-side-nav-text">{{ translate('Payout Requests') }}</span>
                                        </a>
                                    </li>
                                @endif
                                @if (Roles::Check('65'))
                                    <li class="aiz-side-nav-item">
                                        <a href="{{ route('business_settings.vendor_commission', ['role_id' => encrypt('65')]) }}"
                                            class="aiz-side-nav-link {{ areActiveRoutes(['business_settings.vendor_commission', ['role_id' => encrypt('65')]]) }}">
                                            <span
                                                class="aiz-side-nav-text">{{ translate('Seller Commission') }}</span>
                                        </a>
                                    </li>
                                @endif

                                {{-- @if (\App\Addon::where('unique_identifier', 'seller_subscription')->first() != null && \App\Addon::where('unique_identifier', 'seller_subscription')->first()->activated)
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('seller_packages.index') }}" class="aiz-side-nav-link {{ areActiveRoutes(['seller_packages.index', 'seller_packages.create', 'seller_packages.edit'])}}">
                                        <span class="aiz-side-nav-text">{{ translate('Seller Packages') }}</span>
                                      @if (env('DEMO_MODE') == 'On')
                                        <span class="badge badge-inline badge-danger">Addon</span>
                                        @endif
                                    </a>
                                </li>
                            @endif --}}
                                @if (Roles::Check('66'))
                                    <li class="aiz-side-nav-item">
                                        <a href="{{ route('seller_verification_form.index', ['role_id' => encrypt('66')]) }}"
                                            class="aiz-side-nav-link {{ areActiveRoutes(['seller_verification_form.index', ['role_id' => encrypt('66')]]) }}">
                                            <span
                                                class="aiz-side-nav-text">{{ translate('Seller Verification Form') }}</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif
                @endif

                @if (Roles::Check('80'))
                    <li class="aiz-side-nav-item">
                        <a href="{{ route('uploaded-files.index', ['role_id' => encrypt('80')]) }}"
                            class="aiz-side-nav-link {{ areActiveRoutes(['uploaded-files.create', ['role_id' => encrypt('80')]]) }}">
                            <i class="las la-folder-open aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{ translate('Uploaded Files') }}</span>
                        </a>
                    </li>
                @endif




                <!-- Reports -->
                @if (Roles::Check('100'))
                    <li class="aiz-side-nav-item">
                        <a href="#" class="aiz-side-nav-link">
                            <i class="las la-file-alt aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{ translate('Reports') }}</span>
                            <span class="aiz-side-nav-arrow"></span>
                        </a>
                        <ul class="aiz-side-nav-list level-2">
                            @if (Roles::Check('101'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('main.reports', ['role_id' => encrypt('101')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['main.reports', ['role_id' => encrypt('101')]]) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Main Reports') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (Roles::Check('102'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('in_house_sale_report.index', ['role_id' => encrypt('102')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['in_house_sale_report.index', ['role_id' => encrypt('102')]]) }}">
                                        <span
                                            class="aiz-side-nav-text">{{ translate('In House Product Sale') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (Roles::Check('103'))
                                @if (\App\BusinessSetting::where('type', 'vendor_system_activation')->first()->value == 1)
                                    <li class="aiz-side-nav-item">
                                        <a href="{{ route('seller_sale_report.index', ['role_id' => encrypt('103')]) }}"
                                            class="aiz-side-nav-link {{ areActiveRoutes(['seller_sale_report.index', ['role_id' => encrypt('103')]]) }}">
                                            <span
                                                class="aiz-side-nav-text">{{ translate('Seller Products Sale') }}</span>
                                        </a>
                                    </li>
                                @endif
                            @endif
                            @if (Roles::Check('104'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('stock_report.index', ['role_id' => encrypt('104')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['stock_report.index', ['role_id' => encrypt('104')]]) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Products Stock') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (Roles::Check('105'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('wish_report.index', ['role_id' => encrypt('105')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['wish_report.index', ['role_id' => encrypt('105')]]) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Products wishlist') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (Roles::Check('106'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('user_search_report.index', ['role_id' => encrypt('106')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['user_search_report.index', ['role_id' => encrypt('106')]]) }}">
                                        <span class="aiz-side-nav-text">{{ translate('User Searches') }}</span>
                                    </a>
                                </li>
                            @endif
                            {{-- @if (Roles::Check('107'))
                            <li class="aiz-side-nav-item">
                                <a href="{{ route('commission-log.index',["role_id"=>encrypt("107")]) }}" class="aiz-side-nav-link {{ areActiveRoutes(['commission-log.index',["role_id"=>encrypt("107")]])}}">
                                    <span class="aiz-side-nav-text">{{ translate('Commission History') }}</span>
                                </a>
                            </li>
                            @endif --}}
                            @if (Roles::Check('108'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('wallet-history.index', ['role_id' => encrypt('108')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['wallet-history.index', ['role_id' => encrypt('108')]]) }}">
                                        <span
                                            class="aiz-side-nav-text">{{ translate('Wallet Recharge History') }}</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                <!--Blog System-->
                @if (Roles::Check('120'))
                    <li class="aiz-side-nav-item">
                        <a href="#" class="aiz-side-nav-link">
                            <i class="las la-bullhorn aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{ translate('Blog System') }}</span>
                            <span class="aiz-side-nav-arrow"></span>
                        </a>
                        <ul class="aiz-side-nav-list level-2">
                            @if (Roles::Check('120'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('blog.index', ['role_id' => encrypt('120')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['blog.index', ['role_id' => encrypt('120')], 'blog.create', 'blog.edit']) }}">
                                        <span class="aiz-side-nav-text">{{ translate('All Posts') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (Roles::Check('121'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('blog-category.index', ['role_id' => encrypt('121')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['blog-category.index', ['role_id' => encrypt('121')], 'blog-category.create', 'blog-category.edit']) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Categories') }}</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                <!-- marketing -->
                @if (Roles::Check('140'))
                    <li class="aiz-side-nav-item">
                        <a href="#" class="aiz-side-nav-link">
                            <i class="las la-bullhorn aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{ translate('Marketing') }}</span>
                            <span class="aiz-side-nav-arrow"></span>
                        </a>
                        <ul class="aiz-side-nav-list level-2">
                            @if (Roles::Check('321'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('flash_deals.index', ['role_id' => encrypt('321')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['flash_deals.index', ['role_id' => encrypt('321')], 'flash_deals.create', 'flash_deals.edit']) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Flash deals') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (Roles::Check('142'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('newsletters.index', ['role_id' => encrypt('142')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['newsletters.index', ['role_id' => encrypt('142')]]) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Newsletters') }}</span>
                                    </a>
                                </li>
                                {{-- @if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated)
                                    <li class="aiz-side-nav-item">
                                        <a href="{{route('sms.index')}}" class="aiz-side-nav-link">
                                            <span class="aiz-side-nav-text">{{ translate('Bulk SMS') }}</span>
                                            @if (env('DEMO_MODE') == 'On')
                                            <span class="badge badge-inline badge-danger">Addon</span>
                                            @endif
                                        </a>
                                    </li>
                                @endif --}}
                            @endif
                            @if (Roles::Check('143'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('subscribers.index', ['role_id' => encrypt('143')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['subscribers.index', ['role_id' => encrypt('143')]]) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Subscribers') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (Roles::Check('144'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('coupon.index', ['role_id' => encrypt('144')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['coupon.index', ['role_id' => encrypt('144')], 'coupon.create', 'coupon.edit']) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Coupon') }}</span>
                                    </a>
                                </li>
                            @endif


                            @if (Roles::Check('145'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('abandoned_baskets.index', ['role_id' => encrypt('145')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['abandoned_baskets.index', ['role_id' => encrypt('145')]]) }}">
                                        {{-- <i class="las la-shopping-bag aiz-side-nav-icon"></i> --}}
                                        <span class="aiz-side-nav-text">{{ translate('Abandoned baskets') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (Roles::Check('146'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('special_offers.index', ['role_id' => encrypt('146')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['special_offers.index', ['role_id' => encrypt('146')]]) }}">
                                        {{-- <i class="las la-shopping-bag aiz-side-nav-icon"></i> --}}
                                        <span class="aiz-side-nav-text">{{ translate('Special Offers') }}</span>
                                    </a>
                                </li>
                            @endif


                        </ul>
                    </li>
                @endif

                <!-- Support -->
                @php

                    $conversation_count = \App\Conversation::where('receiver_id', Auth::user()->id)
                        ->where('receiver_viewed', '0')
                        ->count();
                    $support_ticket = DB::table('refund_requests')
                        ->where('viewed', 0)
                        ->select('id')
                        ->count();
                    $calc_counts = $conversation_count + $support_ticket;
                @endphp
                @if (Roles::Check('160'))
                    <li class="aiz-side-nav-item">
                        <a href="#" class="aiz-side-nav-link">
                            <i class="las la-link aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{ translate('Support') }}</span>
                            @if ($calc_counts > 0)
                                <span class="badge badge-info">{{ $calc_counts }}</span>
                            @endif
                            <span class="aiz-side-nav-arrow"></span>
                        </a>
                        <ul class="aiz-side-nav-list level-2">
                            @if (Roles::Check('161'))

                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('support_ticket.admin_index', ['role_id' => encrypt('161')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['support_ticket.admin_index', ['role_id' => encrypt('161')], 'support_ticket.admin_show']) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Ticket') }}</span>
                                        @if ($support_ticket > 0)
                                            <span class="badge badge-info">{{ $support_ticket }}</span>
                                        @endif
                                    </a>
                                </li>
                            @endif


                            @if (Roles::Check('162'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('conversations.admin_index', ['role_id' => encrypt('162')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['conversations.admin_index', ['role_id' => encrypt('162')], 'conversations.admin_show']) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Product Queries') }}</span>
                                        @if ($conversation_count > 0)
                                            <span class="badge badge-info">{{ $conversation_count }}</span>
                                        @endif
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                <!-- Affiliate Addon -->
                {{-- @if (\App\Addon::where('unique_identifier', 'affiliate_system')->first() != null && \App\Addon::where('unique_identifier', 'affiliate_system')->first()->activated)
                    @if (Auth::user()->user_type == 'admin' || in_array('15', json_decode(Auth::user()->staff->role->permissions)))
                      <li class="aiz-side-nav-item">
                          <a href="#" class="aiz-side-nav-link">
                              <i class="las la-link aiz-side-nav-icon"></i>
                              <span class="aiz-side-nav-text">{{translate('Affiliate System')}}</span>
                                @if (env('DEMO_MODE') == 'On')
                                <span class="badge badge-inline badge-danger">Addon</span>
                                @endif
                              <span class="aiz-side-nav-arrow"></span>
                          </a>
                          <ul class="aiz-side-nav-list level-2">
                              <li class="aiz-side-nav-item">
                                  <a href="{{route('affiliate.configs')}}" class="aiz-side-nav-link">
                                      <span class="aiz-side-nav-text">{{translate('Affiliate Registration Form')}}</span>
                                  </a>
                              </li>
                              <li class="aiz-side-nav-item">
                                  <a href="{{route('affiliate.index')}}" class="aiz-side-nav-link">
                                      <span class="aiz-side-nav-text">{{translate('Affiliate Configurations')}}</span>
                                  </a>
                              </li>
                              <li class="aiz-side-nav-item">
                                  <a href="{{route('affiliate.users')}}" class="aiz-side-nav-link {{ areActiveRoutes(['affiliate.users', 'affiliate_users.show_verification_request', 'affiliate_user.payment_history'])}}">
                                      <span class="aiz-side-nav-text">{{translate('Affiliate Users')}}</span>
                                  </a>
                              </li>
                              <li class="aiz-side-nav-item">
                                  <a href="{{route('refferals.users')}}" class="aiz-side-nav-link">
                                      <span class="aiz-side-nav-text">{{translate('Referral Users')}}</span>
                                  </a>
                              </li>
                              <li class="aiz-side-nav-item">
                                  <a href="{{route('affiliate.withdraw_requests')}}" class="aiz-side-nav-link">
                                      <span class="aiz-side-nav-text">{{translate('Affiliate Withdraw Requests')}}</span>
                                  </a>
                              </li>
                              <li class="aiz-side-nav-item">
                                  <a href="{{route('affiliate.logs.admin')}}" class="aiz-side-nav-link">
                                      <span class="aiz-side-nav-text">{{translate('Affiliate Logs')}}</span>
                                  </a>
                              </li>
                          </ul>
                      </li>
                    @endif
                @endif --}}

                <!-- Offline Payment Addon-->
                {{-- @if (\App\Addon::where('unique_identifier', 'offline_payment')->first() != null && \App\Addon::where('unique_identifier', 'offline_payment')->first()->activated)
                    @if (Auth::user()->user_type == 'admin' || in_array('16', json_decode(Auth::user()->staff->role->permissions)))
                      <li class="aiz-side-nav-item">
                          <a href="#" class="aiz-side-nav-link">
                              <i class="las la-money-check-alt aiz-side-nav-icon"></i>
                              <span class="aiz-side-nav-text">{{translate('Offline Payment System')}}</span>
                                @if (env('DEMO_MODE') == 'On')
                                <span class="badge badge-inline badge-danger">Addon</span>
                                @endif
                              <span class="aiz-side-nav-arrow"></span>
                          </a>
                          <ul class="aiz-side-nav-list level-2">
                              <li class="aiz-side-nav-item">
                                  <a href="{{ route('manual_payment_methods.index') }}" class="aiz-side-nav-link {{ areActiveRoutes(['manual_payment_methods.index', 'manual_payment_methods.create', 'manual_payment_methods.edit'])}}">
                                      <span class="aiz-side-nav-text">{{translate('Manual Payment Methods')}}</span>
                                  </a>
                              </li>
                              <li class="aiz-side-nav-item">
                                  <a href="{{ route('offline_wallet_recharge_request.index') }}" class="aiz-side-nav-link">
                                      <span class="aiz-side-nav-text">{{translate('Offline Wallet Recharge')}}</span>
                                  </a>
                              </li>
                              @if (\App\BusinessSetting::where('type', 'classified_product')->first()->value == 1)
                                  <li class="aiz-side-nav-item">
                                      <a href="{{ route('offline_customer_package_payment_request.index') }}" class="aiz-side-nav-link">
                                          <span class="aiz-side-nav-text">{{translate('Offline Customer Package Payments')}}</span>
                                      </a>
                                  </li>
                              @endif
                              @if (\App\Addon::where('unique_identifier', 'seller_subscription')->first() != null && \App\Addon::where('unique_identifier', 'seller_subscription')->first()->activated)
                                  <li class="aiz-side-nav-item">
                                      <a href="{{ route('offline_seller_package_payment_request.index') }}" class="aiz-side-nav-link">
                                          <span class="aiz-side-nav-text">{{translate('Offline Seller Package Payments')}}</span>
                                            @if (env('DEMO_MODE') == 'On')
                                            <span class="badge badge-inline badge-danger">Addon</span>
                                            @endif
                                      </a>
                                  </li>
                              @endif
                          </ul>
                      </li>
                    @endif
                @endif --}}

                <!-- Paytm Addon -->
                {{-- @if (\App\Addon::where('unique_identifier', 'paytm')->first() != null && \App\Addon::where('unique_identifier', 'paytm')->first()->activated)
                    @if (Auth::user()->user_type == 'admin' || in_array('17', json_decode(Auth::user()->staff->role->permissions)))
                      <li class="aiz-side-nav-item">
                          <a href="#" class="aiz-side-nav-link">
                              <i class="las la-mobile-alt aiz-side-nav-icon"></i>
                              <span class="aiz-side-nav-text">{{translate('Paytm Payment Gateway')}}</span>
                                @if (env('DEMO_MODE') == 'On')
                                <span class="badge badge-inline badge-danger">Addon</span>
                                @endif
                              <span class="aiz-side-nav-arrow"></span>
                          </a>
                          <ul class="aiz-side-nav-list level-2">
                              <li class="aiz-side-nav-item">
                                  <a href="{{ route('paytm.index') }}" class="aiz-side-nav-link">
                                      <span class="aiz-side-nav-text">{{translate('Set Paytm Credentials')}}</span>
                                  </a>
                              </li>
                          </ul>
                      </li>
                    @endif
                @endif --}}

                <!-- Club Point Addon-->
                {{-- @if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated)
                  @if (Auth::user()->user_type == 'admin' || in_array('18', json_decode(Auth::user()->staff->role->permissions)))
                    <li class="aiz-side-nav-item">
                        <a href="#" class="aiz-side-nav-link">
                            <i class="lab la-btc aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{translate('Club Point System')}}</span>
                            @if (env('DEMO_MODE') == 'On')
                            <span class="badge badge-inline badge-danger">Addon</span>
                            @endif
                            <span class="aiz-side-nav-arrow"></span>
                        </a>
                        <ul class="aiz-side-nav-list level-2">
                            <li class="aiz-side-nav-item">
                                <a href="{{ route('club_points.configs') }}" class="aiz-side-nav-link">
                                    <span class="aiz-side-nav-text">{{translate('Club Point Configurations')}}</span>
                                </a>
                            </li>
                            <li class="aiz-side-nav-item">
                                <a href="{{route('set_product_points')}}" class="aiz-side-nav-link {{ areActiveRoutes(['set_product_points', 'product_club_point.edit'])}}">
                                    <span class="aiz-side-nav-text">{{translate('Set Product Point')}}</span>
                                </a>
                            </li>
                            <li class="aiz-side-nav-item">
                                <a href="{{route('club_points.index')}}" class="aiz-side-nav-link {{ areActiveRoutes(['club_points.index', 'club_point.details'])}}">
                                    <span class="aiz-side-nav-text">{{translate('User Points')}}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                  @endif
                @endif --}}

                <!--OTP addon -->
                {{-- @if (\App\Addon::where('unique_identifier', 'otp_system')->first() != null && \App\Addon::where('unique_identifier', 'otp_system')->first()->activated)
                  @if (Auth::user()->user_type == 'admin' || in_array('19', json_decode(Auth::user()->staff->role->permissions)))
                      <li class="aiz-side-nav-item">
                        <a href="#" class="aiz-side-nav-link">
                            <i class="las la-phone aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{translate('OTP System')}}</span>
                            @if (env('DEMO_MODE') == 'On')
                            <span class="badge badge-inline badge-danger">Addon</span>
                            @endif
                            <span class="aiz-side-nav-arrow"></span>
                        </a>
                        <ul class="aiz-side-nav-list level-2">
                            <li class="aiz-side-nav-item">
                                <a href="{{ route('otp.configconfiguration') }}" class="aiz-side-nav-link">
                                    <span class="aiz-side-nav-text">{{translate('OTP Configurations')}}</span>
                                </a>
                            </li>
                            <li class="aiz-side-nav-item">
                                <a href="{{route('otp_credentials.index')}}" class="aiz-side-nav-link">
                                    <span class="aiz-side-nav-text">{{translate('Set OTP Credentials')}}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                  @endif
                @endif --}}

                {{-- @if (\App\Addon::where('unique_identifier', 'african_pg')->first() != null && \App\Addon::where('unique_identifier', 'african_pg')->first()->activated)
                  @if (Auth::user()->user_type == 'admin' || in_array('19', json_decode(Auth::user()->staff->role->permissions)))
                      <li class="aiz-side-nav-item">
                        <a href="#" class="aiz-side-nav-link">
                            <i class="las la-phone aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{translate('African Payment Gateway Addon')}}</span>
                            @if (env('DEMO_MODE') == 'On')
                            <span class="badge badge-inline badge-danger">Addon</span>
                            @endif
                            <span class="aiz-side-nav-arrow"></span>
                        </a>
                        <ul class="aiz-side-nav-list level-2">
                            <li class="aiz-side-nav-item">
                                <a href="{{ route('african.configuration') }}" class="aiz-side-nav-link">
                                    <span class="aiz-side-nav-text">{{translate('African PG Configurations')}}</span>
                                </a>
                            </li>
                            <li class="aiz-side-nav-item">
                                <a href="{{route('african_credentials.index')}}" class="aiz-side-nav-link">
                                    <span class="aiz-side-nav-text">{{translate('Set African PG Credentials')}}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                  @endif
                @endif --}}

                <!-- Website Setup -->
                @if (Roles::Check('180'))
                    <li class="aiz-side-nav-item">
                        <a href="#" class="aiz-side-nav-link">
                            <i class="las la-desktop aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{ translate('Website Setup') }}</span>
                            <span class="aiz-side-nav-arrow"></span>
                        </a>
                        <ul class="aiz-side-nav-list level-2">
                            @if (Roles::Check('181'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('website.header', ['role_id' => encrypt('181')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['website.header', ['role_id' => encrypt('181')]]) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Header') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (Roles::Check('182'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('website.footer', ['role_id' => encrypt('182')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['website.footer', ['role_id' => encrypt('182')]]) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Footer') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (Roles::Check('183'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('website.pages', ['role_id' => encrypt('183')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['website.pages', ['role_id' => encrypt('183')], 'custom-pages.create', 'custom-pages.edit']) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Pages') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (Roles::Check('184'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('website.appearance', ['role_id' => encrypt('184')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['website.appearance', ['role_id' => encrypt('184')]]) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Appearance') }}</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                <!-- Setup & Configurations -->
                @if (Roles::Check('200'))
                    <li class="aiz-side-nav-item">
                        <a href="#" class="aiz-side-nav-link">
                            <i class="las la-dharmachakra aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{ translate('Setup & Configurations') }}</span>
                            <span class="aiz-side-nav-arrow"></span>
                        </a>
                        <ul class="aiz-side-nav-list level-2">
                            @if (Roles::Check('201'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('general_setting.index', ['role_id' => encrypt('201')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['general_setting.index', ['role_id' => encrypt('201')]]) }}">
                                        <span class="aiz-side-nav-text">{{ translate('General Settings') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (Roles::Check('202'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('activation.index', ['role_id' => encrypt('202')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['activation.index', ['role_id' => encrypt('202')]]) }}">
                                        <span
                                            class="aiz-side-nav-text">{{ translate('Features activation') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (Roles::Check('217'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('order.setting', ['role_id' => encrypt('217')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['order.setting', ['role_id' => encrypt('217')]]) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Order Setting') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (Roles::Check('15'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('product.setting', ['role_id' => encrypt('15')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['product.setting', ['role_id' => encrypt('15')]]) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Product Setting') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (Roles::Check('203'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('languages.index', ['role_id' => encrypt('203')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['languages.index', ['role_id' => encrypt('203')], 'languages.create', 'languages.store', 'languages.show', 'languages.edit']) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Languages') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (Roles::Check('204'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('currency.index', ['role_id' => encrypt('204')]) }}"
                                        class="aiz-side-nav-link{{ areActiveRoutes(['currency.index', ['role_id' => encrypt('204')]]) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Currency') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (Roles::Check('205'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('tax.index', ['role_id' => encrypt('205')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['tax.index', ['role_id' => encrypt('205')], 'tax.create', 'tax.store', 'tax.show', 'tax.edit']) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Vat & TAX') }}</span>
                                    </a>
                                </li>
                            @endif
                            {{-- <li class="aiz-side-nav-item">
                            <a href="{{route('pick_up_points.index')}}" class="aiz-side-nav-link {{ areActiveRoutes(['pick_up_points.index','pick_up_points.create','pick_up_points.edit'])}}">
                                <span class="aiz-side-nav-text">{{translate('Pickup point')}}</span>
                            </a>
                        </li> --}}
                            @if (Roles::Check('206'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('smtp_settings.index', ['role_id' => encrypt('206')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['smtp_settings.index', ['role_id' => encrypt('206')]]) }}">
                                        <span class="aiz-side-nav-text">{{ translate('SMTP Settings') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (Roles::Check('207'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('sms_settings.index', ['role_id' => encrypt('207')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['sms_settings.index', ['role_id' => encrypt('207')]]) }}">
                                        <span class="aiz-side-nav-text">{{ translate('SMS Settings') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (Roles::Check('208'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('firebase.index', ['role_id' => encrypt('208')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['firebase.index', ['role_id' => encrypt('208')]]) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Firebase Settings') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (Roles::Check('2016'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('pusher.index', ['role_id' => encrypt('216')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['pusher.index', ['role_id' => encrypt('216')]]) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Pusher Settings') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (Roles::Check('209'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('payment_method.index', ['role_id' => encrypt('209')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['firebase.index', ['role_id' => encrypt('209')]]) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Payment Methods') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (Roles::Check('210'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('file_system.index', ['role_id' => encrypt('210')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['file_system.index', ['role_id' => encrypt('210')]]) }}">
                                        <span
                                            class="aiz-side-nav-text">{{ translate('File System Configuration') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (Roles::Check('211'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('social_login.index', ['role_id' => encrypt('211')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['social_login.index', ['role_id' => encrypt('211')]]) }}">
                                        <span
                                            class="aiz-side-nav-text">{{ translate('Social media Logins') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (Roles::Check('212'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('google_analytics.index', ['role_id' => encrypt('212')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['google_analytics.index', ['role_id' => encrypt('212')]]) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Analytics Tools') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (Roles::Check('213'))
                                <li class="aiz-side-nav-item">
                                    <a href="javascript:void(0);" class="aiz-side-nav-link ">
                                        <span class="aiz-side-nav-text">{{ translate('Facebook') }}</span>
                                        <span class="aiz-side-nav-arrow"></span>
                                    </a>
                                    <ul class="aiz-side-nav-list level-3">
                                        <li class="aiz-side-nav-item">
                                            <a href="{{ route('facebook_chat.index', ['role_id' => encrypt('213')]) }}"
                                                class="aiz-side-nav-link {{ areActiveRoutes(['facebook_chat.index', ['role_id' => encrypt('213')]]) }}">
                                                <span
                                                    class="aiz-side-nav-text">{{ translate('Facebook Chat') }}</span>
                                            </a>
                                        </li>
                                        <li class="aiz-side-nav-item">
                                            <a href="{{ route('facebook-comment', ['role_id' => encrypt('213')]) }}"
                                                class="aiz-side-nav-link {{ areActiveRoutes(['facebook-comment.index', ['role_id' => encrypt('213')]]) }}">
                                                <span
                                                    class="aiz-side-nav-text">{{ translate('Facebook Comment') }}</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                            @if (Roles::Check('214'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('google_recaptcha.index', ['role_id' => encrypt('214')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['google_recaptcha.index', ['role_id' => encrypt('214')]]) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Google reCAPTCHA') }}</span>
                                    </a>
                                </li>
                            @endif
                            @if (Roles::Check('215'))
                                <li class="aiz-side-nav-item">
                                    <a href="javascript:void(0);" class="aiz-side-nav-link">
                                        <span class="aiz-side-nav-text">{{ translate('Shipping') }}</span>
                                        <span class="aiz-side-nav-arrow"></span>
                                    </a>
                                    <ul class="aiz-side-nav-list level-3">
                                        {{-- <li class="aiz-side-nav-item">
                                    <a href="{{route('shipping_configuration.index')}}" class="aiz-side-nav-link {{ areActiveRoutes(['shipping_configuration.index','shipping_configuration.edit','shipping_configuration.update'])}}">
                                        <span class="aiz-side-nav-text">{{translate('Shipping Configuration')}}</span>
                                    </a>
                                </li> --}}
                                        <li class="aiz-side-nav-item">
                                            <a href="{{ route('countries.index', ['role_id' => encrypt('215')]) }}"
                                                class="aiz-side-nav-link {{ areActiveRoutes(['countries.index', ['role_id' => encrypt('215')], 'countries.edit', 'countries.update']) }}">
                                                <span
                                                    class="aiz-side-nav-text">{{ translate('Shipping Countries') }}</span>
                                            </a>
                                        </li>
                                        <li class="aiz-side-nav-item">
                                            <a href="{{ route('governorates.index', ['role_id' => encrypt('215')]) }}"
                                                class="aiz-side-nav-link {{ areActiveRoutes(['governorates.index', ['role_id' => encrypt('215')]]) }}">
                                                <span
                                                    class="aiz-side-nav-text">{{ translate('Shipping Governorates') }}</span>
                                            </a>
                                        </li>
                                        <li class="aiz-side-nav-item">
                                            <a href="{{ route('localShipment.index', ['role_id' => encrypt('215')]) }}"
                                                class="aiz-side-nav-link {{ areActiveRoutes(['localShipment.index', ['role_id' => encrypt('215')]]) }}">
                                                <span
                                                    class="aiz-side-nav-text">{{ translate('Local Shipment') }}</span>
                                            </a>
                                        </li>
                                        <li class="aiz-side-nav-item">
                                            <a href="{{ route('cities.index', ['role_id' => encrypt('215')]) }}"
                                                class="aiz-side-nav-link {{ areActiveRoutes(['cities.index', ['role_id' => encrypt('215')], 'cities.edit', 'cities.update']) }}">
                                                <span
                                                    class="aiz-side-nav-text">{{ translate('Shipping Cities') }}</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif

                        </ul>
                    </li>
                @endif


                <!-- Staffs -->
                @if (Roles::Check('221'))
                    <li class="aiz-side-nav-item">
                        <a href="#" class="aiz-side-nav-link">
                            <i class="las la-user-tie aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{ translate('Staffs') }}</span>
                            <span class="aiz-side-nav-arrow"></span>
                        </a>
                        <ul class="aiz-side-nav-list level-2">
                            <li class="aiz-side-nav-item">
                                <a href="{{ route('staffs.index', ['role_id' => encrypt('221')]) }}"
                                    class="aiz-side-nav-link {{ areActiveRoutes(['staffs.index', ['role_id' => encrypt('221')], 'staffs.create', 'staffs.edit']) }}">
                                    <span class="aiz-side-nav-text">{{ translate('All staffs') }}</span>
                                </a>
                            </li>
                            @if (Roles::Check('222'))
                                <li class="aiz-side-nav-item">
                                    <a href="{{ route('roles.index', ['role_id' => encrypt('222')]) }}"
                                        class="aiz-side-nav-link {{ areActiveRoutes(['roles.index', ['role_id' => encrypt('222')], 'roles.create', 'roles.edit']) }}">
                                        <span class="aiz-side-nav-text">{{ translate('Staff permissions') }}</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif

                <li class="aiz-side-nav-item d-none">
                    <a href="#" class="aiz-side-nav-link">
                        <i class="las la-user-tie aiz-side-nav-icon"></i>
                        <span class="aiz-side-nav-text">{{ translate('System') }}</span>
                        <span class="aiz-side-nav-arrow"></span>
                    </a>
                    <ul class="aiz-side-nav-list level-2">
                        <li class="aiz-side-nav-item">
                            <a href="{{ route('system_update') }}" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text">{{ translate('Update') }}</span>
                            </a>
                        </li>
                        <li class="aiz-side-nav-item">
                            <a href="{{ route('system_server') }}" class="aiz-side-nav-link">
                                <span class="aiz-side-nav-text">{{ translate('Server status') }}</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Addon Manager -->
                @if (Auth::user()->user_type == 'admin')
                    <li class="aiz-side-nav-item ">
                        <a href="{{ route('addons.index') }}"
                            class="aiz-side-nav-link {{ areActiveRoutes(['addons.index', 'addons.create']) }}">
                            <i class="las la-wrench aiz-side-nav-icon"></i>
                            <span class="aiz-side-nav-text">{{ translate('Update System') }}</span>
                        </a>
                    </li>
                @endif
            </ul><!-- .aiz-side-nav -->
        </div><!-- .aiz-side-nav-wrap -->
    </div><!-- .aiz-sidebar -->
    <div class="aiz-sidebar-overlay"></div>
</div><!-- .aiz-sidebar -->
