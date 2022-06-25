<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Child;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Http\Requests\BlogStoreRequest;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // $idは子供のID。
    public function index($id)
    {
        $child = Child::firstWhere('id',$id);
        $blogs = Blog::where('child_id',$id)->paginate(9);

        return view('blog.index',compact('blogs','child'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // blogの記事作成画面を表示
    public function create($child_id)
    {
       
        $child = Child::where('id',$child_id)->first();
        return view('blog.create',compact('child'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogStoreRequest $request)
    {
        $blog = new Blog();
        $blog->fill([
            'school_id' => $request->school_id,
            'child_id' => $request->child_id,
            'title' => $request->title,
            'comment' => $request->comment,
        ]);
        $blog->save();

        Session::put('message','ブログを投稿しました！');
        return redirect()->route('blogs.show',$blog->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    // ブログ詳細画面を表示
    public function show(Blog $blog)
    {
        if (Auth::id() !== $blog->id) {
            return redirect()->route('home');
        }
        $child = Child::find($blog->child_id)->first();
        $comments = Comment::where('blog_id',$blog->id)->orderBy('id','asc')->get() ;

        return view('blog.show',compact('blog','child','comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    // blogの記事編集画面を表示
    public function edit(Blog $blog)
    {
        if (Auth::id() !== $blog->id) {
            return redirect()->route('home');
        }
        return view('blog.edit',compact("blog"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(BlogStoreRequest $request, Blog $blog)
    {
        $blog->fill([
            'title' => $request->title,
            'comment' => $request->comment,
        ]);
        $blog->save();

        Session::put('message','ブログを編集しました！');
        return redirect()->route('blogs.show',$blog->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $child_id = $blog->child_id;
        $child_id->delete();
        Session::put('message','ブログを削除し増した！');
        return redirect()->route('blogs.index');
    }
}
