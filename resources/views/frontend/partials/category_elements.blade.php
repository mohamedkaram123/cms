<div class="category-nav-element cat-menu3-hover" style="padding-inline-start:10px">
    <div class="d-flex" style="justify-content: space-between;align-items: center">

        <a class="text-truncate text-reset py-2 d-block"
            style="font-size: 14px;color: var(--primary) !important;font-weight: bold"
            href="{{ route('products.category', $category->slug) }}">{{ translate('show all') }}
        </a>
    </div>
</div>
<div class="d-flex flex-column ">
    <ul class="list-unstyled mb-3">

        @foreach (\App\Utility\CategoryUtility::get_immediate_children_ids($category->id) as $key => $first_level_id)
            {{-- <div class="card shadow-none border-0"> --}}
            {{-- <li class="fw-600   d-block cat-menu3-hover" style="padding-inline-end: 10rem;padding-block: 20px">
                <a style="text-decoration: none;
                          width: 100%;
                           height: 100%;
                           font-size: 12px;
                           " class=""
                    href="{{ route('products.category', \App\Category::find($first_level_id)->slug) }}">{{ \App\Category::find($first_level_id)->getTranslation('name') }}</a>
            </li> --}}
            <li class="category-nav-element cat-menu3-hover " data-id="{{ $category->id }}" style="
                padding-inline-start:10px">
                <div class="d-flex" style="justify-content: space-between;align-items: center">
                    <a href="{{ route('products.category', \App\Category::find($first_level_id)->slug) }}"
                        class="text-truncate text-reset py-2 d-block">

                        <span
                            class="cat-name">{{ \App\Category::find($first_level_id)->getTranslation('name') }}</span>
                    </a>
                </div>
            </li>
            {{-- @foreach (\App\Utility\CategoryUtility::get_immediate_children_ids($first_level_id) as $key => $second_level_id)
                    <li class="mb-2">
                        <a style="  text-decoration: none;
     width: 100%;
     height: 100%;" class=""
                            href="{{ route('products.category', \App\Category::find($second_level_id)->slug) }}">{{ \App\Category::find($second_level_id)->getTranslation('name') }}</a>
                    </li>
                @endforeach --}}
            {{-- </div> --}}
        @endforeach
    </ul>
</div>
