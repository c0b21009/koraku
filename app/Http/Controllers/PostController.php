<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Jenre;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
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
    public function show(Event $event, Jenre $jenre)
    {
        return view('posts.show')->with(['event' => $event, 'jenre' => $jenre->get()]);
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
        $newEvent = $event->create($input);

        foreach($request->items as $name) {
            $newEvent->items()->create(['name' => $name]);
        }
        return redirect('/posts/' .$event->id);
    }
    public function edit(Event $event, Jenre $jenre)
    {
        return view('posts.edit')->with(['event' => $event, 'jenres' => $jenre->get()]);
    }
    public function update(PostRequest $request, Event $event, Item $item)
    {
        $input_post = $request['event'];
        $event->fill($input_post)->save();
        
        
        return redirect('/posts/' . $event->id);
    }
    
    public function delete(Event $event)
    {
        $event->delete();
        return redirect('/posts');
    }
}