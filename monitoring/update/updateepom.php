<?php
include"../../include/koneksi.php";
$sql_edop=mysqli_query($plm_edom, "SELECT a.id_potensi,b.id,b.idprogstudi,b.kelas_id,b.kode FROM epomdata a, epompotensi b where a.idprogstudi='' and b.id=a.id_potensi group by a.id_potensi limit 6");
		while($r_edop=mysqli_fetch_array($sql_edop)){
echo'1';
$sql = mysqli_query($plm_edom, "UPDATE epomdata SET idprogstudi='".$r_edop['idprogstudi']."',kelas_id='".$r_edop['kelas_id']."',kode='".$r_edop['kode']."' WHERE id_potensi='".$r_edop['id_potensi']."' and idprogstudi=''");
if ($sql){
	echo "update edopdata sukses id_potensi = ".$r_edop['id']." <br>";
	echo'<meta http-equiv="refresh" content="0">';
}else{
echo"update edopdata error id_potensi = ".$r_edop['id']." <br>";	
}
		}
?>