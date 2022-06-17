@extends('backend.layouts.blank')
@section('content')

    <div class="container pt-5">
        <div class="row">
            <div class="col-xl-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="mar-ver pad-btm text-center">
                            <h1 class="h3">Active eCommerce CMS Installation</h1>
                            <p>You will need enter purchase code.</p>
                        </div>
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
                            <form action="{{ route('purchase.system') }}" method="post" enctype="multipart/form-data">
                                   @csrf
                                        <div className="form-group" style="margin-block: 20px">
                                            <label >Purchase Key Id</label>
                                            <div className="input-group">

                                             <input autocomplete="off"  class="form-control" type="text" name="purchase_key_id" required  />
                                           </div>
                                        </div>

                                    <div class="text-center form-group">
                                            <button class="btn btn-primary">
                                                Save
                                            </button>
                                        </div>



                             </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
