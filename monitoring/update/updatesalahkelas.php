<?php 
include "../dbsql/dbspmconn.php";
$hasil=mysql_query("select * from edompotensi where idprogstudi='SIP' and kelas='12:' ") or die("error:".mysql_error());
while($r=mysql_fetch_array($hasil)){
/*echo $r[kelas].'  '.$r[idprogstudi].'  '.$r[kode] ;
echo substr($r[kode],-1);
echo"<br>"; //and kelas='12:'*/
$kelas1=substr($r[kode],-1);
mysql_query("update edompotensi set kelas='$kelas1' where idprogstudi='SIP' and nim='$r[nim]'") or die("error:".mysql_error());

}
//echo substr($r[kode],-1);
//$hasil=mysql_query("select * from edompotensi where nim='201218221'") or die("error:".mysql_error());
//$r=mysql_fetch_array($hasil);
?>