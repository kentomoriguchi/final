<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>
  


<!-- Head[Start] -->
<?php include("final_menu.php"); ?>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="final_insert.php">
  <div class="jumbotron">
   <fieldset>
    <legend>データベース</legend>
     <label>会社名：<input type="text" name="name"></label><br>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
