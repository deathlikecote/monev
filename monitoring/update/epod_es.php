<?php
include "./../../include/koneksi.php";

// ------ update field 


$a=0;
mysqli_query($plm_edom, 'TRUNCATE TABLE epod_diagram_es');
$sql_edop=mysqli_query($plm_edom, "SELECT * from v_epod_diagram_es_final");

		while($r_edop=mysqli_fetch_array($sql_edop)){
		
		
	
	$sql = mysqli_query($plm_edom, "insert into epod_diagram_es (keterangan,jumlah,total,persen,ta,per,utsuas) values ('$r_edop[keterangan]','$r_edop[jumlah]','$r_edop[total]','$r_edop[persen]','$r_edop[ta]','$r_edop[per]','$r_edop[utsuas]')");	
	$a=$a+1;
	if(!$sql){
		echo "eror";
	}else{
		echo "update EPOD DIAGRAM sukses <br>";

		//echo'<meta http-equiv="refresh" content="0">';
	}

		}
		
	
/*
$sql_edop=mysql_query("UPDATE edomdata JOIN edompot_kosong ON edomdata.id_potensi=edompot_kosong.id SET edomdata.kodedosen = edompot_kosong.kodedosen, edomdata.idprogstudi = edompot_kosong.idprogstudi, edomdata.kodemk = edompot_kosong.kodemk, edomdata.kelas = edompot_kosong.kelas, edomdata.kode = edompot_kosong.kode");	
	if(!$sql_edop){
	echo "update edomdata gagal id_potensi<br> ".$sql_edop."";
	}else{
	echo "update edomdata sukses id_potensi<br> ".$sql_edop."";

	}*/	
		
?>