<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>こらく</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <h1>こらく</h1>
    <form action="/posts" method="POST">
        @csrf

        <div id="app">
            <h2>日時と予定</h2>
            <div id="input_fields">
                <!--入力 -->
                <div>
                    <label for="datetime1">日時:</label>
                    <input type="datetime-local" id="datetime1" name="datetimes[]">

                    <label for="schedule1">予定:</label>
                    <input type="text" id="schedule1" name="schedules[]">

                    <button type="button" class="btn btn-danger remove_field">削除</button>
                </div>
            </div>

            <button type="button" class="btn btn-success add_field">追加</button>
        </div>
    </form>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var counter = 1; // カウンターを初期化

            $(".add_field").click(function() {
                counter++; // カウンターをインクリメント
                var newField = `
                    <div>
                        <label for="datetime${counter}">日時:</label>
                        <input type="datetime-local" id="datetime${counter}" name="datetimes[]">

                        <label for="schedule${counter}">予定:</label>
                        <input type="text" id="schedule${counter}" name="schedules[]">

                        <button type="button" class="btn btn-danger remove_field">削除</button>
                    </div>
                `;

                // 新しい日時と予定のフィールドを追加
                $("#input_fields").append(newField);

                // 前の日時の値を取得して、新しい日時フィールドの初期値として設定
                var prevDateTime = $(`#datetime${counter - 1}`).val();
                $(`#datetime${counter}`).val(prevDateTime);
            });

            $("#input_fields").on("click", ".remove_field", function() {
                $(this).parent('div').remove();
            });
        });
    </script>
</body>
</html>
