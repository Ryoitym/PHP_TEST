<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>データベース操作サンプル</title>
</head>
<body>
<form action="insert_exec.php" method="post">
名前（漢字）: <input type="text" name="name_kanji"><br>
名前（かな）: <input type="text" name="name_kana"><br>
会社: <select name="company_id">
        <option value="1">コアテック</option><br>
        <option value="2">エフ.ティ.スクエア</option><br>
        <option value="3">コアソフト</option><br>
        <option value="4">ダイナテック</option><br>
            
<input type="submit">
</form>

</body>
</html>
