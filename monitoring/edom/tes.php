<?PHP

include("dbspmconn.php");

//-edomtemp01
mysql_query("TRUNCATE TABLE edomtemp00");

$qry00=mysql_query("select kode from edompotensi where id<100 group by kode") or die("error as:".mysql_error());
while ($list00=mysql_fetch_array($qry00)) {
$kodepot=$list00['kode'];
$qry01=mysql_query("select kode, id_parameter, parameter, aspek, sum(v1) as jumlah from edomdata where kode='$kodepot' group by kode,id_parameter") or die("error as:".mysql_error());
while ($list=mysql_fetch_array($qry01)) {
	$vkode=$list['kode'];
	$vid=$list['id_parameter'];
	$vpar=$list['parameter'];
	$vaspek=$list['aspek'];
	$vjml=$list['jumlah'];
	mysql_query("INSERT INTO edomtemp00 (kode,id_parameter,parameter,aspek,jumlah) VALUES ('$vkode', '$vid', '$vpar', '$vaspek', '$vjml')") or die("error insert:".mysql_error());
}

}
?>