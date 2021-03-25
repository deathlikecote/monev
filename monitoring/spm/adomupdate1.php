<?php
// definisi nama database dan tabel 
include("dbspmconn.php");
//$hasil=mysql_query("update edomdatatemp set kodedosen=(select kodedosen from edompotensi pot) where edomdatatemp.id=pot.id") or die("error:".mysql_error());
//$hasil=mysql_query("update edomdatatemp set edomdatatemp.kodedosen=edompotensi.kodedosen from edomdatatemp inner join edompotensi on edomdatatemp.id=edompotensi.id") or die("error:".mysql_error());
//$hasil=mysql_query("update edomdatatemp set kodedosen=t2.kodedosen from edomdatatemp inner join edompotensi t2 on t1.id=t2.id") or die("error:".mysql_error());
//UPDATE Table1 SET Col2 = t2.Col2, Col3 = t2.Col3 FROM Table1 t1 INNER JOIN Table2 t2 ON t1.Col1 = t2.Col1 WHERE t1.Col1 
//UPDATE Table  SET Table.col1 = other_table.col1, Table.col2 = other_table.col2 FROM Table INNER JOIN other_table ON Table.id = other_table.id

$hasil=mysql_query("select * from edompotensi") or die("error:".mysql_error());
while($data=mysql_fetch_array($hasil)) { 
	$id=$data[id];
	$kmk=$data[kodemk];
	$kdd=$data[kodedosen];
	$idp=$data[idprogstudi];
	$kls=$data[kelas];
	$kode=$kdd . $kmk . $idp . $kls;
//	echo $kode;
//	break;
//	$cek=mysql_query("select * from edomdatatemp where id_potensi='$idpot'") or die("error:".mysql_error());
//	$datatemp=mysql_fetch_array($cek);
//	$cekv1=$datatemp[v1];
//	$cekidpar=$datatemp[id_parameter];
//	$kode=$kd . $kmk . $idp . $kls . $cekidpar;

//	error $upd=mysql_query("update edomdatatemp set kode=concat('$kode',id_parameter,v1) where id='$idpot'") or die("error:".mysql_error());
	$upd=mysql_query("update edomdatatemp set kodedosen='$kdd', kodemk='$kmk', idprogstudi='$idp', kelas='$kls', kode='$kode' where id_potensi='$id'") or die("error:".mysql_error());
}
?>
