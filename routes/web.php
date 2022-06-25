<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|

| 
| index:一覧画面(get)
| create:登録画面(get)
| store:登録(post)
| show:詳細画面(get)
| edit:編集画面(get)
| update:編集(put)
| destroy:削除(delete)
*/


// 動詞	URI	アクション	ルート名
// GET	/photos	index	photos.index
// GET	/photos/create	create	photos.create
// POST	/photos	store	photos.store
// GET	/photos/{photo}	show	photos.show
// GET	/photos/{photo}/edit	edit	photos.edit
// PUT/PATCH	/photos/{photo}	update	photos.update
// DELETE	/photos/{photo}	destroy	photos.destroy

Route::get('/', function () {
    return redirect()->route('home');
});


    Auth::routes();
Route::middleware('auth')->group(function () {
    
    // ユーザ登録機能をオフに切替
    // Auth::routes(['register' => false ]);

    // Route::resource('schools','SchoolController');

    // 施設ユーザーのトップページ
    Route::get('/schools','SchoolController@index')->name('schools.index');

    
    // 保護者ユーザーのトップページ
    Route::get('children','ChildController@index')->name('children.index');

   
    // -----------------------------------------school退会---------------------------------------------------------
    // // 施設退会画面表示
    Route::get('/schools/{school}/delete','SchoolController@delete')->name('schools.delete');
    // 施設退会処理
    Route::delete('/schools/{school}','SchoolController@destroy')->name('schools.destroy');


    // 施設詳細を表示
    Route::get('/schools/{school}','SchoolController@show')->name('schools.show');
    // 施設編集画面を表示
    Route::get('/schools/{school}/edit','SchoolController@edit')->name('schools.edit');
    // 施設編集の処理
    Route::put('/schools/{school}','SchoolController@update')->name('schools.update');


    // 動詞	URI	アクション	ルート名
    // GET	/photos	index	photos.index
    // GET	/photos/create	create	photos.create
    // POST	/photos	store	photos.store
    // GET	/photos/{photo}	show	photos.show
    // GET	/photos/{photo}/edit	edit	photos.edit
    // PUT/PATCH	/photos/{photo}	update	photos.update
    // DELETE	/photos/{photo}	destroy	photos.destroy


    // 保護者詳細を表示
    Route::get('/children/{user}','ChildController@show')->name('children.show');
    // 保護者詳細を編集画面表示
    Route::get('/child/{child}/edit','ChildController@edit')->name('children.edit');
    // 保護者詳細を編集処理
    Route::put('/child/{child}','ChildController@update')->name('children.update');
    // 保護者　お子様追加画面を表示
    Route::get('/child/{user}/create','ChildController@createChild')->name('child.create');
    // 子供追加　登録処理
    Route::post('/children/{user}','ChildController@storeChild')->name('child.store');
    // -----------------------------------------child退会---------------------------------------------------------
    // 保護者退会画面表示
    Route::get('/children/{user}/delete','ChildController@delete')->name('user.delete');
    // 保護者退会を処理
    Route::delete('/children/{user}','ChildController@destroyUser')->name('user.destroy');
    // 子供削除を処理
    Route::delete('/children/{child}/delete','ChildController@destroy')->name('children.destroy');


    // ---------------------------------------BOARD----------------------------------------------------------------
    // board記事を表示
    Route::get('/board/index','BoardController@index')->name('boards.index');
    // board記事作成画面を表示
    Route::get('/board/create','BoardController@create')->name('boards.create');
    // board記事作成　処理
    Route::post('/boards','BoardController@store')->name('boards.store');
    // 掲示板内容を表示
    Route::get('/boards/{board}','BoardController@show')->name('boards.show');
    // board記事編集画面を表示
    Route::get('boards/{board}/edit','BoardController@edit')->name('boards.edit');
    // board記事編集処理
    Route::put('/board/{board}','BoardController@update')->name('boards.update');
    // boardを削除
    Route::delete('/boards/{board}','BoardController@destroy')->name('boards.destroy');

    // -----------------------------------------BLOG---------------------------------------------------------------
    // Blog一覧を表示
    Route::get('/blog/{id}','BlogController@index')->name('blogs.index');
    // Blog記事作成画面を表示
    Route::get('/blogs/create/{child_id}','BlogController@create')->name('blogs.create');
    // blogを作成
    Route::post('/blogs/store','BlogController@store')->name('blogs.store');
    // blog詳細を表示
    Route::get('/blogs/{blog}','BlogController@show')->name('blogs.show');
    // Blog記事編集画面を表示
    Route::get('/blogs/{blog}/edit','BlogController@edit')->name('blogs.edit');
    // blogを編集
    Route::put('/blogs/{blog}','BlogController@update')->name('blogs.update');
    // blogを削除
    Route::delete('/blogs/{blog}','BlogController@destroy')->name('blogs.destroy');
    // -----------------------------------------COMMENT---------------------------------------------------------------
    // コメント画面表示させる
    // Route::get('/comment','CommentController@index')->name('comment.index');
    // コメント入力処理
    // Route::post('/add','CommentController@add')->name('comment.add');
    // CommentController . phpにjsonを返すgetData()
    Route::get('blogs/result/ajax/{blog_id}/{comment}', 'CommentController@getData')->name('get.data');
    // コメント削除を処理
    Route::delete('/comment/delete/{comment_id}', 'CommentController@destroy')->name('comment.destroy');
    // 検索機能
    Route::get('/user/index/{id}', 'SchoolController@getUsersBySearchName'); // url: '/user/index/' + userNameと同じ

});
// 保護者登録画面を表示
Route::get('/children/create', 'ChildController@create')->name('children.create');
// 保護者登録(施設登録)
Route::post('/children', 'ChildController@store')->name('children.store');
// -----------------------------------------------------------------------------------------------

// 施設登録画面を表示
Route::get('/schools/create', 'SchoolController@create')->name('schools.create');
// 施設登録(施設登録)
Route::post('/schools', 'SchoolController@store')->name('schools.store');
// -------------------------------------------------------------------------------------------------------------
// 退会完了を表示
Route::view('/deleted','delete.delete')->name('deleted');

// Login画面
Route::get('/home', 'HomeController@index')->name('home');
