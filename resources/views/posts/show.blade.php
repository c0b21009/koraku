<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"?>
    <head>
        <meta charset="utf-8">
        <title>original web application</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    </head>
    
    <body>
        <h1 class="title">
            {{ $event->title }}
        </h1>
        <div class="content">
            <div class="content__posts">
                <h3>ジャンル</h3>
                <p >{{ $event->jenre->name }}</p>
                <h3>日時</h3>
                <p>{{ $event->start_time->format('m/d H:i') }}~{{ $event->end_time->format('n/j H:i') }}</p>
                <h3>場所</h3>
                <p>{{ $event->location }}</p>
                <h3>活動内容</h3>
                <p>{{ $event->event_content }}</p>
                <h3>持ち物</h3>
                @if($event->items->isNotEmpty())
                    @php
                    $count = 0;
                    @endphp
                    @foreach ($event->items as $key => $item)
                        {{ $item->name }}@if(!$loop->last && ($count + 1) % 5 !== 0),@endif
                        @php
                        $count++;
                        @endphp
                        @if (($count) % 5 === 0 && !$loop->last)
                            <br>
                        @endif
                    @endforeach
                @else
                    <p>No items</p>
                @endif
                
                
                <h3 class="text-lg font-bold mb-2">タイムスケジュール</h3>
                @if ($event->times->isNotEmpty())
                    <div class="time-schedule flex flex-col"> <!-- Flexの方向を縦（column）に変更 -->
                        @foreach ($event->times as $index => $time)
                            <div class="time-schedule-item flex flex-col"> <!-- 各時間スケジュールを縦（column）に変更 -->
                                <div class="time bg-gray-100 border border-gray-300 rounded-lg p-2 mr-4 mb-4">
                                    <p class="text-sm font-semibold">{{ \Carbon\Carbon::parse($time->datetime)->format('n/j H:i') }}</p>
                                </div>
                                <div class="schedule bg-gray-100 border border-gray-300 rounded-lg p-2 mr-4 mb-4">
                                    <p class="text-sm">{{ $time->schedule }}</p>
                                </div>
                            </div>
                            <br> <!-- 各時間スケジュールの間に改行を追加 -->
                        @endforeach
                    </div>
                @else
                    <p>No schedule</p>
                @endif

            <div>
                
                
                
                
            </div>
            </div>
            
        </div>
        
        <div class="footer">
            @if(Auth::user()->group_id === $event->group_id)
                <div class="edit"><a href="/posts/{{ $event->id }}/edit">編集</a></div>
            @else
            @endif
           <a href="/posts">戻る</a>
        </div>
    </body>
    
</html>