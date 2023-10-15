<?php
session_start();

// 1. GETパラメータ "id" を整数にキャスト
$id = intval($_GET["id"]);

// 2. DB接続します
include("final_funcs.php");  // funcs.phpを読み込む（関数群）
sschk();
$pdo = db_conn();      // DB接続関数

// 3. データ削除を実行（$id が 0 より大きい場合のみ実行）
if ($id > 0) {
    // データ削除SQL作成
    $sql = "DELETE FROM gs_final_table WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT); // Integer（数値の場合 PDO::PARAM_INT)
    $status = $stmt->execute(); // 実行

    // 4. データ削除処理後
    if ($status == false) {
        sql_error($stmt);
    } else {
        // リファラー（リダイレクト元のページ）からcompany_nameパラメータを取得
        $referer = $_SERVER['HTTP_REFERER'];
        $urlParts = parse_url($referer);
        if (isset($urlParts['query'])) {
            parse_str($urlParts['query'], $query);
            if (isset($query['company_name'])) {
                $companyName = $query['company_name'];
                redirect("final_filelist.php?company_name=" . urlencode($companyName));
            } else {
                echo "削除後に戻るページの 'company_name' パラメータが不足しています。";
            }
        } else {
            echo "削除後に戻るページの URL が無効です。";
        }
    }
} else {
    echo "無効な 'id' パラメータが指定されています。";
}

?>
