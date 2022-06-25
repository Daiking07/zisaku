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
                <h2 class="text-light bg-danger mb-5 p-3" name="name">{{ $school->name }}のアカウントを削除します</h2>
            </ul>
            <ul>
                <h5 class="text-danger mt-5 mr-5">※本人確認のため入力してください</h5>
            </ul>
        </div>
        <form action="{{ route('schools.destroy', Auth::user()->school_id) }}" method="POST">
            @csrf @method('delete')
            <div class="text-center">
                <div>
                    <div class="p-2">
                        <input type="text" class="mb-3 text-002 p-3" name="code" placeholder="施設ID">
                    </div>
                    <div class="p-2">
                        <input type="text" class="mb-3 text-002 p-3" name="email" placeholder="メールアドレス">
                    </div>
                    <div class="p-2">
                        <input type="text" class="mb-3 text-002 p-3" name="tel" placeholder="電話番号">
                    </div>
                </div>
                <div class="my-5 d-flex justify-content-center">
                    <button type="submit" class="btn btn-danger btn-lg mx-4">退会</button>
                    <a href="{{ route('schools.show', Auth::user()->school_id) }} "
                        class="btn btn-primary btn-lg mx-4">戻る</a>
                </div>
            </div>
        </form>
    </div>
@endsection
