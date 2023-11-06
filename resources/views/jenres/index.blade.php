<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"?>
    <head>
        <meta charset="utf-8">
        <title>original web application</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>こらく!!!</h1>
        <div class="posts">
            <a href='/posts/create'>create</a>
            <a href="/posts">戻る</a>
            @foreach ($events as $event)
            <div class="posts">
                <h2 class="title">
                    <a href="/posts/{{ $event->id }}">{{ $event->title }}</a><br>
                    <a href="/jenres/{{ $event->jenre->id }}">{{ $event->jenre->name }}</a>
                </h2>
                <p class="body">{{ $event->event_content  }}</p>
                <form action="/posts/{{ $event->id }}" id="form_{{ $event->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="deletePost({{ $event->id }})">削除</button> 
                </form>
            </div>
            @endforeach
        </div>
        <div class="paginate">
            {{ $events->links() }}
        </div>
        <script>
            function deletePost(id) {
                'use strict'
        
                if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
    </body>
</html>