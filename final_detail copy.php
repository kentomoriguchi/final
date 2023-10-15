<?php
session_start();


$id = $_GET["id"];

include("final_funcs.php");
sschk();
$pdo = db_conn();

$stmt = $pdo->prepare("SELECT * FROM gs_final_table WHERE id = :id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if($status==false) {
    //execute（SQL実行時にエラーがある場合）
    sql_error($stmt);
  }else{
    $row = $stmt->fetch();
}

?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ更新</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<?php include("final_menu.php"); ?>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="final_update.php" enctype="multipart/form-data">
  <div class="jumbotron">
   <fieldset>
    <legend>データベース</legend>
     <label>会社名：<input type="text" name="name" value="<?=$row["name"]?>"></label><br>
     <label>ファイル：<input type="file" name="upfile" value="<?=$row["file"]?>"></label><br>
     <!-- idを隠して送信 -->
     <input type="hidden" name="id" value="<?=$id?>">
     <!-- idを隠して送信 -->
     <input type="submit" value="更新">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->

</body>
</html>
