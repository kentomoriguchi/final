<?php
session_start();

//※htdocsと同じ階層に「includes」を作成してfuncs.phpを入れましょう！
//include "../../includes/funcs.php";
include ("final_funcs.php");
sschk();
$id = filter_input( INPUT_GET, "id" );

//1. DB接続
$pdo = db_conn();

//2.データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_final_user_table WHERE id=:id");
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$status = $stmt->execute();

//3.データ表示
$view = "";
if ($status == false) {
    sql_error($stmt);
} else {
    $row = $stmt->fetch();
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ユーザー情報更新</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
    <?php echo $_SESSION["name"]; ?>さん　
    <?php include("final_menu.php"); ?>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="final_user_update.php">
  <div class="jumbotron">
  
    <fieldset>
    <legend>ユーザー情報更新</legend>
     <label>名前：<input type="text" name="name" value="<?php echo $row["name"]; ?>"></label><br>
     <label>社員番号：<input type="text" name="lid" value="<?php echo $row["lid"]; ?>"></label><br>
     <label>パスワード<input type="text" name="lpw" placeholder="変更あるときだけ入力"></label><br>
     <label>権限：
          <?php if($row["kanri_flg"]=="0"){ ?>
              一般<input type="radio" name="kanri_flg" value="0" checked="checked">　
              管理者<input type="radio" name="kanri_flg" value="1">
          <?php }else{ ?>
              一般<input type="radio" name="kanri_flg" value="0">　
              管理者<input type="radio" name="kanri_flg" value="1" checked="checked">
          <?php } ?>
    </label>
    <br>
     <input type="submit" value="更新"></br>
     <input type="hidden" name="id" value="<?php echo $id; ?>">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
