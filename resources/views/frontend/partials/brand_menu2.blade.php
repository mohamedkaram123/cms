<div class="brand-menu3 bg-white menu_mob_scroll  shadow-lg"
    style="overflow-y: auto;direction: {{ dir_lang() == 'rtl' ? 'ltr' : 'rtl' }}" id="brand-sidebar">
    {{-- <div class="p-3 bg-soft-primary d-none d-lg-block  all-brand position-relative text-left">
        <span class="fw-600 fs-16 mr-3">{{ translate('Categories') }}</span>
        <a href="{{ route('categories.all') }}" class="text-reset">
            <span class="d-none d-lg-inline-block">{{ translate('See All') }} ></span>
        </a>
    </div> --}}
    <ul class="list-unstyled categories no-scrollbar  mb-0 text-left"
        style="max-height: 450px;direction: {{ dir_lang() }}">
        @foreach (\App\Brand::orderBy('top', 'desc')->get()->take(11)
    as $key => $brand)
            <li class="brand-nav-element cat-menu3-hover border-bottom" data-id="{{ $brand->id }}">
                <a href="{{ route('products.brand', $brand->slug) }}"
                    class="text-truncate text-reset py-2 px-3 d-block">
                    <img class="cat-image lazyload mr-2 opacity-60"
                        src="{{ static_asset('assets/img/placeholder.jpg') }}"
                        data-src="{{ uploaded_asset($brand->logo) }}" style="width:35px;height: 25px;"
                        alt="{{ $brand->getTranslation('name') }}"
                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                    <span class="cat-name">{{ $brand->getTranslation('name') }}</span>
                </a>

            </li>
        @endforeach
    </ul>
</div>
