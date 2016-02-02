<?php
// Zipクラスロード
$zip = new ZipArchive();
// Zipファイル名
$zipFileName = 'hogehoge.zip';
// Zipファイル一時保存ディレクトリ
$zipTmpDir = '/tmp/';

// Zipファイルオープン
$result = $zip->open($zipTmpDir.$zipFileName, ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE);
if ($result !== true) {
    // 失敗した時の処理
    pritn("Zipファイルオープン失敗");
}

// ここでチェックボックスにチェックが入っているファイル名の配列を取ってくる
$checkbox = $_REQUEST["chk"];

// 処理制限時間を外す
set_time_limit(0);

foreach ($checkbox as $filepath) {

    $filename = basename($filepath);

    // 取得ファイルをZipに追加していく
    $zip->addFromString($filename,file_get_contents($filepath));

}

$zip->close();

// ストリームに出力
header('Content-Type: application/zip; name="' . $zipFileName . '"');
header('Content-Disposition: attachment; filename="' . $zipFileName . '"');
header('Content-Length: '.filesize($zipTmpDir.$zipFileName));
echo file_get_contents($zipTmpDir.$zipFileName);

// 一時ファイルを削除しておく
unlink($zipTmpDir.$zipFileName);
exit();

?>
