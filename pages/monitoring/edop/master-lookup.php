
<?php
	session_start();
	include "../../../config/koneksi.php";

	$perta	= $_POST['perta'];
	if($_SESSION['perta'] != $perta){
		$wheres = $perta;
	}else{
		$wheres = '';
	}

	if($_POST['jenis'] == 'pilihKodexR1') {
		
		$qry = mysqli_query($Open,"SELECT distinct(kedop) from edopdata$wheres order by kedop
			");

		echo '<option value="" disabled selected>--Pilih Kode--</option>';
		if(mysqli_num_rows($qry) > 0){
			while ($r = mysqli_fetch_array($qry)) {
				$skode = $r["kedop"];
				echo '<option value="'.$skode.'">'.$skode.'</option><br>';
			}
		}else{
			echo '<option value="">Data Tidak Ditemukan</option><br>';
		}
	} else if($_POST['jenis'] == 'pilihKodexR2') {
		$qry = mysqli_query($Open,"SELECT idprogstudi from edopdata$wheres group by idprogstudi order by idprogstudi asc
			");

		echo '<option value="" disabled selected>--Pilih Kode--</option>';
		if(mysqli_num_rows($qry) > 0){
			while ($r = mysqli_fetch_array($qry)) {
				$skode = $r["idprogstudi"];
				echo '<option value="'.$skode.'">'.$skode.'</option><br>';
			}
		}else{
			echo '<option value="">Data Tidak Ditemukan</option><br>';
		}
		
	} else if($_POST['jenis'] == 'pilihKodexR3') {
		$qry = mysqli_query($Open,"SELECT distinct(kodedosen) from edopdata$wheres order by kodedosen
			");

		echo '<option value="" disabled selected>--Pilih Kode--</option>';
		if(mysqli_num_rows($qry) > 0){
			while ($r = mysqli_fetch_array($qry)) {
				$skode = $r["kodedosen"];
				echo '<option value="'.$skode.'">'.$skode.'</option><br>';
			}
		}else{
			echo '<option value="">Data Tidak Ditemukan</option><br>';
		}
	}	
	
?>