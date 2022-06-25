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
        <div class="text-center">
            <ul style="padding:0;">
                <h2 class="text-light bg-danger mb-5 p-3"><span>{{ $child->name }}@if ($child->gender == '男')
                            くん@elseちゃん
                        @endif
                    </span>のアカウントを削除します</h2>
            </ul>
            <ul>
                <h5 class="text-danger mt-5 mr-5">※本人確認のため入力してください</h5>
            </ul>
        </div>
        <form action="{{ route('user.destroy', Auth::id()) }}" method="post">
            @csrf @method('delete')
            <div class="text-center">
                <div>
                    <div class="p-2">
                        <input type="text" name="email" class="mb-3 text-002 p-3" placeholder="メールアドレス">
                    </div>
                    <div class="p-2">
                        <input type="text" name="tel" class="mb-3 text-002 p-3" placeholder="電話番号">
                    </div>
                </div>
                <div class="d-flex my-5 -flex justify-content-center">
                    <div>
                        <button type="submit" class="btn btn-danger btn-lg mx-4">退会</a>
                    </div>
                    <a href=" {{ route('children.show', Auth::id()) }} " class="btn btn-primary btn-lg mx-4">戻る</a>
                </div>
            </div>
        </form>
    </div>
@endsection
