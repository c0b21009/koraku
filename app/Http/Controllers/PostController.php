<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Jenre;
use App\Models\Item;
use App\Models\Time;
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
    
        $event->fill($input)->save(); // ここで既存の $event を更新しています
        if ($request->items !== null){
            foreach ($request->items as $name) {
                if ($name !== null && $name !== '') {
                    $event->items()->create(['name' => $name]);
                }
            }
        }
        if (isset($validatedData['datetimes'])) {
            $validatedData = $request->validate([
                'datetimes.*' => 'required|date',
                'schedules.*' => 'required|string',
            ]);
            
            foreach ($validatedData['datetimes'] as $key => $datetime) {
                $event->times()->create(['datetime' => $datetime, 'schedule' => $validatedData['schedules'][$key]]);
            }
        }
        
        return redirect('/posts/' . $event->id);
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