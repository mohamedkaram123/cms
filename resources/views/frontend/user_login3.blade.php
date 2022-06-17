@extends('frontend.layouts.app')

@section('content')
    <div id="user_login3">

    </div>
@endsection

@section('script')
    <script type="text/javascript">
        console.log($("#ey_p_bt"));

        $("#country").change(function(e) {
            e.preventDefault();

            //  console.log($("#country_tel" + $(this).val()).data("tel"));


            $("#country_tel_data").val($("#country_tel" + $(this).val()).data("tel")).change();
        });

        // $("#country_tel").change(function (e) {
        //     e.preventDefault();

        //     console.log($(this).val());
        // });
    </script>
@endsection
