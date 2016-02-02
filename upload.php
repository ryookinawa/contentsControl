<?php
 //if (isset($_FILES["upfile"])){

//    $files = $_FILES["upfile"];
//    $tmpName = $_FILES['upfile']["tmp_name"];
    $name1 = $_FILES['upfile']["name"][0];
//    $name2 = $_FILES['upfile']["name"][1];
    $error = $_FILES['upfile']["error"][0];
//    print_r("FILEdesu $files ");
//    print_r("FILEdesu $tmpName ");
    print_r("NAME1 =" . $name1 . "</br>");
//    print_r("NAME2 $name2 ");
    print_r("ERROR =" . $error . "</br>");
    //print_r($files);
//    var_dump("VARDUMP = $files");

foreach ($_FILES["upfile"]["error"] as $key => $value) {
//foreach ($files as $key => $value) {
    // アップロード成功した際の処理
    if ($value == UPLOAD_ERR_OK) {
        // ファイル名
        $file_name = $_FILES["upfile"]["name"][$key];
        print("FILENAME =" . $file_name . "</br>");
        print("KEY =" . $key . "</br>");
        // ファイルタイプ（MIME）
        $file_type = $_FILES["upfile"]["type"][$key];
        // ファイルサイズ（byte）
        $file_size = $_FILES["upfile"]["size"][$key];
        // 一時的に保存された場所へのパス
        $file_temp = $_FILES["upfile"]["tmp_name"][$key];

        // TODO: アップロード先を指定できるようにする。
        $uploads_dir = '//Library/WebServer/Documents';
        // 保存するファイル名 ( 今回はオリジナルのファイル名の前に upload を付加 )
        $file = "upload-".$file_name;

        //print("FILEFILE=$file" . "</br>");
        print("FULLPATH =" . "$uploads_dir/$file" . "</br>");

        if (($result = move_uploaded_file($file_temp, "$uploads_dir/$file")) === true) {
            echo "ファイルのアップロードに成功しました。<br />";
            echo $file_type."<br />";
            echo $file_size." byte<br />";
        } else {
            echo "ファイルのアップロードに失敗しました。";
        }
    }
  //}
}
?>
