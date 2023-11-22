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
                <h3>日時</h3>
                <p>{{ $event->start_time->format('m/d H:i') }}~{{ $event->end_time->format('m/d H:i') }}</p>
                <h3>場所</h3>
                <p>{{ $event->location }}</p>
                <h3>活動内容</h3>
                <p>{{ $event->event_content }}</p>
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