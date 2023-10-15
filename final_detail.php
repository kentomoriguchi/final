<?php
session_start();


//1. DB接続します
include("final_funcs.php");
sschk();
$pdo = db_conn();


//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_final_table ORDER BY name");
$status = $stmt->execute();


//３．データ表示
$view="";
if($status==false) {
  sql_error($stmt);
}else{
  while( $r = $stmt->fetch(PDO::FETCH_ASSOC)){ 

    $pdfFileName = $r["file"]; // PDFファイルのファイル名
    
    // ファイル名から "upload/" を削除
     $pdfFileName = str_replace("upload/", "", $pdfFileName);

    $view .= '<a href="upload/' . $pdfFileName . '" download="' . $pdfFileName . '"> <br>';
    $view .= $pdfFileName ;
    $view .= '</a>';


    $view .= "　";
    if($_SESSION["kanri_flg"]=="1"){
      $view .= '<a class="btn btn-danger" href="final_delete.php?id='.$r["id"].'"><br>';
      $view .= '[<i class="glyphicon glyphicon-remove"></i>削除]';
      $view .= '</a>';
    }
    $view .= '</p>';
  }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>データ一覧</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<?php include("final_menu.php"); ?>
<!-- Head[End] -->


<!-- Main[Start] -->
<div class="container jumbotron" id="view"><?=$view?></div>
<!-- Main[End] -->




<script>
</script>

</body>
</html>



