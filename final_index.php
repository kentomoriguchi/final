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
<form method="post" action="final_insert.php" enctype="multipart/form-data">
  <div class="jumbotron">
    <fieldset>
      <legend>データベース</legend>
      <label>会社名：<input type="text" name="name"></label><br>
      <div id="fileInputs">
        <label><input type="file" name="upfile[]" multiple></label><br>
      </div>
      <button type="button" onclick="addFileInput()">追加のファイルを選択</button>
      <input type="submit" value="アップロード">
    </fieldset>
  </div>
</form>

<script>
function addFileInput() {
  const fileInputs = document.getElementById("fileInputs");
  const newFileInput = document.createElement("input");
  newFileInput.type = "file";
  newFileInput.name = "upfile[]";
  newFileInput.multiple = true;
  fileInputs.appendChild(document.createElement("br"));
  fileInputs.appendChild(newFileInput);
}
</script>

<!-- Main[End] -->
</body>
</html>
