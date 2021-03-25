<?php
// 	definisi nama database dan tabel 
include "../../include/koneksi.php";

$qry=mysqli_fetch_assoc(mysqli_query($plm_edom, "select count(parameter) as vjpar from edomparameter"));
$jpar=$qry['vjpar'];

//--ok
mysqli_query($plm_edom, "TRUNCATE TABLE edomtemp05");
mysqli_query($plm_edom, "INSERT INTO edomtemp05 (kodedosen) (select distinct(kodedosen) from edomdata)") or die(mysqli_error());
mysqli_query($plm_edom, "UPDATE edomtemp05 INNER JOIN edompotensi ON edomtemp05.kodedosen = edompotensi.kodedosen SET edomtemp05.namadosen = edompotensi.namadosen") or die(mysqli_error());
mysqli_query($plm_edom, "update edomtemp05 t1 inner join (select kodedosen, count(kodedosen)/'$jpar' as Jsiswa from edomdata group by kodedosen) t2 on t1.kodedosen = t2.kodedosen set t1.jmlmhs = t2.Jsiswa") or die("error jsiswa:".mysqli_error());
mysqli_query($plm_edom, "update edomtemp05 t1 inner join (select kodedosen, sum(v1) as Jsc from edomdata group by kodedosen) t2 on t1.kodedosen = t2.kodedosen set t1.jumlah = t2.Jsc") or die("error jumlah:".mysqli_error());
mysqli_query($plm_edom, "update edomtemp05 set score=jumlah/(jmlmhs*'$jpar')")or die("error score:".mysqli_error());


?>
