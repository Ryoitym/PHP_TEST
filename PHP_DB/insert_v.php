<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>データベース操作サンプル</title>
</head>
<body>
    <form action="insert.php" method="post">
        名前（漢字）: <input type="text" name="name_kanji"><br>
        名前（かな）: <input type="text" name="name_kana"><br>
        会社: <select name="company_id">
        <?php while($row_c = $c_sth->fetch(PDO::FETCH_ASSOC)){;?>
            <option value="<?php ph($row_c["company_id"]);?>"><?php ph($row_c["company_name"]);?></option>
        <?php }?>
        </select>
        <input type="submit">
    </form>
<p><a href="select.php">トップページに戻る</a></p>
</body>
</html>