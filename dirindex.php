<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<title>サンプル</title>
</head>
<body>
<?php
print "/Library/WebServer/Documents/ディレクトリの一覧表示<br>";

$dir	= '/Library/WebServer/Documents';
$files1	= scandir($dir);
#$files2	= scandir($dir,1);

echo "<pre>";
print_r($files1);
echo "</pre>";
//print_r($files2);

foreach ($files1 as $key => $value){
  print $key.'=>'.$value.'<br />';
}

print '<br />';
print "/home/httpsd/public/ディレクトリの再帰的一覧表示<br>";


function getFileList($dir) {
    $files = scandir($dir);
    $files = array_filter($files, function ($file) {
        return !in_array($file, array('.', '..'));
    });

    $list = array();
    foreach ($files as $file) {
        $fullpath = rtrim($dir, '/') . '/' . $file;
        if (is_file($fullpath)) {
            $list[] = $fullpath;
        }
        if (is_dir($fullpath)) {
            $list = array_merge($list, getFileList($fullpath));
        }
    }

    return $list;
}

$lists = getFileList('/Library/WebServer/Documents');

foreach ($lists as $key => $value){
  print $key.'=>'.$value.'<br />';
}
?>

</body>
</html>
