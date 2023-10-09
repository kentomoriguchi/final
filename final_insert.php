<?php
session_start();
$name = $_POST['name'];

//2. DB接続します
include("final_funcs.php");
$pdo = db_conn();



$file = fileUpload("upfile", "upload"); 


if ($file === false) {
  echo "ファイルのアップロードに失敗しました。";
  exit();
}


//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_final_table(name,file,indate)VALUES(:name, :file, sysdate());");
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':file', $file );
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  sql_error($stmt);
}else{
  //５．index.phpへリダイレクト
  redirect("final_index.php");
  exit();
}
?>
