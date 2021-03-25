<?php
// 	definisi nama database dan tabel 
//include("dbspmconn.php");

include "../../include/koneksi.php";


$qry=mysqli_fetch_assoc(mysqli_query("select count(parameter) as vjpar from edomparameter"));
$jpar=$qry['vjpar'];

//--ok
mysqli_query("TRUNCATE TABLE edomtemp02");
mysqli_query("INSERT INTO edomtemp02 (kode) (select distinct(kode) from edomdata)") or die(mysql_error());
mysqli_query("UPDATE edomtemp02 INNER JOIN edompotensi ON edomtemp02.kode = edompotensi.kode SET edomtemp02.namadosen = edompotensi.namadosen, edomtemp02.namamk = edompotensi.namamk, edomtemp02.idprogstudi = edompotensi.idprogstudi, edomtemp02.kelas = edompotensi.kelas") or die(mysql_error());
mysqli_query("update edomtemp02 t1 inner join (select kode, count(kode)/'$jpar' as Jsiswa from edomdata group by kode) t2 on t1.kode = t2.kode set t1.jmlmhs = t2.Jsiswa") or die("error jsiswa:".mysql_error());
mysqli_query("update edomtemp02 t1 inner join (select kode, sum(v1) as Jsc from edomdata group by kode) t2 on t1.kode = t2.kode set t1.jumlah = t2.Jsc") or die("error jumlah:".mysql_error());
mysqli_query("update edomtemp02 set score=jumlah/(jmlmhs*'$jpar')")or die("error score:".mysql_error());
//-
//header("Location:../spmadmin.php");

?>