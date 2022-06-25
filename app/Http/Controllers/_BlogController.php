<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    // -----------Blog-----------------

    // schoolからblog画面を表示
    public function show(){
        return view('blog.blog_show');
    }
    // blogの記事作成画面を表示
    public function create(){
        return view('blog.create_blog');
    }
    // blogの記事編集画面を表示
    public function editblog(){
        return view('blog.edit_blog');
    }
}
