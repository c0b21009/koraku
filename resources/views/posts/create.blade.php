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

                <input type="text" name="post[title]" placeholder="タイトル" value="{{ old('event.title') }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('event.title') }}</p>

            </div>
            
            <div class="time">
                <h2>日時</h2>
                開始:<input type="datetime-local" name="event[start_time]"/>
                終了:<input type="datetime-local" name="event[end_time]"/>

                <p class="title__error" style="color:red">{{ $errors->first('event.start_time') }}</p>
                <p class="title__error" style="color:red">{{ $errors->first('event.end_time') }}</p>

            </div>
            
            <div class="location">
                <h2>場所</h2>
                <input type="text" name="event[location]" placeholder="○○公園"/>
                <p class="title__error" style="color:red">{{ $errors->first('event.location') }}</p>
            </div>
            
            <div>
                <!-- ジャンルプルダウン -->
                <select name="event[jenre_id]">
                    <option value="">選択してください</option >
                    @foreach($jenres as $jenre)
                    <option value="{{ $jenre->id }}">{{ $jenre->name }}</option>
                    @endforeach

                    <p class="title__error" style="color:red">{{ $errors->first('event.jebre_id') }}</p>

                </select>
                <x-input-error :messages="$errors->get('jenre_id')" class="mt-2" />
            </div>
            <div class="event_content">
                <h2>活動内容</h2>
                <textarea name="event[event_content]" placeholder="○○の季節になりました！~~をしませんか？"></textarea>
                <p class="event_content__error" style="color:red">{{ $errors->first('event.event_content')}}</p>
            </div>
            <div id="app">
                <h2>持ち物</h2>
            <div id="input_fields">
                <!-- 最初の入力フィールド -->
                <div>
                    <input type="text" name="items[]" value="">
                    <button type="button" class="btn btn-danger remove_field">削除</button>
                </div>
            </div>

            <button type="button" class="btn btn-success add_field">追加</button>
            <br>
            <input type="submit" value="投稿"/>
        </form>
            
            
        <div class="footer">
            <a href="/posts">戻る</a>
        </div>
        <!-- 確認用 -->
                <hr>
                <label>textsの中身</label>
                <div v-text="texts"></div>
                <script src="https://cdn.jsdelivr.net/npm/vue@2.6.11"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
        <!--Vueの定義-->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                // 追加ボタンがクリックされた時の処理
                $(".add_field").click(function() {
                    $("#input_fields").append('<div><input type="text" name="items[]" value=""><button type="button" class="btn btn-danger remove_field">削除</button></div>');
                });
        
                // 削除ボタンがクリックされた時の処理
                $("#input_fields").on("click", ".remove_field", function() {
                    $(this).parent('div').remove();
                });
            });
        </script>

    </body>
</html>