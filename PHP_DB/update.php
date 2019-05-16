<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>データベース操作サンプル</title>
</head>
<body>
<?php
    require_once("function.php");
    $dbh = connectDb();

    try {
        // プレースホルダ付きSQLを構築
        $sql = "SELECT * FROM student ";
        $sql .= "WHERE student_id=:student_id";
        $sth = $dbh->prepare($sql); // SQLを準備

        // プレースホルダに値をバインド
        $sth->bindValue(":student_id", $_GET["student_id"]);

        // SQLを発行
        $sth->execute();

        // 結果データを取得
        $row = $sth->fetch(PDO::FETCH_ASSOC);

        // 結果データがない場合
        if (empty($row)) {
            exit("不正なアクセスをしました");
        }

        $sql_com = "SELECT * FROM company";
        $sth_com = $dbh->prepare($sql_com); // SQLを準備

        // SQLを発行
        $sth_com->execute();

    } catch (PDOException $e) {
        exit("SQL発行エラー：{$e->getMessage()}");
    }
?>

<form action="update_exec.php" method="post">
名前（漢字）: <input type="text" name="name_kanji"     value="<?php ph($row["name_kanji"]);?>"><br>
名前（かな）: <input type="text" name="name_kana"     value="<?php ph($row["name_kana"]);?>"><br>
会社名: <select name="company_id">
        <?php while ($row_com = $sth_com->fetch(PDO::FETCH_ASSOC)) {?>
        <option value="<?php ph($row_com["company_id"]);?>"
        <?php if ($row["company_id"] == $row_com["company_id"]) { print "selected";}?>>
        <?php ph($row_com["company_name"]);?>
        </option>
        <?php } ?>
<input type="hidden" name="student_id" value="<?php ph($row["student_id"]);?>">

<input type="submit">


</form>
</body>
</html>