@extends('layouts.header')
@section('content')
<div class="contenter">
    <div style="margin:0 7%;" class="d-flex justify-content-around">
        <div style="margin-left:5%;">
            <div class="p-2">
                <ul style="width:25rem; border-radius:15px;" class="h4 bg-info">施設名</ul>
                <ul class="h5">{{$school->name}} </ul>
            </div>
            <div class="p-2">
                <ul style="border-radius:15px;" class="h4 bg-info">施設ID</ul>
                <ul class="h5">{{$school->code}}</ul>
            </div>
            {{-- <div class="p-2">
                <ul style="border-radius:15px;" class="h4 bg-info">創立日</ul>
                <ul class="h5">○○○○年○○月○○日</ul>
            </div> --}}
            <div class="p-2">
                <ul style="border-radius:15px;" class="h4 bg-info">メールアドレス</ul>
                <ul class="h5">{{Auth::user()->email}}</ul>
            </div>
            <div class="p-2">
                <ul style="border-radius:15px;" class="h4 bg-info">電話番号</ul>
                <ul class="h5">{{Auth::user()->tel}}</ul>
            </div>
        </div>
        <div style="margin-right:5%;">
            <div class="p-2">
                <ul style="width:25rem; border-radius:15px;" class="h4 bg-info">園長名</ul>
                <ul class="h5">{{$school->principal}}先生</ul>
            </div>
            <div class="p-2">
                <ul style="border-radius:15px;" class="h4 bg-info">住所</ul>
                <ul class="h5">
                    <p style="border-bottom:solid 1px #f6993f; text-align: center;">{{$school->postal_code}}</p>
                    <p style="border-bottom:solid 1px #f6993f; text-align: center;">{{ App\Models\School::$prefs[$school->pref_id] }}</p>
                    <p style="border-bottom:solid 1px #f6993f; text-align: center;"> {{$school->city}}</p>
                    <p style="border-bottom:solid 1px #f6993f; text-align: center;">{{$school->town}}</p>
                    @if(!empty($school->building))
                        <p style="border-bottom:solid 1px #f6993f; text-align: center;">{{$school->building}}</p>
                    @endif
                </ul>
            </div>
            <div style="margin-left:30%;" class="mt-2">
                @csrf
                <a type="button" href="{{route('schools.edit',Auth::user()->school_id)}}" class="btn btn-secondary mx-4">編集</a>
                <a class="btn btn-primary mx-4" href="{{ route('login') }}">戻る</a>
                <a href="{{route('schools.delete',Auth::user()->school_id)}}" style="margin-right:30%;" class="btn btn-danger d-block my-4">退会する</a>
            </div>
        </div>
    </div>
</div>
@endsection