<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ChildStoreRequest;
use App\Http\Requests\ChildUpdateRequest;
use App\Http\Requests\ChildrenUpdateRequest;

use App\User;
use App\Models\Child;
use App\Models\School;
use App\Models\Board;
use App\Models\Blog;
use App\Models\Comment;

use RecursiveDirectoryIterator;


class ChildController extends Controller
{

    public function create()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('auth.create_child');
    }
    public function store(ChildStoreRequest $request){
        if (Auth::check()) {
            return redirect()->route('home');
        }
        
        // ユーザテーブルにshool_id,email,password,tel登録処理⬇︎
        // // schoolテーブルのcodeからその施設のID取得してuserテーブルに登録。
        $user = new User();
        $user->fill([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tel' => $request->tel,
            'school_id' => School::firstWhere('code',$request->code)->id,
            'role' => 1,
        ]);
        $user->save();

         // child テーブルにお子様名、ニックネーム、性別を登録処理⬇︎
        // $userとSchoolテーブルからそれぞれのID取得してchildテーブルに登録。
        $child = New Child();
        $child->fill([
            'name'=>$request->child_name,
            'nickname'=>$request->nickname,
            'gender'=>$request->gender,
            'birthday' => $request->birthday,
            'user_id' => $user->id,
            'school_id' => School::firstWhere('code',$request->code)->id,
            
        ]);
        $child->save();

        Session::put('message', '登録完了しました!');
        return redirect()->route('home');
    }

    // ログイン後
    public function index(){
        return view('board');
    }

    // 保護者詳細を表示
    public function show(User $user){
        if(Auth::user()->id !== $user->id || Auth::user()->role !== 1){
            return redirect()->route('home');
        }
        $children = Child::where('user_id',Auth::id())->get();
        
        return view('child.profile',compact('children'));
    }
    // 保護者編集画面を表示
    public function edit(Child $child){

        return view('child.edit_profile',compact('child'));
    }
    // 保護者編集を処理
    public function update(ChildUpdateRequest $request ,Child $child){
        $user = Auth::user();
        $user->fill([
        'email' => $request->email,
        'tel' => $request->tel,
        ]);
        $user->save();


            $child->fill([
            'name'=>$request->child_name,
            'nickname'=>$request->nickname,
            'birthday' => $request->birthday,           
        ]);
        if(isset($request->image)){
        $path = $request->image->store('image','public');
        $child->image = $path;
        }
        $child->save();
        return redirect()->route('children.show',Auth::id());
    }

    //　保護者退会画面
    public function delete(User $user){
        $child = Child::firstwhere('user_id',$user->id);
        return view('delete.delete_child',compact('user','child'));
    }

       // 保護者退会を処理
       public function destroyUser(Request $request, User $user){
            // ログイン中の子供のIDとリレーション
            $children = Child::where('user_id',$user->id)->get();
            // メールと電話番号の認証
            if(Auth::user()->email == $request->email && Auth::user()->tel == $request->tel)
            {
                // ログイン中の子供をリレーションして削除
                Child::where('user_id',$user->id)->delete();
                // 子供が１アカウントで複数いる場合
                foreach($children as $child)
                {
                    // 子供とブログをリレーションして削除
                    $blogs = Blog::where('child_id',$child->id)->get();
                    Blog::where('child_id',$child->id)->delete();
                    foreach($blogs as $blog)
                    {
                        Comment::where('blog_id',$blog->id)->delete();
                    }
                }
                $user->delete();
                Auth::logout();
                Session::put('message', 'アカウントを削除しました!');
                return redirect()->route('deleted');

            } else {
                Session::put('message', '入力された情報に誤りがあります!');
                return redirect()->route('user.delete',Auth::id());
            }
        }
    // 子供追加画面を表示
    public function createChild(User $user){
        if (Auth::user()->id !== $user->id|| Auth::user()->role !== 1) {
            return redirect()->route('home');
        }
        return view('child.add_profile',compact('user'));
    }
    // 追加の子供を処理
    public function storeChild(ChildrenUpdateRequest $request ,User $user){
        $child = new Child();
        $child->fill([
        'name'=>$request->child_name,
        'nickname'=>$request->nickname,
        'birthday' => $request->birthday,
        'gender' => $request->gender,
        'user_id' => $user->id,
        'school_id' => $user->school_id,
        
        ]);
        if (isset($request->image)) {
            $path = $request->image->store('image', 'public');
            $child->image = $path;
        }
        $child->save();
        return redirect()->route('children.show',Auth::id());
    }
    // 子供削除を処理
    public function destroy(Child $child){
        $child->where('id',Blog::first()->child_id);
        $child->delete();
        Session::put('delete', '削除しました!');
        return redirect()->route('home',compact('child'));
    }
}
