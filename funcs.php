<?php
//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str){
    return htmlspecialchars($str, ENT_QUOTES);
}

//DB接続関数：db_conn()
function db_conn(){

    // try {
    //     //localhostの場合
    //     $db_name = "gs_db_kadai";    //データベース名
    //     $db_id   = "root";      //アカウント名
    //     $db_pw   = "";          //パスワード：XAMPPはパスワード無しに修正してください。
    //     $db_host = "localhost"; //DBホスト

    //     //localhost以外＊＊自分で書き直してください！！＊＊
    //     if($_SERVER["HTTP_HOST"] != 'localhost'){
    //         $db_name = "ryuki0414_gs_db_kadai";  //データベース名
    //         $db_id   = "ryuki0414";  //アカウント名（さくらコントロールパネルに表示されています）
    //         $db_pw   = "ryuki0414_";  //パスワード(さくらサーバー最初にDB作成する際に設定したパスワード)
    //         $db_host = "mysql57.ryuki0414.sakura.ne.jp"; //例）mysql**db.ne.jp...
    //     }
    //     return new PDO('mysql:dbname='.$db_name.';charset=utf8;host='.$db_host, $db_id, $db_pw);
   
    try {
        //Password:MAMP='root',XAMPP=''
        $pdo = new PDO('mysql:dbname=ryuki0414_gs_db_kadai;charset=utf8;host=mysql57.ryuki0414.sakura.ne.jp','ryuki0414','ryuki0414_');
        // $pdo = new PDO('mysql:dbname=gs_db_kadai;charset=utf8;host=localhost','root','');
        //ローカルに存在するファイルをディプロイに行わないと、データベースのみデプロイしても作動しない。
    } catch (PDOException $e) {
        exit('DB Connection Error:'.$e->getMessage());
    }
}

//SQLエラー関数：sql_error($stmt)

function sql_error($stmt){
    $error = $stmt->errorInfo();
    exit("SQLError:".$error[2]);
}

//リダイレクト関数: redirect($file_name)
function redirect($file_name){
    header("Location: " .$file_name);
}




