@extends('layouts.header')
@section('content')
    <div class="contenter">

        <form action="{{ route('children.update', $child->id) }}" method="post"　enctype="multipart/form-data">
            @csrf @method('put')
            <div style="margin:0 7%;" class="d-flex justify-content-around">
                <div style="margin-left:5%;">
                    <div class="p-2 d-flex flex-column">
                        <strong for="chil_name">おなまえ</strong>
                        <input type="text" id="child_name"
                            class="mb-3 text-002 p-3 @error('child_name') is-invalid @enderror" name="child_name"
                            value="{{ old('name', $child->name) }}" placeholder="名前" required autocomplete="child_name">
                        @error('child_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="p-2 d-flex flex-column">
                        <strong for="nickname">ニックネーム</strong>
                        <input type="text" id="nickname" name="nickname" class="mb-3 text-002 p-3"
                            value="{{ old('nikuname', $child->nickname) }}" placeholder="ニックネーム">
                    </div>
                    <div class="p-2 d-flex flex-column">
                        <strong for="birthday">お誕生日</strong>
                        <input type="date" id="birthday" name="birthday" class="mb-3 text-002 p-3"
                            value="{{ old('birthday', $child->birthday) }}" placeholder="誕生日">
                    </div>
                    <div class="p-2 d-flex flex-column">
                        <strong for="email">メールアドレス</strong>
                        <input type="text" id="email" class="mb-3 text-002 p-3 @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email', Auth::user()->email) }}" placeholder="メールアドレス" required
                            autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="p-2 d-flex flex-column">
                        <strong for="tel">電話番号</strong>
                        <input type="text" id="tel" class="mb-3 text-002 p-3 @error('tel') is-invalid @enderror"
                            name="tel" value="{{ old('tel', Auth::user()->tel) }}" placeholder="電話番号" required
                            autocomplete="tel">
                        @error('tel')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div>
                    <div>
                        <a class="btn btn-outline-dark mb-5"　href="">お子様追加</a>
                    </div>

                    <div style="width:12rem; height:15rem; margin-right:20%; padding:0;"class="container" id="img_btn">
                        @if (empty($child->image))
                            <img src="{{ asset('image/noimage.png') }}"
                                style=" width:12rem; height:15rem;object-fit: cover;" id="preview" alt="">
                        @else
                            <img src="{{ asset('storage/' . $child->image) }}"
                                style=" width:12rem; height:15rem;object-fit: cover;" id="preview" alt="">
                        @endif
                        <input type="file" name="image" style="display:none;" class="margin-top:10px;"
                            accept=".png,.jpg,.jpeg,image/png,image/jpg">
                    </div>
                    <div class="my-5">
                        <button type="submit" class="btn btn-secondary mx-4">登録</button>
                        <a class="btn btn-primary mx-4" href="{{ route('children.show', $child->id) }}">戻る</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
<script></script>
