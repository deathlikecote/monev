
<?php
session_start();
include "../../../config/koneksi.php";

$perta	= $_POST['perta'];
if ($_SESSION['perta'] != $perta) {
	$wheres = $perta;
} else {
	$wheres = '';
}

if ($_POST['jenis'] == 'pilihKodexR1') {
	$qry = mysqli_query($Open, "SELECT * FROM epompotensi$wheres WHERE ta = '" . $perta . "'");
	if (mysqli_num_rows($qry)) {

		$qry = mysqli_query($Open, "SELECT distinct(kode), idprogstudi, kelas_id FROM epomdata$wheres order by kode
			");

		echo '<option value="" disabled selected>--Pilih Kode--</option>';
		if (mysqli_num_rows($qry) > 0) {
			while ($r = mysqli_fetch_array($qry)) {
				$skode = $r["kode"];
				echo '<option value="' . $skode . '">' . $r['idprogstudi'] . ' ' . $r['kelas_id'] . '</option><br>';
			}
		} else {
			echo '<option value="">Data Tidak Ditemukan</option><br>';
		}
	} else {
		echo '<option value="">Data Tidak Ditemukan</option><br>';
	}
} else if ($_POST['jenis'] == 'pilihKodexR2') {
	$qry = mysqli_query($Open, "SELECT * FROM epompotensi$wheres WHERE ta = '" . $perta . "'");
	if (mysqli_num_rows($qry)) {
		$qry = mysqli_query($Open, "SELECT distinct(idprogstudi) FROM epomdata$wheres order by idprogstudi
			");

		echo '<option value="" disabled selected>--Pilih Kode--</option>';
		if (mysqli_num_rows($qry) > 0) {
			while ($r = mysqli_fetch_array($qry)) {
				$skode = $r["idprogstudi"];
				echo '<option value="' . $skode . '">' . $skode . '</option><br>';
			}
		} else {
			echo '<option value="">Data Tidak Ditemukan</option><br>';
		}
	} else {
		echo '<option value="">Data Tidak Ditemukan</option><br>';
	}
}

?>