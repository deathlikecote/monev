<?php
// 	definisi nama database dan tabel 
include("../dbsql/dbspmconn.php");


// exoxpotensi
mysql_query("update exoxpotensi set kedop=concat(kodedosen,kodemk,idprogstudi), kodedp=concat(kodedosen,idprogstudi)") or die("update exoxpotensi : ".mysql_error());


// update edopdata
mysql_query("UPDATE edopdata t1 join (select id, kodedosen, idprogstudi, kodedp, kedop from exoxpotensi) t2 
on t1.id_potensi=t2.id SET t1.kodedosen=t2.kodedosen,t1.idprogstudi=t2.idprogstudi, t1.kodedp=t2.kodedp, t1.kedop=t2.kedop") or die("error edopdata:".mysql_error());



?>
