@extends('layouts.header')
@section('content')
    <div class="container">
        
        <div class="p-4">
            <p class="h2 text-center">日記作成</p>
        </div>
        <form action="{{ route('blogs.store') }}" method="post">
            @csrf
            <div style="width:70%;" class="input-group my-3 mx-auto">
                <div class="input-group-prepend">

                    <input type="hidden" name="school_id" value="{{ $child->school_id }}">
                    <input type="hidden" name="child_id" value="{{ $child->id }}">
                    <span class="input-group-text bg-dark text-white" for="title" id="inputGroup-tite">タイトル</span>
                </div>
                <input type="text" style="width:40rem;" name="title" id="title" class="form-control @error('title') is-invalid @enderror" aria-label="Sizing example input"
                    placeholder="タイトル入力" aria-describedby="inputGroup-tilte" required autocomplete="title">
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
            </div>

            <div>
                <span class="h3" for="comment">記事</span>
                <div class="p-4">
                    <textarea name="comment" class="form-control border-002 @error('comment') is-invalid @enderror" id="comment" placeholder="記事入力" required autocomplete="comment"></textarea>
                    @error('comment')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="d-flex justify-content-around my-3 px-5">
                <button type="submit" class="btn btn-info btn-lg">登録</button>
        </form>
        <a href="{{route('blogs.index',$child->id )}}" class="btn btn-info btn-lg">戻る</a>
    </div>

    </div>
@endsection
