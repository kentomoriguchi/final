<?php
session_start();

// 1. DB接続します
include("final_funcs.php");
sschk();
$pdo = db_conn();

// 2. リクエストからキーワードを取得
$keyword = isset($_POST['keyword']) ? $_POST['keyword'] : '';

// 3. 会社名の一覧を取得
$stmt = $pdo->prepare("SELECT DISTINCT name FROM gs_final_table WHERE name LIKE :keyword ORDER BY name");
$stmt->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);
$status = $stmt->execute();

$companyNames = [];
if ($status !== false) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $companyNames[] = $row['name'];
    }
}

?>

<!-- 会社名の検索結果を表示 -->
<ul>
    <?php foreach ($companyNames as $companyName): ?>
        <li>
            <a href="final_filelist.php?company_name=<?= $companyName ?>">
                <?= $companyName ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>
