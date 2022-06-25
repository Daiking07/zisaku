@extends('layouts.header')
@section('content')
<div class="contenter">
    <div>
        <div class="d-flex justify-content-center">

            <div style="width:270xp; height:260px" class="box15 justify-content-center">
                <p class="h3" name="name">{{$child->name}}</p>
                <p class="h4" name="nickname">{{$child->nickname}}</p>
                <div class="form-group">
                    <div class="m-3">
                        @if(!empty($child->birthday))
                        <label class="h5 mr-3">お誕生日</label>
                        <p class="h5" name="birthday">{{$child->birthday}}</p>
                        @endif
                    </div>
                    <div class="m-3">
                        <label class="h5 mr-3">性別</label>
                        <p class="h5" name="gender">{{$child->gender}}の子</p>
                    </div>
                </div>
            </div>
        </div>
    @if(Auth::user()->role === 0)
        <div style="margin-right:20%;" class="text-right my-5 h4">
            <button type="button" class="text-light btn btn-danger" data-toggle="modal" data-target="#modal1">削除する</button>
        </div>
    @endif
    </div>
    <div class="my-4">
        <div class="d-flex justify-content-end mr-5">
            <input type="text" style="width:30%; height: 50px;" class="form-control mx-2 rounded-pill">
            <button style="width:4%;" class="mr-5 rounded-pill btn btn-outline-info text-body">検索</button>
        </div>
    </div>
    <div>
        <div>
            <div class="d-flex justify-content-around">
                <p style="width:40%;" class="h2 mt-2 pr-5 text-light bg-info">日記</p>
                @if(Auth::user()->role === 0)
                <div>
                    <a type="button" class="mr-5 h5 text-dark border border-info border-5 rounded-pill p-2" href="{{route('create_blog',$child_id)}}">日記作成</a>
                </div> 
                @endif
            </div>
            <div class="d-flex justify-content-center my-3">
                <div style="width:90%;" class="ml-5 d-inline bg-info text-dark">
                    <p class="p-3 mb-2 h5">・  タイトル</p>
                    <p class="p-3 mb-2 h5">・  タイトル</p>
                    <p class="p-3 mb-2 h5">・  タイトル</p>
                    <p class="p-3 mb-2 h5">・  タイトル</p>
                </div>
            </div>
        </div>
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
    
            <form action="{{route('children.destroy',1)}}" method="post">
                @csrf @method('delete')
                <button type="submit" class="btn btn-primary">削除する</button>
            </form>
        </div>
      </div>
    </div>
  </div>
@endsection