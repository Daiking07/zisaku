@extends('layouts.header')
@section('content')
    <div class="contenter">
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
        <div>
            <div class="d-flex justify-content-center">
                <div style="width:260px; height:260px" class="box15 justify-content-center">
                    <div class="text-center">
                        <strong for="name" class="mb-0">おなまえ</strong>
                        <p class="h4" name="name">{{ $child->name }}@if ($child->gender == '男')
                                くん@elseちゃん
                            @endif
                        </p>
                        <strong for="nickname" class="mb-0">ニックネーム</strong>
                        <p class="h4" name="nickname">{{ $child->nickname }}</p>
                        <div class="form-group">
                            <div class="my-3">
                                @if (!empty($child->birthday))
                                    <strong class="my-3">お誕生日</strong>
                                    <p class="h5" name="birthday">{{ $child->birthday }}</p>
                                @endif
                            </div>
                            <div class="my-3">
                                <strong class="my-3">性別</strong>
                                <p class="h5" name="gender">{{ $child->gender }}の子</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (Auth::user()->role === 0)
                <div style="margin-right:10%;" class="text-right my-5 h4">
                    <button type="button" class="text-light btn btn-danger" data-toggle="modal"　data-target="#modal1">名簿から削除する</button>
                </div>
            @endif
        </div>
        <div>
            <div>
                <div class="d-flex justify-content-around">
                    <div style="width:64%;">
                        <p style="border-radius:80px;" class="h2 mt-2 pl-5 text-light bg-info">日記</p>
                    </div>
                    @if (Auth::user()->role === 0)
                        <div>
                            <a type="button" class="mr-5 h5 text-dark border border-info border-5 rounded-pill p-2"
                                href="{{ route('blogs.create', $child->id) }}">日記作成</a>
                        </div>
                    @endif
                </div>
                <div class="d-flex justify-content-center my-3">
                    <div style="width:90%; border-radius:5px;" class="ml-5 d-inline bg-info text-dark">
                        @foreach ($blogs as $blog)
                            <a href="{{ route('blogs.show', $blog->id) }}">
                                <p class="text-light p-3 mb-2 h5">・ {{ $blog->title }}</p>
                            </a>
                        @endforeach
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    {{ $blogs->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="label1">{{ $child->name }}@if ($child->gender == '男')
                            くん@elseちゃん
                        @endifの情報</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    本当に削除しますか？
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <form action="{{ route('children.destroy', $child->id) }}" method="post">
                        @csrf @method('delete')
                        <button type="submit" class="btn btn-primary">削除する</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
