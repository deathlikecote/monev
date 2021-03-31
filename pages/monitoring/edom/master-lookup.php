
<?php
	session_start();
	include "../../../config/koneksi.php";
	if($_POST['jenis'] == 'pilihKodex') {
		$perta	= $_POST['perta'];
		if($_SESSION['perta'] != $perta){
			$wheres = $perta;
		}else{
			$wheres = '';
		}
		$qry = mysqli_query($Open,"SELECT *, CONCAT(kodedosen,kodemk,idprogstudi,kelas) AS kodex FROM edompotensi$wheres where ta = '".$_SESSION['perta']."' and spote != 0 GROUP BY kodedosen,kodemk,idprogstudi,kelas ORDER BY concat(idprogstudi,kelas) ASC
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
	} else if($_POST['jenis'] == 'pilihMkEdop') {
		$perta	= $_POST['perta'];
		$qry = mysqli_query($Open,"SELECT a.kdprodi, b.namaprodi FROM t_penugasan a, m_prodi b 
			WHERE 
			a.perta = '$perta' AND 
			a.kodedosen = '".$_SESSION['id_user']."' AND
			b.kodeprodi = a.kdprodi
			GROUP BY a.kdprodi
			");

		echo '<option value="" disabled selected>--Pilih Prodi--</option>';
		if(mysqli_num_rows($qry) > 0){
			while ($r = mysqli_fetch_array($qry)) {
				echo '<option value="'.$r['kdprodi'].'">'.$r['kdprodi'].' | '.$r['namaprodi'].'</option><br>';
			}
		}else{
			echo '<option value="">Data Tidak Ditemukan</option><br>';
		}
	}	
	
?>