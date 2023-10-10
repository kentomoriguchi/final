<?php
if (isset($_GET['file'])) {
    $fileName = $_GET['file'];
    //$filePath = 'upload/' . $fileName;
    $filePath =  $fileName;


    if (file_exists($filePath)) {
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');
        readfile($filePath);
        exit;
    } else {
        echo 'ファイルが見つかりません。';
        echo $filePath;

    }
}
?>
