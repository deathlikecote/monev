<?php
		

		mysqli_query($plm_edom, "DELETE FROM tEdomOverall where ta = '".$_SESSION['pertan']."'");
		mysqli_query($plm_edom, "ALTER TABLE tEdomOverall AUTO_INCREMENT = 1");
		
		$edomoverall=mysqli_query($plm_edom, "SELECT * from v_edom_overall");

		while($r_edomoverall=mysqli_fetch_array($edomoverall)){
			$cari=mysqli_query($plm_edom, "SELECT * from tEdomOverall where kodedosen='".$r_edomoverall['kodedosen']."' and kodemk = '".$r_edomoverall['kodemk']."' and ta = '".$r_edomoverall['ta']."' and per ='".$r_edomoverall['per']."' and utsuas ='".$r_edomoverall['utsuas']."'");		
			$rcari=mysqli_num_rows($cari);
			if($rcari<1){
				$sql = mysqli_query($plm_edom, "insert into tEdomOverall (kodedosen,kodemk,ta,per,utsuas,A,B,C,D,total) values ('$r_edomoverall[kodedosen]','$r_edomoverall[kodemk]','$r_edomoverall[ta]','$r_edomoverall[per]','$r_edomoverall[utsuas]','$r_edomoverall[A]','$r_edomoverall[B]','$r_edomoverall[C]','$r_edomoverall[D]','$r_edomoverall[total]')");	
				
				

			}else{}
			

		}
		
	
		
?>