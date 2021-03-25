<?php

mysqli_query($plm_edom, "DELETE FROM tNilaiEdop where ta = '".$_SESSION['pertan']."'");
		mysqli_query($plm_edom, "ALTER TABLE tNilaiEdop AUTO_INCREMENT = 1");
		
$edomoverall=mysqli_query($plm_edom, "SELECT * from v_nilai_edop");

		while($r_edomoverall=mysqli_fetch_array($edomoverall)){
$cari=mysqli_query($plm_edom, "SELECT * from tNilaiEdop where kodedosen='".$r_edomoverall['kodedosen']."' and kodemk = '".$r_edomoverall['kodemk']."' and idprogstudi = '".$r_edomoverall['idprogstudi']."' and ta = '".$r_edomoverall['ta']."' and per ='".$r_edomoverall['per']."' and utsuas ='".$r_edomoverall['utsuas']."'");		
	$rcari=mysqli_num_rows($cari);
	if($rcari<1){
		$sql = mysqli_query($plm_edom, "insert into tNilaiEdop (kedop,kodedosen,kodemk,idprogstudi,ta,per,utsuas,A,B,C,total) values ('$r_edomoverall[kedop]','$r_edomoverall[kodedosen]','$r_edomoverall[kodemk]','$r_edomoverall[idprogstudi]','$r_edomoverall[ta]','$r_edomoverall[per]','$r_edomoverall[utsuas]','$r_edomoverall[A]','$r_edomoverall[B]','$r_edomoverall[C]','$r_edomoverall[total]')");	
		
		

	}else{}
	

		}
		
	
		
?>


 