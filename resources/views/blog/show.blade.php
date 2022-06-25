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
        <div class="d-flex justify-content-between">
            <div class="h5">
                <p>{{ $child->name }}@if ($child->gender == '男')
                        くん@elseちゃん
                    @endifの一日</p>
                <p>{{ date('Y年m月d日', strtotime($blog->created_at)) }}</p>
                <p>{{ $blog->title }}</p>
            </div>
            <div>
                <div class="d-flex">
                    @if (!empty(Auth::user()->role == '0'))
                        <a type="button" href=" {{ route('blogs.create', $blog->child_id) }}"
                            class="mx-3 btn btn-info btn-lg">記事作成</a>
                    @endif
                    <a type="button" href=" {{ route('blogs.index', $blog->child_id) }}"
                        class="mx-3 btn btn-info btn-lg">戻る</a>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between">
            <div class="h5">
                <div style="width:50rem; height:25rem;" class="box15">
                    <p>{!! nl2br($blog->comment) !!}</p>
                </div>
            </div>
            @if (!empty(Auth::user()->role == '0'))
                <div>
                    <div class="d-flex">
                        <a type="button" href="{{ route('blogs.edit', $blog->id) }}"
                            class="btn btn-secondary btn-lg mx-2">日記編集</a>
                        <form action="{{ route('blogs.destroy', $blog->id) }}" method="post">
                            @csrf @method('delete')
                            <button type="submit" class="btn btn-danger btn-lg mx-1">日記削除</button>
                        </form>
                    </div>
                </div>
            @endif
        </div>
        <div>
        @if(Auth::user()->role == 1)
            <div class="my-4">
                <input type="hidden" id='blog_id' name="blog_id" value="{{$blog->id}}">
                <div class="input-group mb-3">
                    <input type="text" id="comment-input" style="height: 3.5rem;" class="form-control py-1" placeholder='コメント入力'>
                    <p class="fa fa-search" aria-hidden="true"></p>
                    <button style="width:10%;" id="comment-send-btn" class="btn btn-info border-001 mx-3">送信</button>
                </div>
            </div>
        @endif
            <table class="table table-borderless m-1 h5">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">コメント</th>
                        <th scope="col">日付</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody id='www'>
                @foreach($comments as $item)
                @include('comments.comment')
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection