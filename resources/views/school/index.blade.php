@extends('layouts.header')
@section('content')
    <div class="container">
        <div class="p-4">
            <p class="h4">お子様リスト</p>
                    {{-- お子様削除のフラッシュメッセージ表示 --}}
        @if (Session::get('delete'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ Session::get('delete') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{-- フラッシュメッセージ表示削除　⬇︎ --}}
            {{ Session::forget('delete') }}
        @endif
            <div class="my-4">
                <div class="search-wrapper">
                    <div class="d-flex justify-content-end mr-5 user-search-form">
                        <input type="text" id="search_name" style="width:40%; height: 50px;" class="form-control mx-2 rounded-pill form-control shadow" placeholder='ユーザーを検索する'>
                        <p class="fa fa-search" aria-hidden="true"></p>
                        <button style="width:10%;" id="search-btn" class="mr-5 rounded-pill btn btn-outline-info text-bodyn btn search-icon">検索</button>
                        <div class="pr-3">
                            <a　href="" class="btn btn-outline-info mt-2">クリア</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-index">
            <table id="text" class="table table-borderless table-index2 table-hover mb-0">
                <thead>
                    <tr class="h5">
                        <th scope="col">お名前</th>
                        <th scope="col">性別</th>
                        <th scope="col">日記</th>
                    </tr>
                </thead>
                <tbody id='xxx'>
                    @foreach ($children as $child)
                        <tr id="old" class="h5">
                            <th scope="row">{{ $child->name }} @if ($child->gender == '男')
                                    くん@elseちゃん
                                @endif
                            </th>
                            <td>{{ $child->gender }}の子</td>
                            <td>
                                <a type="button" href="{{ route('blogs.index', $child->id) }}"
                                    class="text-body btn btn-outline-warning">日記</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
