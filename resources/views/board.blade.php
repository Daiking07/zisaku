@extends('layouts.header')
@section('content')
    <div class="container">
                {{-- フラッシュメッセージ表示 --}}
        @if (Session::get('message'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ Session::get('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{-- フラッシュメッセージ表示削除　⬇︎ --}}
            {{ Session::forget('message') }}
        @endif
        <div class="text-right">
            @if (Auth::user()->role == 0)
                <a href="{{ route('boards.create') }}" class="btn btn-info btn-lg">記事作成</a>
            @endif
        </div>
        <div class="p-4">
            <p class="h2 text-center">お知らせ</p>
        </div>
        <div class="box15">
            <div class="p-4 h4">
                @foreach ($boards as $board)
                    <div class="d-flex">
                        <a href="{{ route('boards.show', $board->id) }}" type="button" class="mb-2">
                            <li class="p-3 mb-2 h5">
                                {{ \Carbon\Carbon::parse($board->created_at)->format('ーY/n/jー') }}　　{{ $board->title }}
                            </li>
                        </a>
                    </div>
                @endforeach
            </div>

        </div>
        <div class="d-flex justify-content-center">
            {{ $boards->links() }}
        </div>
    </div>
@endsection
