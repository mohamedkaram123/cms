@extends('backend.layouts.app')

@section('content')

    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">#{{ $conversation->title }} (Between @if ($conversation->sender != null)
                        {{ $conversation->sender->name }}
                        @endif and @if ($conversation->receiver != null)
                            {{ $conversation->receiver->name }}
                        @endif)
                </h5>
            </div>

            <div class="card-body">
                @if (count($conversation->files) != 0)
                    <div class="col-md-4 col-12">
                        <label>{{ translate('order files') }}</label>

                        <div class="d-flex flex-row" style="justify-content: space-around">
                            @foreach ($conversation->files as $file)
                                @php
                                    $file_path = $file->upload->file_name;
                                @endphp
                                @if ($file->upload->type == 'document')
                                    @if ($file->upload->extension == 'xlsx')
                                        <a href="{{ url("/public/$file_path") }}">
                                            <img src="{{ url('/public/assets/img/icon_xlsx.png') }}"
                                                style="width:80px;height:80px" />
                                        </a>
                                    @elseif ($file->upload->extension == 'csv')
                                        <a href="{{ url("/public/$file_path") }}">
                                            <img src="{{ url('/public/assets/img/icon_csv.png') }}"
                                                style="width:80px;height:80px" />
                                        </a>
                                    @elseif ($file->upload->extension == 'pdf')
                                        <a href="{{ url("/public/$file_path") }}">
                                            <img src="{{ url('/public/assets/img/icon_pdf.png') }}"
                                                style="width:80px;height:80px" />
                                        </a>
                                    @elseif ($file->upload->extension == 'word')
                                        <a href="{{ url("/public/$file_path") }}">
                                            <img src="{{ url('/public/assets/img/icon_word.png') }}"
                                                style="width:80px;height:80px" />
                                        </a>
                                    @endif
                                @else
                                    <a href="{{ url("/public/$file_path") }}">
                                        <img src="{{ url("/public/$file_path") }}" style="width:80px;height:80px" />
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif

                <ul class="list-group list-group-flush">
                    @foreach ($conversation->messages as $message)
                        <li class="list-group-item px-0">
                            <div class="media mb-2">
                                <img class="avatar avatar-xs mr-3"
                                    @if ($message->user != null) src="{{ uploaded_asset($message->user->avatar_original) }}" @endif
                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/avatar-place.png') }}';">
                                <div class="media-body">
                                    <h6 class="mb-0 fw-600">
                                        @if ($message->user != null)
                                            {{ $message->user->name }}
                                        @endif
                                    </h6>
                                    <p class="opacity-50">{{ $message->created_at }}</p>
                                </div>
                            </div>
                            <p>
                                {{ $message->message }}
                            </p>
                        </li>
                    @endforeach
                </ul>
                @if (Auth::user()->id == $conversation->receiver_id)
                    <form action="{{ route('messages.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="conversation_id" value="{{ $conversation->id }}">
                        <div class="row">
                            <div class="col-md-12">
                                <textarea class="form-control" rows="4" name="message" placeholder="{{ translate('Type your reply') }}"
                                    required></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="text-right">
                            <button type="submit" class="btn btn-info">{{ translate('Send') }}</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>

@endsection
