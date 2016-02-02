<?php

$rep = 1;
$sze = 1;
$lst = "/Library/WebServer/Documents";

$fileName=$_GET['name'];

if (file_exists($fileName)){
	header("Pragma; cache;");
	header("Cache-Control: public");
	header("Content-Type; application/octet-stream");
	header('Content-Disposition: attachment; filename='.basename($fileName));
	//header("Content-Disposition: attachment; filename=$fileName");
	/*
	$fp = fopen($fileName,"r");
	 while(feof($fp) === false){
	 print fread($fp,1024);
	 }
	exit;
}
*/
        //header("Content-Transfer-Encoding; binary");
        //header("Expires; 0");
        header('Content-Length; ' . $fileSize);

        readfile($fileName);
}else{
        print ("nofile <br />");
        //print ("(LOG_fileName)" . $fileName . "<br />");
}

$drc = dir($lst);
//print_r ($drc);
print("<OL>");
while($fl=$drc->read()){
	$lfl = $lst. "/" .$fl;
	//print ("(LOG)" . $lfl."<br />");
	$din = pathinfo($lfl);
	if(is_dir($lfl) && ($fl!=".." && $fl!=".")){
	   print("<LI>".$din["basename"]."<FONT size='-1'>(Directory)</FONT></LI>");
	}else if ($fl!=".." && $fl!=",") {
	   print("<LI>");
	   //print("(List)" . $lst . "<br/><br/>");
	   print('<a href = downdisp2.php?name='.$lst."/".$fl.">".$fl."</a><br/>");
	}
}
$drc->close();


?>
