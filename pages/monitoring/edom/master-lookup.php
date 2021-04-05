
<?php
	session_start();
	include "../../../config/koneksi.php";

	$perta	= $_POST['perta'];
	if($_SESSION['perta'] != $perta){
		$wheres = $perta;
	}else{
		$wheres = '';
	}

	if($_POST['jenis'] == 'pilihKodex') {
		
		$qry = mysqli_query($Open,"SELECT *, CONCAT(kodedosen,kodemk,idprogstudi,kelas) AS kodex FROM edompotensi$wheres where ta = '".$wheres."' and spote != 0 GROUP BY kodedosen,kodemk,idprogstudi,kelas ORDER BY concat(idprogstudi,kelas) ASC
			");

		echo '<option value="" disabled selected>--Pilih Kode--</option>';
		if(mysqli_num_rows($qry) > 0){
			while ($r = mysqli_fetch_array($qry)) {
				$skode = $r["kodex"];
				echo '<option value="'.$skode.'">'.$r['idprogstudi'].' '.$r['kelas'].' | '.$r['kodedosen'].' | '.$r['namamk'].'</option><br>';
			}
		}else{
			echo '<option value="">Data Tidak Ditemukan</option><br>';
		}
	} else if($_POST['jenis'] == 'pilihKodexR2') {
		$qry = mysqli_query($Open,"SELECT *,CONCAT(idprogstudi,kelas) AS kodex 
			FROM edompotensi$wheres WHERE 
			ta = '".$wheres."' 
			GROUP BY idprogstudi,kelas 
			ORDER BY CONCAT(idprogstudi,kelas) ASC
			");

		echo '<option value="" disabled selected>--Pilih Kode--</option>';
		if(mysqli_num_rows($qry) > 0){
			while ($r = mysqli_fetch_array($qry)) {
				$skode = $r["kodex"];
				echo '<option value="'.$skode.'">'.$r['idprogstudi'].' | '.$r['kelas'].'</option><br>';
			}
		}else{
			echo '<option value="">Data Tidak Ditemukan</option><br>';
		}
	}	
	
?>