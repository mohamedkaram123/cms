                    @php $logo = get_setting('header_logo'); @endphp

@include("emails.layouts.header")

@yield('content')

@include("emails.layouts.footer")
