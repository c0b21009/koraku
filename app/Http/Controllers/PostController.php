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
        return $event->get();
    }
}