<?php
include "./../../include/koneksi.php";
// ------ update field f

include "tepomoverall.php";
include "tnilaiepom.php";
$a=0;
//mysqli_query($plm_edom, 'TRUNCATE TABLE epomdata_es');
$sql_edop=mysqli_query($plm_edom, "SELECT * from v_epom_es");

		while($r_edop=mysqli_fetch_array($sql_edop)){
$cari=mysqli_query($plm_edom, "SELECT * from epomdata_es where idprogstudi = '".$r_edop['idprogstudi']."' and ta = '".$r_edop['ta']."' and per ='".$r_edop['per']."' and utsuas ='".$r_edop['utsuas']."'");		
	$rcari=mysqli_num_rows($cari);
	if($rcari<1){
		$sql = mysqli_query($plm_edom, "insert into epomdata_es (ta,per,utsuas,idprogstudi,namaprodi,jurprodi,A,B,C,D,total) values ('$r_edop[ta]','$r_edop[per]','$r_edop[utsuas]','$r_edop[idprogstudi]','$r_edop[namaprodi]','$r_edop[jurprodi]','$r_edop[A]','$r_edop[B]','$r_edop[C]','$r_edop[D]','$r_edop[total]')");	
		$a=$a+1;
		if(!$sql){
			echo "error di ".$r_edop['idprogstudi']."<br>";
		}else{
			echo "update EPOM data sukses <br>";

			//echo'<meta http-equiv="refresh" content="0">';
		}
	}else{
		echo "Update sudah dilakukan <br>";
	}

		}
		
	
		
?>