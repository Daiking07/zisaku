<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Child;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $comments = Comment::get();
        // return view('blog.show', compact('comments'));
    }

// CommentController.phpにjsonを返すgetData()
    public function getData($blog_id , $comment)
    {
        $new = new Comment();
        $new->blog_id = $blog_id;
        $new->comment = $comment;
        $new->save();

        $json = Comment::find($new->id);

        return response()->json($json);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ModelsComment  $modelsComment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $Comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ModelsComment  $modelsComment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ModelsComment  $modelsComment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ModelsComment  $modelsComment
     * @return \Illuminate\Http\Response
     */
    public function destroy($comment_id)
    {
        $comment = Comment::findOrFail($comment_id);
        $blog_id = $comment->blog_id;
        $comment->delete();
        Session::put('message', 'コメント削除しました!');
        return redirect()->route('blogs.show',$blog_id);
    }
}
