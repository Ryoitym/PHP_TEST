<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>データベース操作サンプル</title>
</head>
<body>
<?php if(empty($_POST)){
    require_once("function.php");
    $dbh = connectDb();

    try {
        //companyセレクトのSQLを作成
        $c_sql = "SELECT * FROM company";
        $c_sth = $dbh->prepare($c_sql);
        $c_sth->execute();

    } catch (PDOException $e) {
        exit("SQL発行エラー：{$e->getMessage()}");
    }
    ?>
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
<?php } else{ 
      if(empty($_POST["name_kanji"])||empty($_POST["name_kana"])||empty($_POST["company_id"])){
        print "すべての項目を入力してください。"; 
        require_once("function.php");
        $dbh = connectDb();

        try {
            //companyセレクトのSQLを作成
            $c_sql = "SELECT * FROM company";
            $c_sth = $dbh->prepare($c_sql);
            $c_sth->execute();

        } catch (PDOException $e) {
            exit("SQL発行エラー：{$e->getMessage()}");
        }?>

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
    <?php } else{ 
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
    }
     }?> 
</form>
<p><a href="select1.php">トップページに戻る</a></p>
</body>
</html>
