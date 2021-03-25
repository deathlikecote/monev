<?php
// 	definisi nama database dan tabel 
include("../dbsql/dbspmconn.php");

$xkode='ant';
$xjnspar=2;
mysql_query("TRUNCATE TABLE edoptemp02");
mysql_query("insert into edoptemp02 (id_parameter, parameter, aspek, jenis) 
(select id, parameter, aspek, jenis from edopparameter where deleted=0)") or die("insert1 edoptemp01 : ".mysql_error());
mysql_query("update edoptemp02 set kode='$xkode'");

// scorepar
//mysql_query("update edoptemp02 t1 inner join (select id_parameter, kodedosen, aspek, jenis, sum(v1) as vv1 
//from edopdata where jenis='$xjnspar' group by id_parameter) as t2 
//on t1.kode=t2.kodedosen set t1.scorepar = t2.vv1") or die("error scorepar:".mysql_error());

$qscpar=mysql_query("select id_parameter, kodedosen, aspek, jenis, round(avg(v1),2) as vv1 from edopdata where jenis='$xjnspar' group by id_parameter") or die ("qry scorepar : ".mysql_error()); 
echo mysql_num_rows($qscpar)."<br>";
while ($scpar=mysql_fetch_array($qscpar)) {
	$sidp=$scpar['id_parameter'];
	$sv1=$scpar['vv1'];
	echo $sidp." - ".$sv1."<br>";
	mysql_query("update edoptemp02 set scorepar='$sv1' where id_parameter='$sidp'") or die ("update scorepar : ".mysql_error()); 
}

$qscpar1=mysql_query("select id_parameter, kodedosen, aspek, jenis, round(avg(v1),2) as vv11 from edopdata where jenis=3 group by id_parameter") or die ("qry scorepar : ".mysql_error()); 
echo mysql_num_rows($qscpar)."<br>";
while ($scpar1=mysql_fetch_array($qscpar1)) {
	$sidp1=$scpar1['id_parameter'];
	$sv11=$scpar1['vv11'];
	echo $sidp." - ".$sv1."<br>";
	mysql_query("update edoptemp02 set scorepar='$sv11' where id_parameter='$sidp1'") or die ("update scorepar : ".mysql_error()); 
}
 

mysql_query("update edoptemp02 t1 inner join (select id_parameter, aspek, jenis, round(avg(scorepar),2) as vas from edoptemp02 where jenis=2 group by aspek) as t2 
on t1.id_parameter=t2.id_parameter set t1.scoreas = t2.vas") or die("error scoreas2:".mysql_error());

?>
