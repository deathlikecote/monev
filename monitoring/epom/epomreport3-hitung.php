<?php
include "./../../include/koneksi.php";


//-- hitung juml parameter
$qry=mysqli_fetch_assoc(mysqli_query($plm_edom, "select count(parameter) as vjpar from edomparameter"));
$jpar=$qry['vjpar'];

//echo " truncate & insert....<br>";
mysqli_query($plm_edom, "TRUNCATE TABLE epomtemp03");

mysqli_query($plm_edom, "INSERT INTO epomtemp03 (idprogstudi, aspek) 
(select idprogstudi, aspek from epomdata group by idprogstudi, aspek)") ;

//echo " update nama prodi & nama jurusan ...<br>";
mysqli_query($plm_edom, "update epomtemp03 t31 inner join (select idprogstudi, namaprodi, jurprodi from m_programstudi group by idprogstudi) t32 
on t31.idprogstudi = t32.idprogstudi set t31.namaprodi=t32.namaprodi, t31.jurprodi=t32.jurprodi");

//echo " update jumlah point & jumlah mhs ...<br>";
mysqli_query($plm_edom, "update epomtemp03 t1 join (select idprogstudi, aspek, sum(v1) as jSC , count(id) as jSis from epomdata group by idprogstudi, aspek) t2 
on t1.idprogstudi = t2.idprogstudi and t1.aspek=t2.aspek set t1.jumlah=t2.jSC, t1.jmlmhs=t2.jSis");

//echo " update score aspek ...<br>";
mysqli_query($plm_edom, "update epomtemp03 set scoreas=jumlah/jmlmhs");

//echo " update score prodi ...<br>";
mysqli_query($plm_edom, "update epomtemp03 t11 join (select idprogstudi, avg(scoreas) as jtot from epomtemp03 group by idprogstudi) t12 
on t11.idprogstudi = t12.idprogstudi set t11.scorep=t12.jtot") ;

//echo " update score jurusan ...<br>";
mysqli_query($plm_edom, "update epomtemp03 t21 join (select jurprodi, avg(scorep) as jtotp from epomtemp03 group by jurprodi) t22 
on t21.jurprodi = t22.jurprodi set t21.scorej=t22.jtotp") ;

?>
