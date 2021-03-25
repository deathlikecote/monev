       <?php

include "./../include/koneksi.php";

// ------ update field 


$a=0;

$sql_edop=mysqli_query($plm_edom, "SELECT * from update_edomdata limit 6");

		while($r_edop=mysql_fetch_array($sql_edop)){
		
		
	
	$sql = mysqli_query($plm_edom, "UPDATE edomdata SET idprogstudi='".$r_edop['idprogstudi']."', kode='".$r_edop['kode']."' WHERE id_potensi='".$r_edop['id']."'");	
	$a=$a+1;
	if(!$sql){
		echo "eror";
		echo'<meta http-equiv="refresh" content="0">';
	}else{
		echo "update edomdata sukses id_potensi = ".$r_edop['id']." <br>";

		echo'<meta http-equiv="refresh" content="0">';
	}

		}
		
	
/*
$sql_edop=mysqli_query("UPDATE edomdata JOIN edompot_kosong ON edomdata.id_potensi=edompot_kosong.id SET edomdata.kodedosen = edompot_kosong.kodedosen, edomdata.idprogstudi = edompot_kosong.idprogstudi, edomdata.kodemk = edompot_kosong.kodemk, edomdata.kelas = edompot_kosong.kelas, edomdata.kode = edompot_kosong.kode");	
	if(!$sql_edop){
	echo "update edomdata gagal id_potensi<br> ".$sql_edop."";
	}else{
	echo "update edomdata sukses id_potensi<br> ".$sql_edop."";

	}
	
	
	 mysqli_query("UPDATE edomdata SET idprogstudi='".$r_edop['idprogstudi']."' WHERE id_potensi='".$r_edop['id']."'")*/	
		
?>