<?php
session_start();

// 1. DB接続します
include("final_funcs.php");
sschk();
$pdo = db_conn();

// 2. 会社名を受け取る
if (isset($_GET['company_name'])) {
    $companyName = $_GET['company_name'];

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

    // 4. ファイル一覧を取得
    $fileList = getFileList($companyName, $pdo);
} else {
    // 会社名が指定されていない場合のエラーハンドリング
    echo "会社名が指定されていません。";
    exit();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= $companyName ?>のファイル一覧</title>
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
    <h2><?= $companyName ?>のファイル一覧</h2>
    <ul>
        <?php foreach ($fileList as $file): ?>
            <li>
                <a href="upload/<?= $file ?>" download="<?= $file ?>"><?= $file ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
<!-- Main[End] -->

</body>
</html>
