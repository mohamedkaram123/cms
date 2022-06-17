@extends('backend.layouts.blank')
@section('content')
    <div class="container pt-5">
        <div class="row">
            <div class="col-xl-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="mar-ver pad-btm text-center">
                            <h1 class="h3">Import SQL</h1>
                        </div>
                        <p class="text-muted font-13 text-center">
                            <strong>Your database is successfully connected</strong>. All you need to do now is
                            <strong>hit the 'Install' button</strong>.
                            The auto installer will run a sql file, will do all the tiresome works and set up your application automatically.
                        </p>
                        @if(!empty($errorss))
                            <div class="alert alert-danger">
                                <p><strong>Opps Something went wrong</strong></p>
                                <ul>
                                @foreach ($errorss as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="text-center mar-top pad-top">
                            <form action="{{ route('import_sql') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                Select sql file to upload:
                                <input type="file" id="sql_input" name="sql" accept=".sql" id="fileToUpload" required>

                                <button id="submit_file" class="btn btn-primary" type="submit">
                                    upload
                                </button>

                                <div id="loader" style="margin-top: 20px; display: none;">
                                <img loading="lazy"  src="{{ static_asset('assets/img/loading.gif') }}" alt="" width="20">
                                &nbsp; Importing database ....
                            </div>
                            </form>

                            {{-- <a href="{{ route('import_sql') }}" class="btn btn-primary" onclick="showLoder()">Import SQL</a>
                            <div id="loader" style="margin-top: 20px; display: none;">
                                <img loading="lazy"  src="{{ asset('loader.gif') }}" alt="" width="20">
                                &nbsp; Importing database ....
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">

    $("#submit_file").click(function (e) {
        console.log("ddddddddd");
        if($("#sql_input").val() != null && $("#sql_input").val() != ""){
 $(this).attr("disabled","disabled")
        showLoder()

        }
});

        function showLoder() {
            $('#loader').fadeIn();
        }
    </script>
@endsection
