<?php
//1. POSTデータ取得
include("final_funcs.php");  //funcs.phpを読み込む（関数群）
$name = $_POST["name"];
$file = fileUpload("upfile","upload");
$id   = $_POST["id"];   //idを取得

//2. DB接続します
$pdo = db_conn();      //DB接続関数


//３．データ登録SQL作成
$sql = "UPDATE gs_final_table SET  name = :name, file = :file  WHERE id =:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name',  $name,   PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':file', $file);
$stmt->bindValue(':id', $id,  PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行


//４．データ登録処理後
if($status==false){
    sql_error($stmt);
}else{
    redirect("final_select.php");
}

?>
