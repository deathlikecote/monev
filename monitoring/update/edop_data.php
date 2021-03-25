<?php
include "./../../include/koneksi.php";
// ------ update field f

include "tedopoverall.php";
include "tnilaiedop.php";
include "tedoppresentasi.php";
$a=0;
//mysqli_query($plm_edom, 'TRUNCATE TABLE edopdata_es');
$sql_edop=mysqli_query($plm_edom, "SELECT * from v_edop_es");

		while($r_edop=mysqli_fetch_array($sql_edop)){
	$cari=mysqli_query($plm_edom, "SELECT * from edopdata_es where ta = '".$r_edop['ta']."' and per ='".$r_edop['per']."' and utsuas ='".$r_edop['utsuas']."' and kedop ='".$r_edop['kedop']."'");		
	$rcari=mysqli_num_rows($cari);
	if($rcari<1){

	$sql = mysqli_query($plm_edom, "insert into edopdata_es (kedop,kodedosen,namadosen,kodemk,idprogstudi,ta,per,utsuas,A,B,C,total) values ('$r_edop[kedop]','$r_edop[kodedosen]','$r_edop[namadosen]','$r_edop[kodemk]','$r_edop[idprogstudi]','$r_edop[ta]','$r_edop[per]','$r_edop[utsuas]','$r_edop[A]','$r_edop[B]','$r_edop[C]','$r_edop[total]')");	
	$a=$a+1;
	if(!$sql){
		echo "error di ".$r_edop['kodedosen']." - ".$r_edop['kelas']." - ".$r_edop['kodemk']."<br>";
	}else{
		echo "update EDOP data sukses <br>";

		//echo'<meta http-equiv="refresh" content="0">';
	}
	}else{
		echo "Update sudah dilakukan <br>";
	}

		}
		
	
		
?>