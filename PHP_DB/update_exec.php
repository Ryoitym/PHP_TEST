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
        $sql = "UPDATE student ";
        $sql .= "SET name_kanji=:name_kanji, name_kana=:name_kana, company_id=:company_id ";
        $sql .= "WHERE student_id=:student_id";
        $sth = $dbh->prepare($sql); // SQLを準備

        // プレースホルダに値をバインド
        $sth->bindValue(":name_kanji",$_POST["name_kanji"]);
        $sth->bindValue(":name_kana",$_POST["name_kana"]);
        $sth->bindValue(":company_id",$_POST["company_id"]);
        $sth->bindValue(":student_id",$_POST["student_id"]);

        // SQLを発行
        $sth->execute();
    } catch (PDOException $e) {
        exit("SQL発行エラー：{$e->getMessage()}");
    }
?>
<p>編集しました。</p>
<p><a href="select1.php">トップページに戻る</a></p>
</body>
</html>
