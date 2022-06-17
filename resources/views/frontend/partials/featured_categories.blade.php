<section style="margin-block: 10px">
    <div class="container">
        <div class="px-2 py-2 bg-white shadow-sm rounded">

            <div class="d-flex mb-md-3 mb-sm-2 align-items-baseline border-bottom">
                <h3 class="h5 fw-700 mb-0">
                    <span
                        class="border-bottom border-primary border-width-2 pb-3 d-inline-block">{{ translate('departmental shopping') }}</span>
                </h3>
            </div>
            <div class="aiz-carousel gutters-10 half-outside-arrow" data-items="10" data-xl-items="8" data-lg-items="6"
                data-md-items="4" data-sm-items="2" data-xs-items="2" data-arrows='true' data-infinite='true'>
                @foreach ($featured_categories as $key => $category)
                    <div class="carousel-box">
                        <div class="aiz-card-box border border-light rounded hov-shadow-md my-2 has-transition">
                            <a href="{{ route('products.category', $category->slug) }}"
                                class="d-block rounded bg-white p-2 text-reset shadow">
                                <img src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                    data-src="{{ uploaded_asset($category->icon) }}"
                                    alt="{{ $category->getTranslation('name') }}" style="width:100%;height: 70px;"
                                    class="img-fluid lazyload"
                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder-rect.jpg') }}';">
                                <div class="text-truncate fs-12 fw-600 mt-2 opacity-70 text-center">
                                    {{ $category->getTranslation('name') }}</div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
