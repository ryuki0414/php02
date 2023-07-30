<?php
//1. POSTデータ取得
$name   = $_POST["name"];
$url  = $_POST["url"];
$comment = $_POST["comment"]; 
$id    = $_POST["id"];   

//2. DB接続します
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


//３．データ登録SQL作成
$sql = "UPDATE gs_bm_table SET name=:name, url=:url, comment=:comment  WHERE id=:id";
// $sql = "UPDATE gs_bm_table SET name=:name, url=:url, comment=:comment";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name',  $name,   PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':url', $url,  PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comment',   $comment,    PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id',$id,  PDO::PARAM_INT);
$status = $stmt->execute(); //実行


//４．データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    redirect("select.php");
}

?>
