
@if(get_setting("multy_vendors") == 1)
       @if(auth()->check())
        @include("frontend.multi_view_carts.auth_cart")

        @else
        @include("frontend.multi_view_carts.session_cart")

        @endif
@else
    @if (auth()->check())

    @include("frontend.view_carts.auth_cart")
    @else
    @include("frontend.view_carts.session_cart")

    @endif
@endif
<script type="text/javascript">
    AIZ.extra.plusMinus();
</script>
