<?php
// 	definisi nama database dan tabel 
include "./../../include/koneksi.php";

// update 'kode' di epompotensi(kode=idprogstudi,kelas)
//-ok mysql_query("UPDATE epoddata t1 join (select id, idprogstudi from exoxpotensi) t2 on t1.id_potensi=t2.id SET t1.idprogstudi=t2.idprogstudi") or die("error:".mysql_error());

//----

mysqli_query($plm_edom, "TRUNCATE TABLE epodtemp01");

mysqli_query($plm_edom, "update epoddata t1 join (select id, idprogstudi from exoxpotensi) t2 
on t1.id_potensi = t2.id set t1.idprogstudi=t2.idprogstudi") or die("update epoddata : ".mysql_error());



?>
