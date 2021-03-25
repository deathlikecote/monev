<?php
// 	definisi nama database dan tabel 
include("dbspmconn.php");

//---3
echo " hitung scoreas....<br>";
mysql_query("update edomtemp01 t12 inner join (select kode, aspek, avg(scorepar) as vscoreas from edomtemp01 group by kode, aspek) t22 on t12.aspek = t22.aspek set t12.scoreas = t22.vscoreas")  or die("error as:".mysql_error());


?>
