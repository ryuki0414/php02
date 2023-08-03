<?php
//0. SESSION開始！！
session_start();

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

//２．データ登録SQL作成
$stmt   = $pdo->prepare("SELECT * FROM gs_bm_table"); //SQLをセット
$status = $stmt->execute(); //SQLを実行→エラーの場合falseを$statusに代入

//３．データ表示
$view=""; //HTML文字列作り、入れる変数
if($status==false) {
  //SQLエラーの場合
  sql_error($stmt);
}else{
  //SQL成功の場合
  while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){ //データ取得数分繰り返す
    //以下でリンクの文字列を作成, $r["id"]でidをdetail.phpに渡しています
    $view .= '<a href="bm_update_view.php?id='.h($r["id"]).'">';
    $view .= h($r["id"])."|".h($r["name"])."|".h($r["url"])."|".h($r["comment"]);
    $view .= '</a>';
    $view .= '<a href="delete.php?id='.h($r["id"]).'">';
    $view .= '[削除]';
    $view .= '</a>';
    $view .= '<br>';
  }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>データ編集画面</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="kadai_index.php">データ登録</a>
          <a class="navbar-brand" href="login.php">ログイン</a>
      <a class="navbar-brand" href="logout.php">ログアウト</a>

      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?=$view?></div>
</div>
<!-- Main[End] -->

</body>
</html>
