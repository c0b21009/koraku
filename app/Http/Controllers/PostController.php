<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Jenre;
//ログイン中のuser_idを取得するため
use Illuminate\Support\Facades\Auth;
//バリデーションのため
use App\Http\Requests\PostRequest;
/**
 * Post一覧を表示する
 * 
 * @param Event Eventモデル
 * @return array Eventモデルリスト
 */
class PostController extends Controller
{
    public function index(Event $event)
    {
        //投稿内容をデフォルトではなくgetByLimitで表示
        return view('posts.index')->with(['events' => $event->getPaginateByLimit()]);
    }
    public function show(Event $event)
    {
        return view('posts.show')->with(['event' => $event]);
    }
    public function create(Jenre $jenre)
    {
        //ジャンル一覧
        return view('posts.create')->with(['jenres' => $jenre->get()]);
    }

    public function store(PostRequest $request, Event $event)
    {
        $input = $request['event'];
        $userinfo = [
        'user_id' => Auth::id(),
        'group_id' => Auth::user()->group_id,
        ];
        $input = $input + $userinfo;
        //dd($input);
        $event->fill($input)->save();
        return redirect('/posts/' .$event->id);
    }
    public function edit(Event $event, Jenre $jenre)
    {
        return view('posts.edit')->with(['event' => $event, 'jenres' => $jenre->get()]);
    }
    public function update(PostRequest $request, Event $event)
    {
        $input_post = $request['event'];
        $event->fill($input_post)->save();
        
        return redirect('/posts/' . $event->id);
    }
}