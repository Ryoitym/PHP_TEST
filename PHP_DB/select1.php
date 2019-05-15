<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>データベース操作サンプル</title>
</head>
<body>
    <h1>候補者一覧</h1><br>
<?php
    require_once("function.php");
    $dbh = connectDb();

    try {
        // SQLを構築
        $sql = "SELECT * FROM student
        INNER JOIN company ON student.company_id=company.company_id";
        $sth = $dbh->prepare($sql); // SQLを準備

        // SQLを発行
        $sth->execute();
    } catch (PDOException $e) {
        exit("SQL発行エラー：{$e->getMessage()}");
    }
?>
<form action="select2.php"method="post">
検索：<input type="text" name="name_kanji">
<input type="submit">
</form>

<table border="1">
    <tr>
        <th>ID</th>
        <th>名前（漢字）</th>
        <th>名前（かな）</th>
        <th>会社名</th>
        <th>リストラ</th>
        <th>編集</th>
    </tr>
    <?php while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {?>
    <tr>
        <td><?php ph($row["student_id"]);?></td>
        <td><?php ph($row["name_kanji"]);?></td>
        <td><?php ph($row["name_kana"]);?></td>
        <td><?php ph($row["company_name"]);?></td>
        <td><a href="delete_exec.php?student_id=<?php 
            ph($row["student_id"]);
        ?>">クビ</a></td>
        <td><a href="update.php?student_id=<?php 
            ph($row["student_id"]);
        ?>">編集</a></td>
    </tr>
    <?php } ?>
    
    <br>
    <h2>人事部</h2>
</table>
<p><a href="insert.php">新規追加</a></p>
</body>
</html>
