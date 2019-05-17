<?php 
    if(empty($_POST)){
        //アクセス時の処理
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
        //View表示
        require_once("insert_v.php");

    } else{ 
    //入力時の処理

        //入力が不十分の時
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
            }
            //View表示
            require_once("insert_v.php");

        } else{ 
             //入力値が正常の時
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
            print "<p><a href=\"select1.php\">トップページに戻る</a></p>";
        }
    }

