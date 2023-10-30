<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Jenre;
use Illuminate\Support\Facades\Auth;
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
    public function store(Request $request, Event $event)
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
}