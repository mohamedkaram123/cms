@php
$home_base_price = home_base_price($product->id);

$home_discounted_base_price = home_discounted_base_price($product->id);

$refurbished_check = false;
if (!empty($product->refurbished)) {
    if ($product->refurbished == 1) {
        $product_Modal = \App\Product::find($product->id);
        $refurbished_check = true;
    }
} else {
    $product_Modal = \App\Product::find($product->id);
    $refurbished_check = true;
}

@endphp
<div class="col mb-3">
    <div class="aiz-card-box h-100 border border-light rounded shadow-sm shadow-md has-transition bg-white">
        <div class="position-relative">
            <a href="{{ route('product', $product->slug) }}" class="d-block">
                <img class="img-fit lazyload mx-auto h-140px h-md-210px"
                    src="{{ static_asset('assets/img/placeholder.jpg') }}"
                    data-src="{{ uploaded_asset($product->thumbnail_img) }}" {{-- alt="{{  $product->getTranslation('name')  }}" --}}
                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
            </a>
            {{-- <div class="absolute-top-right aiz-p-hov-icon">
                <a href="javascript:void(0)" onclick="addToWishList({{ $product->id }})" data-toggle="tooltip"
                    data-title="{{ translate('Add to wishlist') }}" data-placement="left">
                    <i class="la la-heart-o"></i>
                </a>
                <a href="javascript:void(0)" onclick="addToCompare({{ $product->id }})" data-toggle="tooltip"
                    data-title="{{ translate('Add to compare') }}" data-placement="left">
                    <i class="las la-sync"></i>
                </a>
                <a href="javascript:void(0)" onclick="showAddToCartModal({{ $product->id }})" data-toggle="tooltip"
                    data-title="{{ translate('Add to cart') }}" data-placement="left">
                    <i class="las la-shopping-cart"></i>
                </a>
            </div> --}}
            @if ($refurbished_check)
                @if (!empty($product_Modal->refurbished_product))
                    <img class="card-badge-refurbished-img"
                        src="{{ uploaded_asset($product_Modal->refurbished_product->degree->logo) }}"
                        alt="{{ $product_Modal->refurbished_product->degree->name }}" />
                    <div class="card-badge-refurbished-text">{{ translate('Refurbished') }}</div>
                @endif
            @endif


        </div>


        <div class="p-md-3 p-2 text-left" style="height: 200px">
            <div class="fs-15 d-flex flex-column">
                <div class="d-flex flex-md-row flex-column my-1" style="justify-content: space-between">
                    @if (!empty($product->brand))
                        <div class="brand">
                            <a href="{{ route('products.brand', $product->brand->slug) }}">
                                <img src="{{ uploaded_asset($product->brand->logo) }}"
                                    alt="{{ $product->brand->getTranslation('name') }}" height="30">
                            </a>
                        </div>
                    @endif

                    <div class="rating rating-sm mt-1">
                        {{ renderStarRating($product->rating) }}
                    </div>
                </div>
                <h3 class="fw-600 fs-13 text-truncate-2 lh-1-4 my-1">
                    <a href="{{ route('product', $product->slug) }}"
                        class="d-block text-reset">{{ getTranslation($product->id) == null ? $product->name : getTranslation($product->id) }}</a>
                </h3>
                <div class="my-1">
                    <span class="fw-bold text-primary font-price">{{ $home_discounted_base_price }}</span>
                    @if ($home_base_price != $home_discounted_base_price)
                        @php
                            $product_discount = show_product_discount($product_Modal);
                        @endphp
                        <span class="badge badge-pill badge-primary fw-bold"
                            style="width: auto;font-weight: bold !important">{{ $product_discount['discount_percent'] . '%' }}</span>
                    @endif

                </div>
                @if ($home_base_price != $home_discounted_base_price)
                    <div class="my-1">

                        <small class="d-md-inline d-none">{{ translate('Taxes included') }}</small>
                        <del class="fw-bold opacity-50 mr-1"
                            style="{{ get_setting('style_price_del') }} font-size:12px">{{ $home_base_price }}</del>
                    </div>

                    <div>

                        <div class="d-md-flex d-none flex-row tag-price"
                            style="border-inline-start: 4px solid var(--primary)">
                            <i style="margin-inline: 5px" class="las la-tag"></i>
                            <small style="margin-inline-end: 5px">{{ translate('put by') }}</small>
                            <small
                                class="fw-bold">{{ format_price(convert_price($product_discount['discount_amount'])) }}</small>
                        </div>

                    </div>
                @endif

            </div>



            @if (\App\Addon::where('unique_identifier', 'club_point')->first() != null && \App\Addon::where('unique_identifier', 'club_point')->first()->activated)
                <div class="rounded px-2 mt-2 bg-soft-primary border-soft-primary border">
                    {{ translate('Club Point') }}:
                    <span class="fw-700 float-right">{{ $product->earn_point }}</span>
                </div>
            @endif
        </div>

        <div class="d-flex flex-row aiz-p-hov-icon pb-2 my-1" style="justify-content: space-around">
            <a href="javascript:void(0)" onclick="addToWishList({{ $product->id }})" data-toggle="tooltip"
                data-title="{{ translate('Add to wishlist') }}" data-placement="left">
                <i class="la la-heart-o"></i>
            </a>
            <a href="javascript:void(0)" onclick="addToCompare({{ $product->id }})" data-toggle="tooltip"
                data-title="{{ translate('Add to compare') }}" data-placement="left">
                <i class="las la-sync"></i>
            </a>
            <a href="javascript:void(0)" onclick="showAddToCartModal({{ $product->id }})" data-toggle="tooltip"
                data-title="{{ translate('Add to cart') }}" data-placement="left">
                <i class="las la-shopping-cart"></i>
            </a>
        </div>
    </div>
</div>
