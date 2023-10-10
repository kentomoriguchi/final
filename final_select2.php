<?php
session_start();


//1. DB接続します
include("final_funcs.php");
sschk();
$pdo = db_conn();
$keyword = $_POST['keyword'];


//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_final_table WHERE name LIKE :keyword");
$stmt->bindValue(':keyword', '%'.$keyword.'%', PDO::PARAM_STR);
$status = $stmt->execute();


//３．データ表示
$view="";
if($status==false) {
  sql_error($stmt);
}else{
  while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    $view .= '<p>';
    $view .= '<a href="final_detail.php?id='.$r["id"].'">';
    $view .= " ■ ";
    $view .= $r["name"];
    $view .= '</a>';
    
    $pdfFileName = $r["file"]; // PDFファイルのファイル名
    $view .= '<a href="upload/' . $pdfFileName . '" download="' . $pdfFileName . '"> <br>';
    $view .= $pdfFileName ;
    $view .= '</a>';

    $view .= '<a href="final_download.php?file=' . $pdfFileName . '">ダウンロード</a>';
    
    $view .= "　";
    if($_SESSION["kanri_flg"]=="1"){
      $view .= '<a class="btn btn-danger" href="final_delete.php?id='.$r["id"].'"><br>';
      $view .= '[<i class="glyphicon glyphicon-remove"></i>削除]';
      $view .= '</a>';
    }
    $view .= '</p>';
  }
}
echo $view;
?>

