<?php
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
?>
