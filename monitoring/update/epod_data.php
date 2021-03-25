<?php
include "./../../include/koneksi.php";
// ------ update field f

include "tepodoverall.php";
include "tnilaiepod.php";
$a=0;
//mysqli_query($plm_edom, 'TRUNCATE TABLE epoddata_es');
$sql_edop=mysqli_query($plm_edom, "SELECT * from v_epod_es");

	while($r_edop=mysqli_fetch_array($sql_edop)){
$cari=mysqli_query($plm_edom, "SELECT * from epoddata_es where ta = '".$r_edop['ta']."' and per ='".$r_edop['per']."' and utsuas ='".$r_edop['utsuas']."' and idprogstudi ='".$r_edop['idprogstudi']."'");      
    $rcari=mysqli_num_rows($cari);
    if($rcari<1){
    	$sql = mysqli_query($plm_edom, "insert into epoddata_es (idprogstudi,namaprodi,jurprodi,ta,per,utsuas,A,B,C,total) values ('$r_edop[idprogstudi]','$r_edop[namaprodi]','$r_edop[jurprodi]','$r_edop[ta]','$r_edop[per]','$r_edop[utsuas]','$r_edop[A]','$r_edop[B]','$r_edop[C]','$r_edop[total]')");	
    	$a=$a+1;
    	if(!$sql){
    		echo "error di ".$r_edop['idprogstudi']."<br>";
    	}else{
    		echo "update EPOD data sukses <br>";
    	}
    }else{
        echo "Update sudah dilakukan <br>";
    }

	}
		
	
		
?>