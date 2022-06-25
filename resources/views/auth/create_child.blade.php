<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'みんなの休み時間。') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="text-center my-5 h3">

            みんなの休み時間。

        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center">{{ __('保護者登録') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('children.store') }}">
                            @csrf
                            {{-- 施設ID --}}
                            <div class="form-group row">
                                <label for="id"
                                    class="col-md-4 col-form-label text-md-right">{{ __('施設ID') }}</label>

                                <div class="col-md-6">
                                    <input id="id" type="text"
                                        class="form-control @error('code') is-invalid @enderror" name="code"
                                        value="{{ old('code') }}" required autocomplete="code" autofocus>

                                    @error('code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- 子供氏名 --}}
                            <div class="form-group row">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('お子様氏名') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('child_name') is-invalid @enderror" name="child_name"
                                        value="{{ old('child_name') }}" required autocomplete="child_name" autofocus>

                                    @error('child_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- ニックネーム --}}
                            <div class="form-group row">
                                <label for="nickname"
                                    class="col-md-4 col-form-label text-md-right">{{ __('ニックネーム') }}</label>
                                <div class="col-md-6">
                                    <input id="nickname" type="text"
                                        class="form-control @error('nickname') is-invalid @enderror" name="nickname"
                                        value="{{ old('nickname') }}" autofocus>
                                    @error('nickname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- 性別 --}}
                            <div class="form-group row">
                                <label for="gender" class="col-md-4 col-form-label text-md-right">性別</label>

                                <div class="col-md-6" style="padding-top: 8px">
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
                            {{-- 誕生日 --}}
                            <div class="form-group row">
                                <label for="birthday"
                                    class="col-md-4 col-form-label text-md-right">{{ __('お誕生日') }}</label>
                                <div class="col-md-6">
                                    <input id="birthday" type="date"
                                        class="form-control @error('birthday') is-invalid @enderror" name="birthday"
                                        value="{{ old('birthday') }}" autofocus>
                                    @error('birthday')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- 電話番号 --}}
                            <div class="form-group row">
                                <label for="tel"
                                    class="col-md-4 col-form-label text-md-right">{{ __('電話番号') }}</label>
                                <div class="col-md-6">
                                    <input id="tel" type="text"
                                        class="form-control @error('tel') is-invalid @enderror" name="tel"
                                        value="{{ old('tel') }}" required autocomplete="tel" autofocus>
                                    @error('tel')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- メールアドレス --}}
                            <div class="form-group row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('メールアドレス') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- パスワード --}}
                            <div class="form-group row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('パスワード') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- パスワード確認 --}}
                            <div class="form-group row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('パスワード確認') }}</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                            {{-- 登録ボタン --}}
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('登録') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="col-md-6 offset-md-4 my-4">
                            @csrf
                            <a class="btn btn-link" href="{{ route('login') }}">
                                {{ __('ログインの方') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
