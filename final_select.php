<?php
session_start();


//1. DB接続します
include("final_funcs.php");
sschk();
$pdo = db_conn();


//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_final_table");
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
<div>
  <div>
    <input type="text" id="keyword">
    <button id="send">検索</button>
  </div>
    <div class="container jumbotron" id="view"><?=$view?></div>
</div>
<!-- Main[End] -->




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
//登録ボタンをクリック
$("#send").on("click", function() {
    //axiosでAjax送信
    //Ajax（非同期通信）
    const params = new URLSearchParams();
    params.append('keyword',   $("#keyword").val());
    
    //axiosでAjax送信
    axios.post('final_select2.php',params).then(function (response) {
        console.log(typeof response.data);//通信OK
          //>>>>通信でデータを受信したら処理をする場所<<<<
          document.querySelector("#view").innerHTML=response.data;
    }).catch(function (error) {
        console.log(error);//通信Error
    }).then(function () {
        console.log("Last");//通信OK/Error後に処理を必ずさせたい場合
    });
});
</script>

</body>
</html>


