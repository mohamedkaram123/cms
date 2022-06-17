<div class="aiz-cat-sidenav-wrap position-relative z-1 shadow-sm">
    <div class="border-bottom ">

        <div class=" d-xl-none">
            @if (dir_lang() == 'rtl')
                <a class="" href="{{ route('home') }}">
                    @php
                        $header_logo = get_setting('header_logo');
                    @endphp
                    @if ($header_logo != null)
                        <img src="{{ uploaded_asset($header_logo) }}" alt="{{ env('APP_NAME') }}" height="40">
                    @else
                        <img src="{{ static_asset('assets/img/logos.png') }}" alt="{{ env('APP_NAME') }}"
                            height="40">
                    @endif
                </a>
                <button class="btn btn-sm p-2" data-toggle="class-toggle" data-target=".aiz-mobile-side-nav-cat"
                    data-same=".mobile-side-nav-thumb">
                    <i class="las la-times la-2x"></i>
                </button>
            @else
                <button class="btn btn-sm p-2" data-toggle="class-toggle" data-target=".aiz-mobile-side-nav-cat"
                    data-same=".mobile-side-nav-thumb">
                    <i class="las la-times la-2x"></i>
                </button>
                <a class="" href="{{ route('home') }}">
                    @php
                        $header_logo = get_setting('header_logo');
                    @endphp
                    @if ($header_logo != null)
                        <img src="{{ uploaded_asset($header_logo) }}" alt="{{ env('APP_NAME') }}" height="40">
                    @else
                        <img src="{{ static_asset('assets/img/logos.png') }}" alt="{{ env('APP_NAME') }}"
                            height="40">
                    @endif
                </a>

            @endif

        </div>
    </div>

    <div class="aiz-user-sidenav rounded overflow-hidden  c-scrollbar-light">

        <div class="sidemnenu">
            <ul class="list-unstyled categories no-scrollbar  text-left">
                {{-- <li class="category-nav-element pl-2" >
                         <h5>{{translate("main categories")}}</h5>
                      </li> --}}
                @foreach (\App\Category::where('level', 0)->orderBy('order_level', 'desc')->get()->take(11)
    as $key => $category)
                    <li class="category-nav-element border-bottom" data-id="{{ $category->id }}">
                        <a href="{{ count(\App\Utility\CategoryUtility::get_immediate_children_ids($category->id)) > 0? 'javascript:void(0)': route('products.category', $category->slug) }}"
                            class="text-truncate text-reset py-2 px-3 d-flex flex-row  {{ count(\App\Utility\CategoryUtility::get_immediate_children_ids($category->id)) > 0 ? 'sub_cat_nav' : null }}"
                            style="align-items: center;justify-content: space-between" data-cat_id={{ $category->id }}>
                            @if (dir_lang() == 'rtl')
                                <div class="text-right">
                                    @if (count(\App\Utility\CategoryUtility::get_immediate_children_ids($category->id)) > 0)
                                        <i class="las la-angle-left"></i>
                                    @endif
                                </div>

                                <div class="">
                                    <span class="cat-name"
                                        style="font-size:18px;font-weight: 400;color: rgb(82, 80, 80)">{{ $category->getTranslation('name') }}</span>
                                    <img class="cat-image lazyload mr-2 opacity-60"
                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                        data-src="{{ uploaded_asset($category->icon) }}" style="width:24px"
                                        alt="{{ $category->getTranslation('name') }}"
                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                </div>
                            @else
                                <div class="">
                                    <img class="cat-image lazyload mr-2 opacity-60"
                                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                        data-src="{{ uploaded_asset($category->icon) }}" style="width:24px"
                                        alt="{{ $category->getTranslation('name') }}"
                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                    <span class="cat-name"
                                        style="font-size:18px;font-weight: 400;color: rgb(82, 80, 80)">{{ $category->getTranslation('name') }}</span>
                                </div>

                                <div class="text-right ">
                                    @if (count(\App\Utility\CategoryUtility::get_immediate_children_ids($category->id)) > 0)
                                        <i class="las la-angle-right"></i>
                                    @endif
                                </div>
                            @endif

                        </a>
                        {{-- @if (count(\App\Utility\CategoryUtility::get_immediate_children_ids($category->id)) > 0)
                                <div class="sub-cat-menu c-scrollbar-light rounded shadow-lg p-4">
                                    <div class="c-preloader text-center absolute-center">
                                        <i class="las la-spinner la-spin la-3x opacity-70"></i>
                                    </div>
                                </div>
                            @endif --}}


                    </li>
                @endforeach
            </ul>
        </div>


    </div>
</div>
