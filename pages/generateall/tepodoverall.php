<?php

mysqli_query($Open, "DELETE FROM tepodoverall where ta = '".$_SESSION['perta']."'");
	mysqli_query($Open, "ALTER TABLE tepodoverall AUTO_INCREMENT = 1");
$edomoverall=mysqli_query($Open, "SELECT * from v_epod_overall");

		while($r_edomoverall=mysqli_fetch_array($edomoverall)){
$cari=mysqli_query($Open, "SELECT * from tepodoverall where idprogstudi='".$r_edomoverall['idprogstudi']."' and ta = '".$r_edomoverall['ta']."' and per ='".$r_edomoverall['per']."' and utsuas ='".$r_edomoverall['utsuas']."'");		
	$rcari=mysqli_num_rows($cari);
	if($rcari<1){
		$sql = mysqli_query($Open, "insert into tepodoverall (idprogstudi,ta,per,utsuas,A,B,C,total) values ('$r_edomoverall[idprogstudi]','$r_edomoverall[ta]','$r_edomoverall[per]','$r_edomoverall[utsuas]','$r_edomoverall[A]','$r_edomoverall[B]','$r_edomoverall[C]','$r_edomoverall[total]')");	
		
		

	}else{}
	

		}
		
	
		
?>