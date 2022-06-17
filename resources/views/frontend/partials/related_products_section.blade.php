<section class="mb-md-4 mb-2">
    <div class="container">
        <div class="px-2 py-4 px-md-4 py-md-3 bg-white shadow-sm rounded">
            <div class="d-flex mb-3 align-items-baseline border-bottom">
                <h3 class="h5 fw-700 mb-0">
                    <span
                        class="border-bottom border-primary border-width-2 pb-3 d-inline-block">{{ translate('Related Products') }}</span>
                </h3>
            </div>

            <div class="aiz-carousel gutters-10 half-outside-arrow" data-items="4" data-xl-items="4" data-lg-items="4"
                data-md-items="4" data-sm-items="2" data-xs-items="2" data-arrows='true' data-infinite='true'>
                @foreach ($products_data as $key => $product)
                    @include('frontend.product_view')
                @endforeach
            </div>
        </div>
    </div>
</section>
