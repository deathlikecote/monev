<?php
// 	definisi nama database dan tabel 
include("dbspmconn.php");

//---1
echo " truncate & insert....<br>";
mysql_query("TRUNCATE TABLE edomtemp01");
mysql_query("INSERT INTO edomtemp01 (kode,id_parameter,parameter,aspek) select kode, id_parameter, parameter, aspek from edomdata group by kode,id_parameter") or die("error insert:".mysql_error());

echo " hitung jumlah nilai....<br>";
mysql_query("update edomtemp01 t1 inner join (select kode, id_parameter, sum(v1) as Jsc from edomdata group by kode, id_parameter) t2 on t1.kode = t2.kode set t1.jumlah = t2.Jsc") or die("error jumlah:".mysql_error());

//ambil jumlah parameter
$qry=mysql_fetch_assoc(mysql_query("select count(parameter) as vjpar from edomparameter"));
$jpar=$qry['vjpar'];

// hitung jumlah siswa dari edomdata
echo " hitung jml mhs....<br>";
mysql_query("update edomtemp01 t11 inner join (select kode, count(kode)/'$jpar' as jsiswa from edomdata group by kode) t21 on t11.kode = t21.kode set jmlmhs=jsiswa") or die("error jsiswa:".mysql_error());

//---2
echo " hitung scorepar....<br>";
mysql_query("update edomtemp01 set scorepar=jumlah/jmlmhs") or die("error scorepar:".mysql_error());
//---3
echo " hitung scoreas....<br>";
mysql_query("update edomtemp01 t12 inner join (select kode, aspek, avg(scorepar) as vscoreas from edomtemp01 group by kode, aspek) t22 on t12.aspek = t22.aspek set t12.scoreas = t22.vscoreas")  or die("error as:".mysql_error());

//---4
echo " hitung scoredos....";
mysql_query("update edomtemp01 t13 inner join (select kode, avg(scoreas) as vscoredos from edomtemp01 group by kode) t23 on t13.kode = t23.kode set t13.scoredos = t23.vscoredos")  or die("error as:".mysql_error());

?>
