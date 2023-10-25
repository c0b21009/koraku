<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
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
    public function create()
    {
        return view('posts.create');
    }
    public function store(Request $request, Event $event)
    {
        $input = $request['event'];
        $post->fill($input)->save();
        return redirect('/posts/' .$event->id);
    }
}