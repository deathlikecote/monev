<?php
// 	definisi nama database dan tabel 
include("dbspmconn.php");

//---4
echo " hitung scoredos....";
mysql_query("update edomtemp01 t13 inner join (select kode, avg(scoreas) as vscoredos from edomtemp01 group by kode) t23 on t13.kode = t23.kode set t13.scoredos = t23.vscoredos")  or die("error as:".mysql_error());


?>
