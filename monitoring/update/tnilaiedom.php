<?php


		mysqli_query($plm_edom, "DELETE FROM tNilaiEdom where ta = '".$_SESSION['pertan']."'");
		mysqli_query($plm_edom, "ALTER TABLE tNilaiEdom AUTO_INCREMENT = 1");
		
		$edomoverall=mysqli_query($plm_edom, "SELECT * from v_nilai_edom");

		while($r_edomoverall=mysqli_fetch_array($edomoverall)){
		$cari=mysqli_query($plm_edom, "SELECT * from tNilaiEdom where kode='".$r_edomoverall['kode']."' and ta = '".$r_edomoverall['ta']."' and per ='".$r_edomoverall['per']."' and utsuas ='".$r_edomoverall['utsuas']."'");		
		$rcari=mysqli_num_rows($cari);
		if($rcari<1){
			$sql = mysqli_query($plm_edom, "insert into tNilaiEdom (id_potensi, kode, kodedosen, kodemk, idprogstudi, kelas, ta, per, utsuas, A, B, C, D, total) values ('$r_edomoverall[id_potensi]', '$r_edomoverall[kode]', '$r_edomoverall[kodedosen]', '$r_edomoverall[kodemk]', '$r_edomoverall[idprogstudi]', '$r_edomoverall[kelas]', '$r_edomoverall[ta]', '$r_edomoverall[per]', '$r_edomoverall[utsuas]', '$r_edomoverall[A]', '$r_edomoverall[B]', '$r_edomoverall[C]', '$r_edomoverall[D]', '$r_edomoverall[total]')");	
			
			

		}else{}
		

			}
		
	
		
?>


 