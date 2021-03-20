
<?php
	session_start();
	include "../../../config/koneksi.php";
	if($_POST['jenis'] == 'lookValFilter') {
		$lookVarFilter	= $_POST['lookVarFilter'];
		
		$qry = mysqli_query($Open,"SELECT DISTINCT(kelas) FROM t_kelas 
			WHERE 
			perta = '".$_SESSION['perta']."' AND 
			kdprodi = '".$lookVarFilter."'
			");

		echo '<option value="" disabled selected>--Pilih Kelas--</option>';
		while ($r = mysqli_fetch_array($qry)) {
		
			  echo '<option value="'.$r['kelas'].'">'.$r['kelas'].'</option><br>';
		
		}
	} else if($_POST['jenis'] == 'lookValFilterNim') {
		$kdprodi	= $_POST['kdprodi'];
		$kelas		= $_POST['kelas'];
		
		$qry = mysqli_query($Open,"SELECT nim, nama FROM t_kelas 
			WHERE 
			perta = '".$_SESSION['perta']."' AND 
			kdprodi = '".$kdprodi."' AND
			kelas = '".$kelas."' AND
			nim NOT IN (select DISTINCT(nim) FROM edompotensi )
			");

		echo '<option value="" disabled selected>--Pilih NIM--</option>';
		while ($r = mysqli_fetch_array($qry)) {
		
			  echo '<option value="'.$r['nim'].'">'.$r['nim'].' | '.$r['nama'].'</option><br>';
		
		}
	}	
	
?>