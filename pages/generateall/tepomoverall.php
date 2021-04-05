<?php

mysqli_query($Open, "DELETE FROM tepomoverall where ta = '".$_SESSION['perta']."'");
mysqli_query($Open, "ALTER TABLE tepomoverall AUTO_INCREMENT = 1");
$epomoverall=mysqli_query($Open, "SELECT * from v_epom_overall");

		while($r_epomoverall=mysqli_fetch_array($epomoverall)){
$cari=mysqli_query($Open, "SELECT * from tepomoverall where idprogstudi='".$r_epomoverall['idprogstudi']."' and ta = '".$r_epomoverall['ta']."' and per ='".$r_epomoverall['per']."' and utsuas ='".$r_epomoverall['utsuas']."'");		
	$rcari=mysqli_num_rows($cari);
	if($rcari<1){
		$sql = mysqli_query($Open, "insert into tepomoverall (idprogstudi,ta,per,utsuas,A,B,C,D,total) values ('$r_epomoverall[idprogstudi]','$r_epomoverall[ta]','$r_epomoverall[per]','$r_epomoverall[utsuas]','$r_epomoverall[A]','$r_epomoverall[B]','$r_epomoverall[C]','$r_epomoverall[D]','$r_epomoverall[total]')");	
		
		

	}else{}
	

		}
		
	
		
?>