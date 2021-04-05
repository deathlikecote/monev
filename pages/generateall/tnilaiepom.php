<?php

mysqli_query($Open, "DELETE FROM tnilaiepom where ta = '".$_SESSION['perta']."'");
mysqli_query($Open, "ALTER TABLE tnilaiepom AUTO_INCREMENT = 1");
$epomoverall=mysqli_query($Open, "SELECT * from v_nilai_epom");

		while($r_epomoverall=mysqli_fetch_array($epomoverall)){
$cari=mysqli_query($Open, "SELECT * from tnilaiepom where kode='".$r_epomoverall['kode']."' and ta = '".$r_epomoverall['ta']."' and per ='".$r_epomoverall['per']."' and utsuas ='".$r_epomoverall['utsuas']."'");		
	$rcari=mysqli_num_rows($cari);
	if($rcari<1){
		$sql = mysqli_query($Open, "insert into tnilaiepom (kode, kelas_id, idprogstudi, ta, per, utsuas, A, B, C, D, total) values ('$r_epomoverall[kode]', '$r_epomoverall[kelas_id]', '$r_epomoverall[idprogstudi]', '$r_epomoverall[ta]', '$r_epomoverall[per]', '$r_epomoverall[utsuas]', '$r_epomoverall[A]', '$r_epomoverall[B]', '$r_epomoverall[C]', '$r_epomoverall[D]', '$r_epomoverall[total]')");	
		
		

	}else{}
	

		}
		
	
		
?>


 