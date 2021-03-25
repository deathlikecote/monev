<?php
// 	definisi nama database dan tabel 
include("dbspmconn.php");

//---2
echo " hitung scorepar....<br>";
mysql_query("update edomtemp01 set scorepar=jumlah/jmlmhs") or die("error scorepar:".mysql_error());
?>
