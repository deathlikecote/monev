<?php
// 	definisi nama database dan tabel 
//include("dbspmconn.php");
include "../../include/koneksi.php";

// update 'kode' di edompotensi(kode=kodedosen,kodemk,idprogstudi,kelas)
/*mysqli_query($plm_edom, "UPDATE edompotensi SET kode=CONCAT(kodedosen,kodemk,idprogstudi,kelas), kode2=CONCAT(kodedosen,idprogstudi)") or die("error:".mysql_error());*/

// create data list dosen (kode)
mysqli_query($plm_edom, "DELETE FROM edompotensidistinct");
mysqli_query($plm_edom, "TRUNCATE TABLE edompotensidistinct");
mysqli_query($plm_edom, "INSERT INTO edompotensidistinct (kode,kodedosen,kodemk,idprogstudi,kelas) select kode,kodedosen,kodemk,idprogstudi,kelas from edompotensi group by kode") or die("error insert:".mysql_error());
mysqli_query($plm_edom, "UPDATE edompotensidistinct SET kode2=CONCAT(idprogstudi,kelas), nomor=id") or die("error insert:".mysql_error());
/*mysqli_query($plm_edom, "UPDATE edompotensi INNER JOIN dosenslash ON edompotensi.kodedosen = dosenslash.kodedosen SET edompotensi.namadosen = dosenslash.namadosen") or die("error update namdosen:".mysql_error());*/

?>
