<?php
		

		mysqli_query($Open, "DELETE FROM tedomoverall where ta = '".$_SESSION['perta']."'");
		mysqli_query($Open, "ALTER TABLE tedomoverall AUTO_INCREMENT = 1");
		
		$edomoverall=mysqli_query($Open, "SELECT * from v_edom_overall");

		while($r_edomoverall=mysqli_fetch_array($edomoverall)){
			$cari=mysqli_query($Open, "SELECT * from tedomoverall where kodedosen='".$r_edomoverall['kodedosen']."' and kodemk = '".$r_edomoverall['kodemk']."' and ta = '".$r_edomoverall['ta']."' and per ='".$r_edomoverall['per']."' and utsuas ='".$r_edomoverall['utsuas']."'");		
			$rcari=mysqli_num_rows($cari);
			if($rcari<1){
				$sql = mysqli_query($Open, "insert into tedomoverall (kodedosen,kodemk,ta,per,utsuas,A,B,C,D,total) values ('$r_edomoverall[kodedosen]','$r_edomoverall[kodemk]','$r_edomoverall[ta]','$r_edomoverall[per]','$r_edomoverall[utsuas]','$r_edomoverall[A]','$r_edomoverall[B]','$r_edomoverall[C]','$r_edomoverall[D]','$r_edomoverall[total]')");	
				
				

			}else{}
			

		}
		
	
		
?>