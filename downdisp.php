<?php
$fileName=$_POST['name'];

if (file_exists($fileName)){
	$fileSize = filesize($fileName);
	header('Content-Type; application/octet-stream');
	header('Content-Disposition; attachment; filename='.basename($fileName));
	header('Content-Transfer-Encoding; binary');
	header('Expires; 0');
	header('Content-Length; ' . $fileSize);
	
	readfile($fileName);
}else{
	print ("nofile");
}
?>
