@extends('layouts.header')
@section('content')
    <div class="contenter">
      
        <form action="{{route('child.store',Auth::id())}}" method="post">
            @csrf
            <div style="margin:0 7%;" class="d-flex justify-content-around">
                    <div style="margin-left:5%;">
                        <div class="p-2 d-flex flex-column">
                            <strong for="child_name">おなまえ</strong>
                            <input type="text" id="child_name" class="mb-3 text-002 p-3 @error('child_name') is-invalid @enderror" name="child_name" placeholder="名前" required autocomplete="child_name">
                            @error('child_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="p-2 d-flex flex-column">
                            <strong for="nickname">ニックネーム</strong>
                            <input type="text" id="nickname" class="mb-3 text-002 p-3 @error('nickname') is-invalid @enderror" name="nickname" placeholder="ニックネーム">
                        </div>
                        <div class="p-2 d-flex flex-column">
                            <strong for="birthday">お誕生日</strong>
                            <input type="date" id="birthday" class="mb-3 text-002 p-3" name="birthday" placeholder="誕生日">
                        </div>
                        <div class="ml-4">
                            <strong for="gender" class="col-md-4 col-form-label text-md-right px-0">性別</strong>
                            <div class="form-group row d-flex flex-column text-002 bg-white">
                                <div class="col-md-6" style="padding-top: 9px">
                                    <input id="gender-m" type="radio" name="gender" value="男">
                                    <label for="gender-m">男の子</label>
                                    <input id="gender-f" type="radio" name="gender" value="女">
                                    <label for="gender-f">女の子</label>

                                    @if ($errors->has('gender'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('gender') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                <div>
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
                        <a class="btn btn-primary mx-4" href="{{ route('children.show',Auth::user()->id) }}">戻る</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
