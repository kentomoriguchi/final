<?php
session_start();
$name = $_POST['name'];

// 2. DB接続します
include("final_funcs.php");
$pdo = db_conn();

$uploadedFiles = $_FILES['upfile'];

$success = true;

// 同じ会社名を持つエントリにファイル情報を追加
for ($i = 0; $i < count($uploadedFiles['name']); $i++) {
    $file = fileUpload("upfile", "upload", $i);

    if ($file === false) {
        echo "ファイルのアップロードに失敗しました。";
        echo '<form action="final_index.php"><input type="submit" value="データ登録画面に戻る"></form>';
        exit();
    }

    // データベースに会社名とファイル情報を保存
    $stmt = $pdo->prepare("INSERT INTO gs_final_table(name, file, indate) VALUES(:name, :file, sysdate());");
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':file', $file);


    if ($stmt->execute() === false) {
        $success = false;
    }
}

// 4. データ登録処理後
if ($success) {
    // データ登録成功時の処理
    echo "データ登録が完了しました。";
    echo '<form action="final_index.php"><input type="submit" value="データ登録画面に戻る"></form>';
    echo '<form action="final_select.php"><input type="submit" value="データ一覧表示"></form>';

} else {
    // データ登録失敗時の処理
    echo "データ登録に失敗しました。";
    echo '<form action="final_index.php"><input type="submit" value="データ登録画面に戻る"></form>';
}
?>
