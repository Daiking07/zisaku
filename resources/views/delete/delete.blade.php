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
        <div class="contenter">
            <div class="text-center">
                <ul style="padding:0;">
                    <h2 class="text-light bg-primary mb-5 p-3">ご利用ありがとうございました！</h2>
                </ul>
                <ul style="margin:20% 0;">
                    <h3 class="text-primary mt-5 mr-5">みんなの休み時間</h3>
                </ul>
            </div>
            <div class="text-center">
                <div style="margin:20% 0;">
                    <a href="{{ route('home') }}" class="btn btn-primary btn-lg mx-4">トップへ戻る</a>
                </div>
            </div>
        </div>

    </div>
</body>

</html>
