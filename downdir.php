<?php

$rep = 1;
$sze = 1;

$dir=$_POST['name'];
print("参照先:  $dir  <br/><hr>");

$drc = dir($dir);
print("<OL>");
//print_r($drc);
while($fl=$drc->read()){
	print($fl);
	//ファイルのフルパスを生成
	$lfl = $dir. "/" .$fl;
	//ファイルのパスに関する情報を配列へ格納
	$din = pathinfo($lfl);
	//ディレクトリ　or　ファイルの判定
	if(is_dir($lfl) && ($fl!=".." && $fl!=".")){
		 //ディレクトリだった場合は、”ファイル名"＋”Directory"と表示
	   print("<LI>".$din["basename"]."<FONT size='-1'>(Directory)</FONT></LI>");
	}else if ($fl!=".." && $fl!=".") {
		 //ファイルだった場合は、Download用PHPのリンクを貼ったファイル名を表示
	   print("<LI>");
	   print('<a href = download.php?name='.$dir."/".$fl.">".$fl."</a>");
	   // ファイル更新日
	   if($rep == 1 || $sze == 1) print("<FONT size='-1'> (");
	   if($rep == 1) echo date("y/m/d",filemtime($lfl));
	   if($rep == 1 && $sze == 1) print(", ");
	   // ファイルサイズ
	   if($sze == 1) echo round(filesize($lfl)/1024)."KB";
	   if($rep == 1 || $sze == 1) print(")</FONT> ");
	   print("</LI>");
	}
}
print("</OL>");
$drc->close();
?>
