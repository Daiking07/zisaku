<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchoolStoreRequest;
use App\Http\Requests\SchoolUpdateRequest;
use App\Models\Blog;
use App\Models\Board;
use App\Models\Child;
use App\Models\School;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
class SchoolController extends Controller
{
    public function create()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        return view('auth.create_school');
    }

    public function store(SchoolStoreRequest $request)
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }
        // スクールテーブルにcode,name,principal,postal_code,pref_id,city,town,building,founding,を登録処理↓
        $school = new School();
        $school->fill([
            'code' => $request->code,
            'name' => $request->school_name,
            'principal' => $request->principal,
            'postal_code' => $request->postal_code,
            'pref_id' => $request->pref_id,
            'city' => $request->city,
            'town' => $request->town,
            'building' => $request->building,
            'founding' => $request->founding,
        ]);
        // バリデーション後の処理
       $school->save();

        // ユーザテーブルにshool_id,email,password,tel登録処理↓
        $user = new User();
        $user->fill([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'tel' => $request->tel,
            'school_id' => $school->id,
        ]);
        $user->save();


        Session::put('message', '登録完了しました! あなたの施設ID:'.$school->code);
        return redirect()->route('home');
    }

    // ログイン後ページ
    public function index(){
        if(Auth::user()->role !== 0){
            return redirect()->route('home');
        }
        $children = Child::where('school_id',Auth::id())->get();

        // // 年齢の計算
        // $birthday = str_replace("-", "", $children->birthday);
        // $today = date('Ymd');
        // $age = floor(($today - $birthday) / 10000);

        return view('school.index',compact('children'));
    }

    //　school退会画面
    public function delete(School $school){
        return view('delete.delete_school',compact('school'));
    }
      //　school退会処理
      public function destroy(Request $request,School $school){
        if(Auth::user()->email == $request->email && Auth::user()->tel == $request->tel && $school->code == $request->code)
        {

            Board::where('school_id',$school->id)->delete();
            Child::where('school_id', $school->id)->delete();
            Blog::where('school_id', $school->id)->delete();
            User::where('school_id', $school->id)->delete();
            $school->delete();

            Auth::logout();
            Session::put('message', 'アカウントを削除しました!');
            return redirect()->route('deleted',Auth::id());
        } else {
            Session::put('message', '入力された情報に誤りがあります!');
            return redirect()->route('schools.delete',compact('school'));
        }
    }  


    // 施設画面を表示
    public function show(School $school)
    {
        if (Auth::user()->role !== 0 || Auth::user()->school_id !== $school->id) {
            return redirect()->route('home');
        } 

        return view('school.show',compact('school'));
    }
    // 施設編集画面を表示
    public function edit(School $school)
    {
        if (Auth::user()->role !== 0 || Auth::user()->school_id !== $school->id) {
            return redirect()->route('home');
        } 
        return view('school.edit',compact('school'));
    }

    // 施設編集処理
    public function update(SchoolUpdateRequest $request,School $school)
    {
        $user = Auth::user();
        $school->fill([
            // 'code' => $request->code,
            'name' => $request->school_name,
            'principal' => $request->principal,
            'postal_code' => $request->postal_code,
            'pref_id' => $request->pref_id,
            'city' => $request->city,
            'town' => $request->town,
            'building' => $request->building,
            'founding' => $request->founding,
        ]);
        // バリデーション後の処理
        $school->save();
        $user->fill([
            'email' => $request->email,
            'tel' => $request->tel,
        ]);
        $user->save();
        return redirect()->route('schools.show',Auth::id());
    }

    public function getUsersBySearchName($id)
    {
        $users =Child::where('name', 'like', '%' . $id . '%')->get(); 
        return response()->json($users);
    }
}
