<div class="category-menu3 bg-white  menu_mob_scroll  shadow-lg"
    style="overflow-y: auto;direction: {{ dir_lang() == 'rtl' ? 'ltr' : 'rtl' }}" id="category-sidebar">

    <ul class="list-unstyled categories   mb-0 text-left " style="max-height: 450px;direction: {{ dir_lang() }}">
        @foreach (\App\Category::where('level', 0)->orderBy('order_level', 'desc')->get()->take(11)
    as $key => $category)
            <li class="category-nav-element cat-menu3-hover border-bottom" data-id="{{ $category->id }}">
                <div class="d-flex" style="justify-content: space-between;align-items: center">
                    <a href="{{ route('products.category', $category->slug) }}"
                        class="text-truncate text-reset py-2 d-block">
                        <img class="cat-image lazyload mr-2 opacity-60"
                            src="{{ static_asset('assets/img/placeholder.jpg') }}"
                            data-src="{{ uploaded_asset($category->icon) }}" style="width:35px;height: 25px;"
                            alt="{{ $category->getTranslation('name') }}"
                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                        <span class="cat-name">{{ $category->getTranslation('name') }}</span>
                    </a>
                    @if (count(\App\Utility\CategoryUtility::get_immediate_children_ids($category->id)) > 0)
                        <div class=" mx-2 d-sm-block d-none">
                            <i style="font-size: 20px;font-weight: bold"
                                class="las la-angle-{{ dir_lang() == 'rtl' ? 'left' : 'right' }}"></i>
                        </div>
                    @endif

                </div>


                @if (count(\App\Utility\CategoryUtility::get_immediate_children_ids($category->id)) > 0)
                    @php
                        $lang = Session::get('locale', Config::get('app.locale'));
                    @endphp
                    <div style="width: 230px !important"
                        class=" sub-cat-menu3 {{ $lang == 'en' ? 'cat_sub_left' : 'cat_sub' }} display-none    c-scrollbar-light  shadow-lg ">


                        <div class="c-preloader text-center absolute-center">
                            <i class="las la-spinner la-spin la-3x opacity-70"></i>
                        </div>
                    </div>
                @endif
            </li>
        @endforeach
    </ul>
</div>
