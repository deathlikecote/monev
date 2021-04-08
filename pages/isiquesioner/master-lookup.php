
<?php
	session_start();
	include "../../config/koneksi.php";
	if($_POST['jenis'] == 'pilihMkEdom') {
		$perta	= $_POST['perta'];
		$qry = mysqli_query($Open,"SELECT a.kodemk, b.namamk FROM t_penugasan a, m_matakuliah b 
			WHERE 
			a.perta = '$perta' AND 
			a.kodedosen = '".$_SESSION['id_user']."' AND
			b.kodemk = a.kodemk
			GROUP BY a.kodemk
			");

		echo '<option value="" selected>--Pilih MK--</option>';
		if(mysqli_num_rows($qry) > 0){
			while ($r = mysqli_fetch_array($qry)) {
				echo '<option value="'.$r['kodemk'].'">'.$r['kodemk'].' | '.$r['namamk'].'</option><br>';
			}
		}else{
			echo '<option value="">Data Tidak Ditemukan</option><br>';
		}
	} else if($_POST['jenis'] == 'pilihMkEdop') {
		$perta	= $_POST['perta'];
		$qry = mysqli_query($Open,"SELECT * FROM tedopoverall where kodedosen='".strtoupper($_SESSION['id_user'])."' and ta='$perta'
			");

		echo '<option value="" selected>--Pilih Prodi--</option>';
		if(mysqli_num_rows($qry) > 0){
			while ($r = mysqli_fetch_array($qry)) {
				echo '<option value="'.$r['idprogstudi'].'">'.$r['idprogstudi'].'</option><br>';
			}
		}else{
			echo '<option value="">Data Tidak Ditemukan</option><br>';
		}
	}	
	
?>