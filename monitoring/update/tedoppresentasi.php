<?php

mysqli_query($plm_edom, "DELETE FROM tEdopNilaiPresentase where ta = '".$_SESSION['pertan']."'");
mysqli_query($plm_edom, "ALTER TABLE tEdopNilaiPresentase AUTO_INCREMENT = 1");
$edomoverall=mysqli_query($plm_edom, "SELECT * from v_edopnilai_presentase");

		while($r_edomoverall=mysqli_fetch_array($edomoverall)){
$cari=mysqli_query($plm_edom, "SELECT * from tEdopNilaiPresentase where kedop='".$r_edomoverall['kedop']."' and ta = '".$r_edomoverall['ta']."' and per ='".$r_edomoverall['per']."' and utsuas ='".$r_edomoverall['utsuas']."'");		
	$rcari=mysqli_num_rows($cari);
	if($rcari<1){
		$sql = mysqli_query($plm_edom, "insert into tEdopNilaiPresentase (id, parameter, aspek, jenis, v1, id_parameter, id_potensi, kodedosen, kodemk, idprogstudi, ta, per, utsuas, kedop, kodedp) values ('$r_edomoverall[id]', '$r_edomoverall[parameter]', '$r_edomoverall[aspek]', '$r_edomoverall[jenis]', '$r_edomoverall[v1]', '$r_edomoverall[id_parameter]', '$r_edomoverall[id_potensi]', '$r_edomoverall[kodedosen]', '$r_edomoverall[kodemk]', '$r_edomoverall[idprogstudi]', '$r_edomoverall[ta]', '$r_edomoverall[per]', '$r_edomoverall[utsuas]', '$r_edomoverall[kedop]', '$r_edomoverall[kodedp]')");	
		
		

	}else{}
	

		}
		
	
		
?>


 