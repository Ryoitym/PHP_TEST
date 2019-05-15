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
        $sql = "DELETE FROM student ";
        $sql .= "WHERE student_id=:student_id";
        $sth = $dbh->prepare($sql); // SQLを準備

        // プレースホルダに値をバインド
        $sth->bindValue(":student_id", $_GET["student_id"]);

        // SQLを発行
        $sth->execute();
    } catch (PDOException $e) {
        exit("SQL発行エラー：{$e->getMessage()}");
    }
?>
<p>クビにしました。</p>
<p><a href="select1.php">リストラリストに戻る</a></p>
</body>
</html>
