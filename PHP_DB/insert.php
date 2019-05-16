<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>データベース操作サンプル</title>
</head>
<body>
<?php
    require_once("function.php");

    //POST時、入力が正常時
    if(!empty($_POST["name_kanji"]) && !empty($_POST["name_kana"]) && !empty($_POST["company_id"])){
        require_once("function.php");
            
            $dbh = connectDb();
            try {
                // プレースホルダ付きSQLを構築
                $sql = "INSERT INTO student (name_kanji, name_kana, company_id) ";
                $sql .= "VALUES (:name, :kana, :company_id)";
                $sth = $dbh->prepare($sql); // SQLを準備
        
                // プレースホルダに値をバインド
                $sth->bindValue(":name",     $_POST["name_kanji"]);
                $sth->bindValue(":kana",     $_POST["name_kana"]);
                $sth->bindValue(":company_id", $_POST["company_id"]);
                // SQLを発行
                $sth->execute();
            } catch (PDOException $e) {
                exit("SQL発行エラー：{$e->getMessage()}");
            }
            print "<p>新規追加しました。</p>";
            setcookie("access", 0);
    }
        //アクセス1回目 or 入力ミス時の処理
        elseif(empty($_COOKIE["access"]) || $_COOKIE["access"] == 1){
                $dbh = connectDb();
            
                try {
                    //companyセレクトのSQLを作成
                    $c_sql = "SELECT * FROM company";
                    $c_sth = $dbh->prepare($c_sql);
                    $c_sth->execute();
                } catch (PDOException $e) {
                    exit("SQL発行エラー：{$e->getMessage()}");
                }
                setcookie("access", 1);
?>
<!--<form action="insert_exec.php" method="post">-->
<form action="insert.php" method="post">
名前（漢字）: <input type="text" name="name_kanji"><br>
名前（かな）: <input type="text" name="name_kana"><br>
会社: <select name="company_id">
        <?php while($row_c = $c_sth->fetch(PDO::FETCH_ASSOC)){;?>
            <option value="<?php ph($row_c["company_id"]);?>"><?php ph($row_c["company_name"]);?></option>
        <?php }?>
        <!--<option value="1">コアテック</option><br>
        <option value="2">エフ.ティ.スクエア</option><br>
        <option value="3">コアソフト</option><br>
        <option value="4">ダイナテック</option><br>-->
        </select><br>
<input type="submit"><br>
<?php
    //入力ミス時のエラー表示
    if(isset($_COOKIE["access"]) && $_COOKIE["access"] == 1){
        print "すべての項目を入力してください。";
    }
}?>
</form>
<p><a href="select1.php">トップページに戻る</a></p>
</body>
</html>
