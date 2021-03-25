<?php
include "../../include/koneksi.php";

$qry=mysqli_fetch_assoc(mysqli_query($plm_edom, "select count(parameter) as vjpar from edomparameter"));
$jpar=$qry['vjpar'];

//--ok
mysqli_query($plm_edom, "TRUNCATE TABLE edomtemp03");
mysqli_query($plm_edom, "INSERT INTO edomtemp03 (idprogstudi) (select distinct(idprogstudi) from edomdata)") or die(mysqli_error());
mysqli_query($plm_edom, "UPDATE edomtemp03 INNER JOIN m_programstudi ON edomtemp03.idprogstudi = m_programstudi.idprogstudi SET edomtemp03.namaprodi = m_programstudi.namaprodi, edomtemp03.jurprodi = m_programstudi.jurprodi") or die(mysqli_error());
mysqli_query($plm_edom, "update edomtemp03 t1 inner join (select idprogstudi, count(idprogstudi)/'$jpar' as Jsiswa from edomdata group by idprogstudi) t2 on t1.idprogstudi = t2.idprogstudi set t1.jmlmhs = t2.Jsiswa") or die("error jsiswa:".mysqli_error());
mysqli_query($plm_edom, "update edomtemp03 t1 inner join (select idprogstudi, sum(v1) as Jsc from edomdata group by idprogstudi) t2 on t1.idprogstudi = t2.idprogstudi set t1.jumlah = t2.Jsc") or die("error jumlah:".mysqli_error());
mysqli_query($plm_edom, "update edomtemp03 set score=jumlah/(jmlmhs*'$jpar')")or die("error score:".mysqli_error());
//-
//header("Location:edomreport3-pdf.php");
//header("Location:../spmadmin.php");

?>
