<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale())}}">
    <head>
        <meta charset="utf-8">
        <title>こらく</title>
    </head>
    <body>
        <h1>編集画面</h1>
        <form action="/posts/{{ $event->id }}" method="POST">
            @csrf
            @method('PUT')
            <div class="title">
                <h2>Title</h2>
                <input type="text" name="event[title]" placeholder="タイトル" value="{{ $event->title }}"/>
            </div>
            <div class="time">
                <h2>日時</h2>
                開始:<input type="datetime-local" name="event[start_time]" value="{{ $event->start_time }}"/>
                終了:<input type="datetime-local" name="event[end_time]" value="{{ $event->end_time }}"/>
            </div>
            <div class="location">
                <h2>場所</h2>
                <input type="text" name="event[location]" placeholder="○○公園" value="{{ $event->location }}"/>
            </div>
            <div>
                <!-- ジャンルプルダウン -->
                <select name="event[jenre_id]">
                    <option value="">選択してください</option >
                    @foreach($jenres as $jenre)
                        @if($jenre->id === $event->jenre_id)
                             <option value="{{ $jenre->id }}" selected>{{ $jenre->name }}</option>
                        @else
                        <option value="{{ $jenre->id }}">{{ $jenre->name }}</option>
                        @endif
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('jenre_id')" class="mt-2" />
            </div>
            <div class="event_content">
                <h2>活動内容</h2>
                <textarea name="event[event_content]" placeholder="○○の季節になりました！~~をしませんか？" >{{ $event->event_content }}</textarea>
            </div>
            <input type="submit" value="編集完了"/>
        </form>
        <div class="footer">
            <a href="/posts">戻る</a>
        </div>
    </body>
</html>