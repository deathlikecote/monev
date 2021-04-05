<?php

	mysqli_query($Open, "DELETE FROM tnilaiepod where ta = '".$_SESSION['perta']."'");
	mysqli_query($Open, "ALTER TABLE tnilaiepod AUTO_INCREMENT = 1");
$nilaiepod=mysqli_query($Open, "SELECT * from v_nilai_epod");

		while($r_nilaiepod=mysqli_fetch_array($nilaiepod)){
$cari=mysqli_query($Open, "SELECT * from tnilaiepod where kodedp='".$r_nilaiepod['kodedp']."' and ta = '".$r_nilaiepod['ta']."' and per ='".$r_nilaiepod['per']."' and utsuas ='".$r_nilaiepod['utsuas']."'");		
	$rcari=mysqli_num_rows($cari);
	if($rcari<1){
		$sql = mysqli_query($Open, "insert into tnilaiepod (kodedp, kodedosen, kodemk, idprogstudi, ta, per, utsuas, A, B, C, total) values ('$r_nilaiepod[kodedp]', '$r_nilaiepod[kodedosen]', '$r_nilaiepod[kodemk]', '$r_nilaiepod[idprogstudi]', '$r_nilaiepod[ta]', '$r_nilaiepod[per]', '$r_nilaiepod[utsuas]', '$r_nilaiepod[A]', '$r_nilaiepod[B]', '$r_nilaiepod[C]', '$r_nilaiepod[total]')");	
		
		

	}else{}
	

		}
		
	
		
?>


 