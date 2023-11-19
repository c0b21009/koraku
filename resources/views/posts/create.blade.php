<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale())}}">
    <head>
        <meta charset="utf-8">
        <title>こらく</title>
    </head>
    
    <body>
        <h1>こらく</h1>
        <form action="/posts" method="POST">
            @csrf
            <div class="title">
                <h2>Title</h2>
                <input type="text" name="event[title]" placeholder="タイトル"/>
                <p class="title__error" style="color:red">{{ $errors->first('event.title')}}</p>
            </div>
            
            <div class="time">
                <h2>日時</h2>
                開始:<input type="datetime-local" name="event[start_time]"/>
                終了:<input type="datetime-local" name="event[end_time]"/>
                <p class="start_time__error" style="color:red">{{ $errors->first('event.start_time')}}</p>
                <p class="end_time__error" style="color:red">{{ $errors->first('event.end_time')}}</p>
            </div>
            
            <div class="location">
                <h2>場所</h2>
                <input type="text" name="event[location]" placeholder="○○公園"/>
                <p class="location__error" style="color:red">{{ $errors->first('event.location')}}</p>
            </div>
            
            <div>
                <!-- ジャンルプルダウン -->
                <select name="event[jenre_id]">
                    <option value="">選択してください</option >
                    @foreach($jenres as $jenre)
                    <option value="{{ $jenre->id }}">{{ $jenre->name }}</option>
                    @endforeach
                    <p class="jenre_id_error" style="color:red">{{ $errors->first('event.jenre_id')}}</p>
                </select>
                <x-input-error :messages="$errors->get('jenre_id')" class="mt-2" />
            </div>
            
            <div class="event_content">
                <h2>活動内容</h2>
                <textarea name="event[event_content]" placeholder="○○の季節になりました！~~をしませんか？"></textarea>
                <p class="event_content__error" style="color:red">{{ $errors->first('event.event_content')}}</p>
            </div>
            
            <div id="app_items">
                <h2>持ち物</h2>
                <div id="input_fields_items">
                    <!--入力 -->
                    <div>
                        <input type="text" name="items[]" value="">
                        <button type="button" class="btn btn-danger remove_field_items">削除</button>
                    </div>
                </div>
    
                <button type="button" class="btn btn-success add_field_items">追加</button>
            </div>
            
            <div id="app_times">
                <h2>日時と予定</h2>
                <div id="input_fields_times">
                    <!--入力 -->
                    <div>
                        <label for="datetime1">日時:</label>
                        <input type="datetime-local" id="datetime1" name="datetimes[]">
    
                        <label for="schedule1">予定:</label>
                        <input type="text" id="schedule1" name="schedules[]">
    
                        <button type="button" class="btn btn-danger remove_field_times">削除</button>
                    </div>
                </div>
    
                <button type="button" class="btn btn-success add_field_times">追加</button>
            </div>
        
            <br>
            <input type="submit" value="投稿"/>
        </form>
        
        <div class="footer">
            <a href="/posts">戻る</a>
        </div>
        
        
        <!--javascript-->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        
        <script>
            $(document).ready(function() {
                // 追加ボタンがクリックされた時の処理
                $(".add_field_items").click(function() {
                    $("#input_fields_items").append('<div><input type="text" name="items[]" value=""><button type="button" class="btn btn-danger remove_field_items">削除</button></div>');
                });
        
                // 削除ボタンがクリックされた時の処理
                $("#input_fields_items").on("click", ".remove_field_items", function() {
                    $(this).parent('div').remove();
                });
            });
        </script>
        
        <script>
            $(document).ready(function() {
                var counter = 1; // カウンターを初期化
        
                $(".add_field_times").click(function() {
                    counter++; // カウンターをインクリメント
                    var newField = `
                        <div>
                            <label for="datetime${counter}">日時:</label>
                            <input type="datetime-local" id="datetime${counter}" name="datetimes[]">
        
                            <label for="schedule${counter}">予定:</label>
                            <input type="text" id="schedule${counter}" name="schedules[]">
        
                            <button type="button" class="btn btn-danger remove_field_times">削除</button>
                        </div>
                    `;
        
                    // 新しい日時と予定のフィールドを追加
                    $("#input_fields_times").append(newField);
        
                    // 前の日時の値を取得して、新しい日時フィールドの初期値として設定
                    var prevDateTime = $(`#datetime${counter - 1}`).val();
                    $(`#datetime${counter}`).val(prevDateTime);
                });
        
                $("#input_fields_times").on("click", ".remove_field_times", function() {
                    $(this).parent('div').remove();
                });
            });
        </script>
        
    </body>
</html>