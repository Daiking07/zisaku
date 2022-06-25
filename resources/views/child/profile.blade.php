@extends('layouts.header')
@section('content')
<div class="contenter">
    <div style="margin:0 9%; border-radius:60px;"class="d-flex bd-highlight my-5 text-light bg-secondary">
        <div class="p-2 bd-highlight ">
            <ul class="h4 text-light">メールアドレス</ul>
            <ul class="h5">{{Auth::user()->email}}</ul>
        </div>
        <div class="p-2 bd-highlight">
            <ul class="h4 text-light">電話番号</ul>
            <ul class="h5">{{Auth::user()->tel}}</ul>
        </div>
        <div class="p-2 pr-5 ml-auto bd-highlight align-self-center">
            <a class="btn btn-outline-warning text-light"　href="{{route('child.create',Auth::id())}}">お子様追加</a>
        </div>
    </div>

    @foreach($children as $child)
    <div class="d-flex justify-content-center p-5">
        <div class="align-self-center mr-5">
            <a type="button" href="{{route('blogs.index',$child->id)}}" class="text-body btn btn-outline-warning my-3">日記</a>
            <div class="p-2">
                <ul style="width:25rem; border-radius:15px;" class="h4 bg-info">名前</ul>
                <ul class="h5">{{$child->name}}</ul>
            </div>
            @if(!empty($child->birthday))
            <div class="p-2">
                <ul style="width:25rem; border-radius:15px;" class="h4 bg-info">ニックネーム</ul>
                <ul class="h5">{{$child->nickname}}</ul>
            </div>
            @endif
            @if(!empty($child->birthday))
            <div class="p-2">
                <ul style="width:25rem; border-radius:15px;" class="h4 bg-info">お誕生日</ul>
                <ul class="h5">{{date('Y年m月d日',  strtotime($child->birthday))}}</ul>
            </div>
            @endif
            <div class="p-2">
                <ul style="width:25rem; border-radius:15px;" class="h4 bg-info">性別</ul>
                <ul class="h5">{{$child->gender}}</ul>
            </div>
        </div>
        <div class="align-self-center">
            <div class="container">
                @if (empty($child->image))
                <img src="{{ asset('image/noimage.png') }}" style=" width:12rem; height:15rem;object-fit: cover;" alt="">
              @else
                <img style="border:solid 1px #000; width:12rem; height:15rem;object-fit: cover;" src="{{ asset('storage/'.$child->image) }}"　name="image">
              @endif
            </div>
            <div class="mt-5">
                <a type="button" href="{{route('children.edit',$child->id)}}" class="btn btn-secondary mx-4">編集</a>
                @if($children = array() > 1)
                    <button type="button" class="text-light btn btn-danger mx-4" data-toggle="modal" data-target="#modal1">削除</button>
                @endif
            </div>
        </div>
    </div>
    @endforeach
    <div class="d-flex justify-content-center">
        <a class="btn btn-primary mx-5" href="{{ route('login') }}">戻る</a>
        <a href="{{route('user.delete',Auth::id() )}} " class="btn btn-danger">退会する</a>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
    <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="label1">Modal title</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <div class="modal-body">
         Modal body
       </div>
       <div class="modal-footer">
         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
         <form action="{{route('children.destroy',$child->id)}}" method="post">
             @csrf @method('delete')
             <button type="submit" class="btn btn-primary">削除する</button>
         </form>
     </div>
   </div>
 </div>
</div>
@endsection