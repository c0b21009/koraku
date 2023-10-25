<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale())}}">
    <head>
        <meta charset="utf-8">
        <title>こらく</title>
    </head>
    <body>
        <h1>こらく</h1>
        <from action="/posts" method="POST">
            @csrf
            <div class="title">
                <h2>Title</h2>
                <input type="text" name="event[title]" placeholder="タイトル"/>
            </div>
            <div class="time">
                <h2>日時</h2>
                開始:<input type="datetime-local" name="event[start_time]"/>
                終了:<input type="datetime-local" name="event[end_time]"/>
            </div>
            <div class="location">
                <h2>場所</h2>
                <input type="text" name="event[location]" placeholder="○○公園"/>
            </div>
            <div class="jenre">
                <h2>ジャンル</h2>
                <input type="text" name="event[jenre_id]" placeholder="タイトル"/>
            </div>
            <div class="event_content">
                <h2>活動内容</h2>
                <textarea name="event[event_content]" placeholder="○○の季節になりました！~~をしませんか？"></textarea>
            </div>
            <input type="submit" value="投稿"/>
        </from>
        <div class="footer">
            <a href="/posts">戻る</a>
        </div>
    </body>
</html>