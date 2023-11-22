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
    
        $event->fill($input)->save(); // ここで既存の $event を更新しています
        if ($request->items !== null){
            foreach ($request->items as $name) {
                if ($name !== null && $name !== '') {
                    $event->items()->create(['name' => $name]);
                }
            }
        }
        $validatedData = $request->validate([
            'datetimes.*' => 'required|date',
            'schedules.*' => 'required|string',
        ]);
        
        if (isset($validatedData['datetimes'])) {
            foreach ($validatedData['datetimes'] as $key => $datetime) {
                $event->times()->create([
                    'datetime' => $datetime,
                    'schedule' => $validatedData['schedules'][$key], // 各時間に関連付けたいスケジュールを指定
                ]);
            }
        }

        
        return redirect('/posts/' . $event->id);
    }
    public function edit(Event $event, Jenre $jenre)
    {
        return view('posts.edit')->with(['event' => $event, 'jenres' => $jenre->get()]);
    }
    public function update(PostRequest $request, Event $event)
    {
        $input = $request->validated();
        $userinfo = [
            'user_id' => Auth::id(),
            'group_id' => Auth::user()->group_id,
        ];
        $input = $input + $userinfo;
    
        $event->fill($input)->save(); // 既存の $event を更新
    
        if ($request->has('items')) {
            $event->items()->delete(); // 現在のアイテムを全て削除
            foreach ($request->items as $name) {
                if ($name !== null && $name !== '') {
                    $event->items()->create(['name' => $name]); // 新しいアイテムを作成
                }
            }
        }
    
        $validatedData = $request->validate([
            'datetimes.*' => 'required|date',
            'schedules.*' => 'required|string',
        ]);
    
        if ($request->has('datetimes') && $request->has('schedules')) {
            $event->times()->delete(); // 現在の時間を全て削除
            foreach ($validatedData['datetimes'] as $key => $datetime) {
                $event->times()->create([
                    'datetime' => $datetime,
                    'schedule' => $validatedData['schedules'][$key],
                ]);
            }
        }
    
        return redirect('/posts/' . $event->id);
    }
    
    public function delete(Event $event)
    {
        $event->delete();
        return redirect('/posts');
    }
}