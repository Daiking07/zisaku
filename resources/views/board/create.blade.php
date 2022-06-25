@extends('layouts.header')
@section('content')
<div class="container">
    <div class="p-4">
        <p class="h2 text-center">掲示板作成</p>
    </div>
    <form action="{{route('boards.store')}}" method="post">
        @csrf
        <div style="width:70%;" class="input-group my-3 mx-auto">
            <div class="input-group-prepend">
              <span class="input-group-text bg-dark text-white" for="title" id="inputGroup-tite">タイトル</span>
            </div>
            <input type="text" id="title" class="form-control @error('title') is-invalid @enderror" aria-label="Sizing example input" name="title" placeholder="タイトル入力" aria-describedby="inputGroup-tilte" required autocomplete="title">
            @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div>
            <span class="h3" for="comment">記事</span>
            <div class="p-4">
                <textarea name="comment" id="comment" class="form-control border-002 @error('comment') is-invalid @enderror" id="" placeholder="記事入力" required autocomplete="comment"></textarea>
                @error('comment')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="d-flex justify-content-around my-3 px-5">
            <button type="submit" class="btn btn-info btn-lg">登録</button>
            <a href="{{route('boards.index',Auth::user()->school_id)}}" class="btn btn-info btn-lg">戻る</a>
        </div>
    </form>

</div>
@endsection