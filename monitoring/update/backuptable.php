<?php
include "./../../include/koneksi.php";

function buattable($tabelbaru, $tabellama){
	$sql = "CREATE TABLE ".$tabelbaru." select * from ".$tabellama."";
	return $sql;
}

$status 	= '';
$result 	= '';
$tab1 		= "edomdata".$_SESSION['pertan'];
$tab2	 	= "edompotensi".$_SESSION['pertan'];
$tab3 		= "epomdata".$_SESSION['pertan'];
$tab4 		= "epompotensi".$_SESSION['pertan'];
$tab5 		= "edopdata".$_SESSION['pertan'];
$tab6 		= "epoddata".$_SESSION['pertan'];
$tab7 		= "exoxpotensi".$_SESSION['pertan'];

$ortab1		= "edomdata";
$ortab2		= "edompotensi";
$ortab3		= "epomdata";
$ortab4		= "epompotensi";
$ortab5		= "edopdata";
$ortab6		= "epoddata";
$ortab7		= "exoxpotensi";

for ($i=1;$i<8;$i++){
	$tabel 	= "tab".$i;
	$ori 	= "ortab".$i;
	$result = mysqli_query($plm_edom, "SHOW TABLES LIKE '".$$tabel."'");

	if (mysqli_num_rows($result) == 1) {
		mysqli_query($plm_edom, "DROP table ".$$tabel."");

		$sql = buattable($$tabel, $$ori);	
		if (mysqli_query($plm_edom, $sql)) {
			$status .= "Table <b>".$$tabel."</b> <b style='color:green'>Berhasil</b> di backup<br>";	
		} else {
			$status .= "Table <b>".$$tabel."</b> <b style='color:red'>Gagal</b> di backup<br>";
		}

	}else {

		$sql = buattable($$tabel, $$ori);	
		if (mysqli_query($plm_edom, $sql)) {
			$status .= "Table <b>".$$tabel."</b> <b style='color:green'>Berhasil</b> di backup<br>";	
		} else {
			$status .= "Table <b>".$$tabel."</b> <b style='color:red'>Gagal</b> di backup<br>";
		}
	}

}


echo $status;

?>