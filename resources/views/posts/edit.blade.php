<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>こらく - 編集</title>
</head>
<body>
    <h1>こらく - 編集</h1>
    <form action="/posts/{{ $event->id }}" method="POST">
        @csrf
        @method('PUT') <!-- 編集フォームを使用するためのPUTメソッド -->

        <!-- タイトル -->
        <div class="title">
            <h2>Title</h2>
            <input type="text" name="event[title]" placeholder="タイトル" value="{{ $event->title }}">
            <p class="title__error" style="color:red">{{ $errors->first('event.title')}}</p>
        </div>

        <!-- 日時 -->
        <div class="time">
            <h2>日時</h2>
            <!-- 開始と終了時刻をセット -->
            <input type="datetime-local" name="event[start_time]" value="{{ $event->start_time->format('Y-m-d\TH:i') }}">
            <input type="datetime-local" name="event[end_time]" value="{{ $event->end_time->format('Y-m-d\TH:i') }}">
            <p class="start_time__error" style="color:red">{{ $errors->first('event.start_time')}}</p>
            <p class="end_time__error" style="color:red">{{ $errors->first('event.end_time')}}</p>
        </div>

        <!-- 場所 -->
        <div class="location">
            <h2>場所</h2>
            <input type="text" name="event[location]" placeholder="○○公園" value="{{ $event->location }}">
            <p class="location__error" style="color:red">{{ $errors->first('event.location')}}</p>
        </div>

        <!-- ジャンル -->
        <div>
            <select name="event[jenre_id]">
                <option value="">選択してください</option >
                @foreach($jenres as $jenre)
                <!-- 選択されたジャンルを表示 -->
                <option value="{{ $jenre->id }}" {{ $jenre->id === $event->jenre_id ? 'selected' : '' }}>{{ $jenre->name }}</option>
                @endforeach
            </select>
            <p class="jenre_id_error" style="color:red">{{ $errors->first('event.jenre_id')}}</p>
        </div>

        <!-- 活動内容 -->
        <div class="event_content">
            <h2>活動内容</h2>
            <textarea name="event[event_content]" placeholder="○○の季節になりました！~~をしませんか？">{{ $event->event_content }}</textarea>
            <p class="event_content__error" style="color:red">{{ $errors->first('event.event_content')}}</p>
        </div>

        <!-- 持ち物 -->
        <div id="app_items">
            <h2>持ち物(任意)</h2>
            <!-- 各持ち物を表示 -->
            @foreach ($event->items as $item)
                <div>
                    <input type="text" name="items[]" value="{{ $item->name }}">
                    <button type="button" class="btn btn-danger remove_field_items">削除</button>
                </div>
            @endforeach

            <button type="button" class="btn btn-success add_field_items">追加</button>
        </div>

        <!-- 日時と予定 -->
        <div id="app_times">
            <h2>日時と予定(任意)</h2>
            <!-- 各日時と予定を表示 -->
            @foreach ($event->times as $time)
                <div>
                    <label for="datetime1">日時:</label>
                    <input type="datetime-local" id="datetime1" name="datetimes[]" value="{{ $time->datetime }}">
                    <label for="schedule1">予定:</label>
                    <input type="text" id="schedule1" name="schedules[]" value="{{ $time->schedule }}">
                    <button type="button" class="btn btn-danger remove_field_times">削除</button>
                </div>
            @endforeach

            <button type="button" class="btn btn-success add_field_times">追加</button>
        </div>

        <br>
        <input type="submit" value="更新">
    </form>

    <div class="footer">
        <a href="/posts">戻る</a>
    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // 持ち物の追加ボタンがクリックされた時の処理
            $(document).on("click", ".add_field_items", function() {
                var newItemField = '<div><input type="text" name="items[]" value=""><button type="button" class="btn btn-danger remove_field_items">削除</button></div>';
                $(this).before(newItemField);
            });
    
            // 持ち物の削除ボタンがクリックされた時の処理
            $(document).on("click", ".remove_field_items", function() {
                $(this).parent('div').remove();
            });
    
            // 日時と予定の追加ボタンがクリックされた時の処理
            $(document).on("click", ".add_field_times", function() {
                
                var newTimeField = '<div><label>日時:</label><input type="datetime-local" name="datetimes[]"><label>予定:</label><input type="text" name="schedules[]"><button type="button" class="btn btn-danger remove_field_times">削除</button></div>';
                $(this).before(newTimeField);
    
                // 直前の日時フィールドの値を新しい日時フィールドにセットする
                var prevDateTime = $(`#datetime${counter - 1}`).val();
                    $(`#datetime${counter}`).val(prevDateTime);
                });
    
            // 日時と予定の削除ボタンがクリックされた時の処理
            $(document).on("click", ".remove_field_times", function() {
                $(this).parent('div').remove();
            });
        });
    </script>
</body>
</html>
