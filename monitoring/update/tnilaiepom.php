<?php

mysqli_query($plm_edom, "DELETE FROM tNilaiEpom where ta = '".$_SESSION['pertan']."'");
mysqli_query($plm_edom, "ALTER TABLE tNilaiEpom AUTO_INCREMENT = 1");
$epomoverall=mysqli_query($plm_edom, "SELECT * from v_nilai_epom");

		while($r_epomoverall=mysqli_fetch_array($epomoverall)){
$cari=mysqli_query($plm_edom, "SELECT * from tNilaiEpom where kode='".$r_epomoverall['kode']."' and ta = '".$r_epomoverall['ta']."' and per ='".$r_epomoverall['per']."' and utsuas ='".$r_epomoverall['utsuas']."'");		
	$rcari=mysqli_num_rows($cari);
	if($rcari<1){
		$sql = mysqli_query($plm_edom, "insert into tNilaiEpom (kode, kelas_id, idprogstudi, ta, per, utsuas, A, B, C, D, total) values ('$r_epomoverall[kode]', '$r_epomoverall[kelas_id]', '$r_epomoverall[idprogstudi]', '$r_epomoverall[ta]', '$r_epomoverall[per]', '$r_epomoverall[utsuas]', '$r_epomoverall[A]', '$r_epomoverall[B]', '$r_epomoverall[C]', '$r_epomoverall[D]', '$r_epomoverall[total]')");	
		
		

	}else{}
	

		}
		
	
		
?>


 