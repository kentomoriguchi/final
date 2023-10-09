<?php
//最初にSESSIONを開始！！ココ大事！！
session_start();


$lid = $_POST["lid"];
$lpw = $_POST["lpw"];


//1.  DB接続します
include("final_funcs.php");
$pdo = db_conn();


//2. データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_final_user_table WHERE lid=:lid");
$stmt->bindValue(':lid', $_POST["lid"], PDO::PARAM_STR);
$status = $stmt->execute();

//3. SQL実行時にエラーがある場合STOP
if($status==false){
    sql_error($stmt);
}

//4. 抽出データ数を取得
$val = $stmt->fetch();         //1レコードだけ取得する方法
//$count = $stmt->fetchColumn(); //SELECT COUNT(*)で使用可能()

//5. 該当レコードがあればSESSIONに値を代入
$pw = password_verify($lpw, $val["lpw"]);
if($pw){
  //Login成功時
  $_SESSION["chk_ssid"]  = session_id();
  $_SESSION["kanri_flg"] = $val['kanri_flg'];
  $_SESSION["name"]      = $val['name'];
  redirect("final_home.php");
}else{
  //Login失敗時(Logout経由)
  redirect("final_login.php");
}
exit();
?>

