<?php
//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str){
    return htmlspecialchars($str, ENT_QUOTES);
}

//DB接続関数：db_conn()
function db_conn(){
    try {
        //localhostの場合
        $db_name = "gs_final";    //データベース名
        $db_id   = "root";      //アカウント名
        $db_pw   = "";          //パスワード：XAMPPはパスワード無しに修正してください。
        $db_host = "localhost"; //DBホスト

        //localhost以外＊＊自分で書き直してください！！＊＊
        if($_SERVER["HTTP_HOST"] != 'localhost:29980'){
            $db_name = "";  //データベース名
            $db_id   = "";  //アカウント名（さくらコントロールパネルに表示されています）
            $db_pw   = "";  //パスワード(さくらサーバー最初にDB作成する際に設定したパスワード)
            $db_host = "localhost"; //例）mysql**db.ne.jp...
        }
        return new PDO('mysql:dbname='.$db_name.';charset=utf8;host='.$db_host, $db_id, $db_pw);
    } catch (PDOException $e) {
        exit('DB Connection Error:'.$e->getMessage());
    }
}


//SQLエラー関数：sql_error($stmt)
function sql_error($stmt){
    $error = $stmt->errorInfo();
    exit("SQL_Error:".$error[2]);
}


//リダイレクト関数: redirect($file_name)
function redirect($file_name){
    header("Location: ".$file_name);
}


//セッションチェック
function sschk(){
    if(!isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"]!=session_id()){
        exit("ログインエラー");
    }else{
        session_regenerate_id(true);
        $_SESSION["chk_ssid"] = session_id();
    }
}


//fileUpload("送信名","アップロード先フォルダ");
//function fileUpload($fname,$path){
    //if (isset($_FILES[$fname] ) && $_FILES[$fname]["error"] ==0 ) {
        //ファイル名取得
        //$file_name = $_FILES[$fname]["name"];
        //一時保存場所取得
        //$tmp_path  = $_FILES[$fname]["tmp_name"];
        //拡張子取得
        //$extension = pathinfo($file_name, PATHINFO_EXTENSION);
        //ユニークファイル名作成
        //$file_name = date("YmdHis").md5(session_id()) . "." . $extension;
        // FileUpload [--Start--]
        //$file_dir_path = $path."/".$file_name;
        //if ( is_uploaded_file( $tmp_path ) ) {
            //if ( move_uploaded_file( $tmp_path, $file_dir_path ) ) {
                //chmod( $file_dir_path, 0644 );
                //return $file_name; //成功時：ファイル名を返す
            //} else {
                //return 1; //失敗時：ファイル移動に失敗
            //}
        //}
     //}else{
         //return 2; //失敗時：ファイル取得エラー
     //}
//}



//PDFアップロード
function fileUpload($inputName, $uploadDirectory) {
    $uploadedFile = $_FILES[$inputName];
    $filename = $uploadedFile['name'];
    $tempFile = $uploadedFile['tmp_name'];

    $targetPath = $uploadDirectory . '/' . $filename;

    if (move_uploaded_file($tempFile, $targetPath)) {
        return $targetPath; // ファイルが正常にアップロードされた場合、ファイルパスを返す
    } else {
        return false; // アップロードが失敗した場合、falseを返す
    }
}


