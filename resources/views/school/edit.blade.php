@extends('layouts.header')
@section('content')
    <div class="contenter">
        <form action=" {{ route('schools.update', Auth::user()->school_id) }}" method="post">
            @csrf @method('put')
            <div style="margin:0 7%;" class="d-flex justify-content-around">
                <div style="margin-left:5%;">
                    <div class="p-2">
                        <input type="text" id="school_name"
                            class="mb-3 text-002 p-3 @error('school_name') is-invalid @enderror" name="school_name"
                            placeholder="施設名" value="{{ old('name', $school->name) }}" required autocomplete="school_name">
                        @error('school_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="p-2">
                        <input type="text" id="email" class="mb-3 text-002 p-3 @error('email') is-invalid @enderror"
                            name="email" placeholder="メールアドレス" value="{{ old('email', Auth::user()->email) }}" required
                            autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="p-2">
                        <input type="text" id="tel" class="mb-3 text-002 p-3 @error('tel') is-invalid @enderror"
                            name="tel" placeholder="電話番号" value="{{ old('tel', Auth::user()->tel) }}" required
                            autocomplete="tel">
                        @error('tel')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div>
                    <div class="p-2">
                        <input type="text" id="principal"
                            class="mb-3 text-002 p-3 @error('principal') is-invalid @enderror" name="principal"
                            placeholder="園長名" value="{{ old('principal', $school->principal) }}" required
                            autocomplete="principal">
                        @error('principal')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div style="margin-right:45%;">
                        <div class="form-group row">
                            <label for="postal_code" id="postal_code" class="col-md-4 col-form-label text-md-right" required
                                autocomplete="postal_code">{{ __('郵便番号') }}</label>

                            <div class="col-md-6">
                                <input id="postal_code" type="text"
                                    class="form-control text-003 @error('postal_code') is-invalid @enderror"
                                    name="postal_code" value="{{ old('postal_code', $school->postal_code) }}"
                                    autocomplete="postal_code" placeholder="000-0000" required autocomplete="postal_code">

                                @error('postal_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="pref" class="col-md-4 col-form-label text-md-right">{{ __('都道府県') }}</label>
                            {{-- 都道府県 --}}
                            <div class="col-md-6">
                                <select name="pref_id" id="pref_id"
                                    class="form-control text-003 @error('pref_id') is-invalid @enderror" required
                                    autocomplete="pref_id">
                                    <option value="">-- 選択してください --</option>
                                    @foreach (App\Models\School::$prefs as $key => $pref)
                                        <option value="{{ $key }}"
                                            @if (old('pref_id', $school->pref_id) == $key) selected @endif>{{ $pref }}</option>
                                    @endforeach
                                </select>

                                @error('pref_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- 市町村 --}}
                        <div class="form-group row">
                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('市区町村') }}</label>

                            <div class="col-md-6">
                                <input id="city" type="text"
                                    class="form-control text-003 @error('city') is-invalid @enderror" name="city"
                                    value="{{ old('city', $school->city, $school->city) }}" autocomplete="city"
                                    placeholder="大阪市北区" required autocomplete="city">

                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- 番地 --}}
                        <div class="form-group row">
                            <label for="town" class="col-md-4 col-form-label text-md-right">{{ __('町名番地等') }}</label>

                            <div class="col-md-6">
                                <input id="town" type="text"
                                    class="form-control text-003 @error('town') is-invalid @enderror text-002"
                                    name="town" value="{{ old('town', $school->town) }}" autocomplete="town"
                                    placeholder="中之島1丁目1-1" required autocomplete="town">

                                @error('town')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- 建物名 --}}
                        <div class="form-group row">
                            <label for="building"
                                class="col-md-4 col-form-label text-md-right">{{ __('建物名') }}</label>

                            <div class="col-md-6">
                                <input id="building" type="text"
                                    class="form-control text-003 @error('bilding') is-invalid @enderror" name="building"
                                    value="{{ old('building', $school->building) }}" autocomplete="building"
                                    placeholder="中之島○○ビル101号室">

                                @error('building')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div style="margin-left:30%;" class="my-5">
                        <button type="submit" class="btn btn-secondary mx-4">登録</button>
        </form>
        <a href="{{ route('schools.show', Auth::user()->school_id) }}" class="btn btn-primary mx-4">戻る</a>
    </div>
    </div>
    </div>

    </div>

@endsection
