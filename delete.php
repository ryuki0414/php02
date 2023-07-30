<?php
//1. POSTデータ取得
$id   = $_GET["id"];

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
$sql = "DELETE FROM gs_bm_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id',$id, PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

//４．データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    redirect("select.php");
}
?>
