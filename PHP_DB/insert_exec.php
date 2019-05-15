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
        
        $sql = "INSERT INTO student (name_kanji, name_kana, company_id) ";
        $sql .= "VALUES (:name_kanji, :name_kana, :company_id)";
        $sth = $dbh->prepare($sql); // SQLを準備

        // プレースホルダに値をバインド
        if(!Empty($_POST["name_kanji"])){
            $sth->bindValue(":name_kanji",$_POST["name_kanji"]);
        }else{?>
            <script> alert("名前を入力してください！"); </script>
        <?php }
        
        $sth->bindValue(":name_kana",$_POST["name_kana"]);
        $sth->bindValue(":company_id",$_POST["company_id"]);

        // SQLを発行
        $sth->execute();
    } catch (PDOException $e) {
        exit("SQL発行エラー：{$e->getMessage()}");
    }
?>
<p>新規追加しました。</p>
<p><a href="select1.php">トップページに戻る</a></p>
</body>
</html>
