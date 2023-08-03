<?php
//0. SESSION開始！！
session_start();
//１．PHP
//select.phpの[PHPコードだけ！]をマルっとコピーしてきます。
//※SQLとデータ取得の箇所を修正します。
$id = $_GET["id"];

include("funcs.php");  //funcs.phpを読み込む（関数群）
// $pdo = db_conn();      //DB接続関数
try {
    //Password:MAMP='root',XAMPP=''
    $pdo = new PDO('mysql:dbname=ryuki0414_gs_db_kadai;charset=utf8;host=mysql57.ryuki0414.sakura.ne.jp','ryuki0414','ryuki0414_');
    // $pdo = new PDO('mysql:dbname=gs_db_kadai;charset=utf8;host=localhost','root','');
    //ローカルに存在するファイルをディプロイに行わないと、データベースのみデプロイしても作動しない。
  } catch (PDOException $e) {
    exit('DB Connection Error:'.$e->getMessage());
  }

$stmt   = $pdo->prepare("SELECT * FROM gs_bm_table WHERE id=:id"); //SQLをセット
$stmt->bindValue(':id', $id, PDO::PARAM_INT); 
$status = $stmt->execute(); //SQLを実行→エラーの場合falseを$statusに代入

if($status==false) {
  //SQLエラーの場合
  sql_error($stmt);
}else{
  //SQL成功の場合
  $row = $stmt->fetch(); //1レコードだけ取得する方法
}



?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ更新</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="bm_update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>本のアンケート結果更新</legend>
     <label>本の名前：<input type="text" name="name" value="<?=$row["name"]?>"></label><br>
     <label>本のURL:<input type="text" name="url" value="<?=$row["url"]?>"></label><br>
     <label>コメント:<textArea name="comment" rows="4" cols="40"><?=$row["comment"]?></textArea></label><br>
     <!-- idを隠して送信 -->
     <input type="hidden" name="id" value="<?=$id?>">
     <!-- idを隠して送信 -->
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->

</body>
</html>