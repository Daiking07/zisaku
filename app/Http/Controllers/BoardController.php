<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Board;
use App\Models\Child;
use App\Models\School;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\BoardStoreRequest;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $boards = Board::where('school_id',Auth::user()->school_id)->paginate(5);
        return view('board',compact('boards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('board.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BoardStoreRequest $request)
    {
        $board = new Board();
        $board->fill([
            'school_id' => Auth::user()->school_id,
            'title' => $request->title,
            'comment' => $request->comment,
        ]);
        $board->save();

        // Session::put('message','掲示板を投稿しました！');
        return redirect()->route('boards.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Board  $school
     * @return \Illuminate\Http\Response
     */
    public function show(Board $board)
    {

        $week_num = \Carbon\Carbon::parse($board->created_at)->format('w');
        $array = array("日","月","火","水","木","金","土");
        $week = $array[$week_num];
        return view('board.show',compact('board','week'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Board  $school
     * @return \Illuminate\Http\Response
     */
    public function edit(Board $board)
    {
        if (Auth::user()->school_id !== $board->id) {
            return redirect()->route('home');
        }
        return view('board.edit',compact('board'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Board  $school
     * @return \Illuminate\Http\Response
     */
    public function update(BoardStoreRequest $request, Board $board)
    {
            $board->fill([
            'school_id' => Auth::user()->school_id,
            'title' => $request->title,
            'comment' => $request->comment,
        ]);
        $board->save();
        return redirect()->route('boards.show',Auth::id());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Board  $school
     * @return \Illuminate\Http\Response
     */
    public function destroy(Board $board)
    {
        $board ->delete();
        Session::put('message','掲示板を削除しました！');
        return redirect()->route('boards.index',Auth::id());
    }
}
