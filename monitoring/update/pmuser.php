<?php

include "../../include/koneksi.php";


$sql=mysqli_query($plm_edom, 'select * from edompotensi group by nim');
while($r=mysqli_fetch_array($sql)){
$update=mysqli_query($plm, 'update dbsiswa set statusedom=1 where nim='.$r['nim'].' and statusedom=0');
if(!$update){
		echo "error";
	}else{
		

	}
}
$sql2=mysqli_query($plm, 'select COUNT(nim) as nim  from dbsiswa where statusedom=1');
		$r2=mysqli_fetch_array($sql2);
		echo "update sukses ".$r2['nim']." <br>";
?>