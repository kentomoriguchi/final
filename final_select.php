<?php
session_start();

// 1. DB接続します
include("final_funcs.php");
sschk();
$pdo = db_conn();

// 2. 会社名の一覧を取得
$stmt = $pdo->prepare("SELECT DISTINCT name FROM gs_final_table ORDER BY name");
$status = $stmt->execute();

$companyNames = [];
if ($status !== false) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $companyNames[] = $row['name'];
    }
}

// 3. ファイル一覧を取得する関数
function getFileList($companyName, $pdo) {
    $stmt = $pdo->prepare("SELECT * FROM gs_final_table WHERE name = :name");
    $stmt->bindValue(':name', $companyName, PDO::PARAM_STR);
    $stmt->execute();
    
    $fileList = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $fileList[] = $row['file'];
    }
    return $fileList;
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
  <input type="text" id="keyword">
  <button id="send">検索</button>
  <div id="view">
      <ul>
          <?php foreach ($companyNames as $companyName): ?>
              <li>
                  <a href="final_filelist.php?company_name=<?= $companyName ?>">
                      <?= $companyName ?>
                  </a>
              </li>
          <?php endforeach; ?>
      </ul>
  </div>
</div>
<!-- Main[End] -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
//検索機能
$("#send").on("click", function() {
    //axiosでAjax送信
    //Ajax（非同期通信）
    const params = new URLSearchParams();
    params.append('keyword', $("#keyword").val());

    //axiosでAjax送信
    axios.post('final_select2.php', params).then(function (response) {
        console.log(typeof response.data); // 通信OK

        // 検索結果を #view に挿入
        const viewElement = document.querySelector("#view");
        viewElement.innerHTML = response.data;
    }).catch(function (error) {
        console.log(error); // 通信Error
    }).then(function () {
        console.log("Last"); // 通信OK/Error後に処理を必ずさせたい場合
    });
});


 // 会社名リンクがクリックされたときの処理
 $(".company-link").on("click", function () {
        const companyName = $(this).data("company");

        // ファイル一覧を取得して表示
        axios.post('final_select2.php', { keyword: companyName }).then(function (response) {
            document.querySelector("#file-view").innerHTML = response.data;
        });
    });
</script>

</body>
</html>


