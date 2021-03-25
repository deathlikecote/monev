<?php
// 	definisi nama database dan tabel 
include "../../include/koneksi.php";

$qry=mysqli_fetch_assoc(mysqli_query($plm_edom, "select count(parameter) as vjpar from edomparameter"));
$jpar=$qry['vjpar'];
mysqli_query($plm_edom, "update edomdata set kodeprodikls=concat(idprogstudi,kelas)") or die("update edomdata : ".mysqli_error());

//--ok
mysqli_query($plm_edom, "TRUNCATE TABLE edomtemp04");
mysqli_query($plm_edom, "INSERT INTO edomtemp04 (kodeprodikls,idprogstudi,kelas) (select distinct(kodeprodikls),idprogstudi,kelas from edomdata)") or die("insert to edomtemp04 : ".mysqli_error());
//mysqli_query("update edomtemp04 set kodeprodikls=concat(idprogstudi,kelas)") or die(mysqli_error());
mysqli_query($plm_edom, "UPDATE edomtemp04 INNER JOIN m_programstudi ON edomtemp04.idprogstudi = m_programstudi.idprogstudi SET edomtemp04.namaprodi = m_programstudi.namaprodi, edomtemp04.jurprodi = m_programstudi.jurprodi") or die(mysqli_error());
mysqli_query($plm_edom, "update edomtemp04 t1 inner join (select kodeprodikls, count(kodeprodikls)/'$jpar' as Jsiswa from edomdata group by kodeprodikls) t2 on t1.kodeprodikls = t2.kodeprodikls set t1.jmlmhs = t2.Jsiswa") or die("error jsiswa:".mysqli_error());
mysqli_query($plm_edom, "update edomtemp04 t1 inner join (select kodeprodikls, sum(v1) as Jsc from edomdata group by kodeprodikls) t2 on t1.kodeprodikls = t2.kodeprodikls set t1.jumlah = t2.Jsc") or die("error jumlah:".mysqli_error());
mysqli_query($plm_edom, "update edomtemp04 set score=jumlah/(jmlmhs*'$jpar')")or die("error score:".mysqli_error());
//-
//header("Location:edomreport3-pdf.php");
//header("Location:../spmadmin.php");

?>
