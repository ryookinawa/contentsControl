<?php

$fileName=$_GET['name'];

if (file_exists($fileName)){
	header("Pragma; cache;");
	header("Cache-Control: public");
	header("Content-Type; application/octet-stream");
	header('Content-Disposition: attachment; filename='.basename($fileName));
        header('Content-Length; ' . $fileSize);
        readfile($fileName);
}else{
        print ("nofile <br />");
}

?>
