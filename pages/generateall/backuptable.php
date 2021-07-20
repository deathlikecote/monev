<?php
session_start();
include "../../config/koneksi.php";

function buattable($tabelbaru, $tabellama)
{
	$sql = "CREATE TABLE " . $tabelbaru . " select * from " . $tabellama . "";
	return $sql;
}

$status 	= '';
$result 	= '';
$tab1 		= "edomdata" . $_SESSION['perta'];
$tab2	 	= "edompotensi" . $_SESSION['perta'];
$tab3 		= "epomdata" . $_SESSION['perta'];
$tab4 		= "epompotensi" . $_SESSION['perta'];
$tab5 		= "edopdata" . $_SESSION['perta'];
$tab6 		= "epoddata" . $_SESSION['perta'];
$tab7 		= "exoxpotensi" . $_SESSION['perta'];
$tab8 		= "edomparameter" . $_SESSION['perta'];
$tab9 		= "epomparameter" . $_SESSION['perta'];
$tab10 		= "epodparameter" . $_SESSION['perta'];
$tab11 		= "edopparameter" . $_SESSION['perta'];

$ortab1		= "edomdata";
$ortab2		= "edompotensi";
$ortab3		= "epomdata";
$ortab4		= "epompotensi";
$ortab5		= "edopdata";
$ortab6		= "epoddata";
$ortab7		= "exoxpotensi";
$ortab8 	= "edomparameter";
$ortab9 	= "epomparameter";
$ortab10 	= "epodparameter";
$ortab11 	= "edopparameter";

for ($i = 1; $i < 12; $i++) {
	$tabel 	= "tab" . $i;
	$ori 	= "ortab" . $i;
	$result = mysqli_query($Open, "SHOW TABLES LIKE '" . $$tabel . "'");

	if (mysqli_num_rows($result) == 1) {
		mysqli_query($Open, "DROP table " . $$tabel . "");

		$sql = buattable($$tabel, $$ori);
		if (mysqli_query($Open, $sql)) {
			$status .= "Table <b>" . $$tabel . "</b> <b style='color:green'>Berhasil</b> di backup<br>";
		} else {
			$status .= "Table <b>" . $$tabel . "</b> <b style='color:red'>Gagal</b> di backup<br>";
		}
	} else {

		$sql = buattable($$tabel, $$ori);
		if (mysqli_query($Open, $sql)) {
			$status .= "Table <b>" . $$tabel . "</b> <b style='color:green'>Berhasil</b> di backup<br>";
		} else {
			$status .= "Table <b>" . $$tabel . "</b> <b style='color:red'>Gagal</b> di backup<br>";
		}
	}
}


echo $status;

?>

<script src="../../assets/plugins/jquery/jquery-2.1.4.min.js"></script>
<script>
	$(document).ready(function() {
		$('.loading').css({
			'visibility': 'hidden',
			'display': 'none'
		});
	});
</script>