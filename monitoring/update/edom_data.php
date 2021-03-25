<?php
include "./../../include/koneksi.php";

// ------ update field f

include "tedomoverall.php";
include "tnilaiedom.php";
$a=0;

$sql_edop=mysqli_query($plm_edom, "SELECT * from v_edomfinaltotal group by kode, ta, per");

		while($r_edop=mysqli_fetch_array($sql_edop)){
$cari=mysqli_query($plm_edom, "SELECT * from edomdata_es where ta = '".$r_edop['ta']."' and per ='".$r_edop['per']."' and kode ='".$r_edop['kode']."'");		
	$rcari=mysqli_num_rows($cari);
	if($rcari<1){
		$sql = mysqli_query($plm_edom, "insert into edomdata_es (kode,kode2,kodedosen,namadosen,kodemk,idprogstudi,kelas,ta,per,utsuas,A,B,C,D,total) values ('$r_edop[kode]','$r_edop[kode2]','$r_edop[kodedosen]','$r_edop[namadosen]','$r_edop[kodemk]','$r_edop[idprogstudi]','$r_edop[kelas]','$r_edop[ta]','$r_edop[per]','$r_edop[utsuas]','$r_edop[A]','$r_edop[B]','$r_edop[C]','$r_edop[D]','$r_edop[total]')");	
		$a=$a+1;
		if(!$sql){
			echo "error di ".$r_edop['kodedosen']." - ".$r_edop['kelas']." - ".$r_edop['kodemk']."<br>";
		}else{
			echo "Update EDOM data sukses <br>";

			//echo'<meta http-equiv="refresh" content="0">';
		}

	}else{
			echo "Update sudah dilakukan <br>";

			//echo'<meta http-equiv="refresh" content="0">';
		}
	

		}
		
	
		
?>