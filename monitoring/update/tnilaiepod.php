<?php

	mysqli_query($plm_edom, "DELETE FROM tNilaiEpod where ta = '".$_SESSION['pertan']."'");
	mysqli_query($plm_edom, "ALTER TABLE tNilaiEpod AUTO_INCREMENT = 1");
$nilaiepod=mysqli_query($plm_edom, "SELECT * from v_nilai_epod");

		while($r_nilaiepod=mysqli_fetch_array($nilaiepod)){
$cari=mysqli_query($plm_edom, "SELECT * from tNilaiEpod where kodedp='".$r_nilaiepod['kodedp']."' and ta = '".$r_nilaiepod['ta']."' and per ='".$r_nilaiepod['per']."' and utsuas ='".$r_nilaiepod['utsuas']."'");		
	$rcari=mysqli_num_rows($cari);
	if($rcari<1){
		$sql = mysqli_query($plm_edom, "insert into tNilaiEpod (kodedp, kodedosen, kodemk, idprogstudi, ta, per, utsuas, A, B, C, total) values ('$r_nilaiepod[kodedp]', '$r_nilaiepod[kodedosen]', '$r_nilaiepod[kodemk]', '$r_nilaiepod[idprogstudi]', '$r_nilaiepod[ta]', '$r_nilaiepod[per]', '$r_nilaiepod[utsuas]', '$r_nilaiepod[A]', '$r_nilaiepod[B]', '$r_nilaiepod[C]', '$r_nilaiepod[total]')");	
		
		

	}else{}
	

		}
		
	
		
?>


 