<html>
<head>
    <title>休日データ</title>
</head>
<body>
    <h1>休日</h1>
    <!-- 休日入力フォーム -->
    <form method="POST" action="/holiday">
    {{csrf_field()}}
    日付: <input type="text" name="day"> [YYYY/MM/DD]
    説明: <input type="text" name="description">
    <input type="submit">
    </form>
    <!-- 休日一覧表示 -->
    <table>
    <tr>
    <th>日付</th>
    <th>説明</th>
    <th>作成日</th>
    <th>更新日</th>
    </tr>
    @foreach($list as $val)
    <tr>
        <td>{{$val->day}}</td>
        <td>{{$val->description}}</td>
        <td>{{$val->created_at}}</td>
        <td>{{$val->updated_at}}</td>
    </tr>
    @endforeach
    </table>
</body>
</html>
