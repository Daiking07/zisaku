@extends('layouts.header')
@section('content')
    <div class="container">
        <div class="d-flex justify-content-between">
            <div class="h1">
                <p>掲示板</p>
            </div>
        </div>
        <div>
            @if(Auth::user()->role == 0)
            <div class="d-flex ml-3 mt-4">
                <div>
                    <a href="{{route('boards.edit',$board->id)}}" class="btn btn-secondary btn-lg mx-2">掲示板編集</a>
                </div>
                <div>
                    <button type="submit" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#modal1">掲示板削除</button>
                </div>
            </div>
            @endif
            <div class="h5">
                <div>
                        <p>{{ \Carbon\Carbon::parse($board->created_at)->format('Y ねん n がつ j にち ').$week.' よう日' }}</p>
                    <div class="d-flex mt-5 h4 pt-3">
                        <strong class="mx-5">内容</strong>
                        <p>{{ $board->title }}</p>
                    </div>
                </div>
                <div style="width:600px; height:200px" class="box15 py-5">
                    <ul>
                        <p>{!! nl2br($board->comment)!!}</p>
                    </ul>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-around h5">
            <a class="p-3 mb-2 bg-info text-white img-thumbnail" href="{{route('boards.index')}}">戻る</a>
        </div>
    </div>
@endsection
    <!-- Modal -->
    <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="label1">掲示板を削除</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    本当に削除しますか？
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <form action="{{ route('boards.destroy', $board->id) }}" method="post">
                        @csrf @method('delete')
                        <button type="submit" class="btn btn-primary">削除する</button>
                    </form>
                </div>
            </div>
        </div>
    </div>