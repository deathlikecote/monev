<?php
include "./../include/koneksi.php";
if($_SESSION['jabatan']!="operator"){
header('Location: ./../');
}
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=EDOM-Report.xls");

$perta = $_GET['perta']; 
?>
<style type="text/css">
	.num {
	  mso-number-format:General;
	}
</style>
<h2 style="margin:0px;">REKAPITULASI EDOM</h2> <h3 style="margin:0px;"><?php echo $perta; ?></h3>
<br>
<table border="1">
<tr>
<thead>
<td>No</td>
<td>Kode Dosen</td>
<td>Nama</td>
<td>MK</td>
<td>PRODI</td>
<td>KLS</td>
<td>A</td>
<td>B</td>
<td>C</td>
<td>D</td>
<td>NA</td>
</thead>
</tr>


<?php
$a=0;
$No=1;
$sql=mysqli_query($plm_edom,'select * from edomdata_es where ta = "'.$perta.'" order by namadosen,kodemk,kelas asc');
while($r=mysqli_fetch_array($sql)){


$kdosen=strtoupper($r['kodedosen']);

echo"<tr >
<td >$No</td>
<td >".$kdosen."</td>
<td >".strtoupper($r['namadosen'])."</td>
<td >".$r['kodemk']."</td>
<td >".$r['idprogstudi']."</td>
<td >".(string)$r['kelas']."</td>
<td class='' >".number_format($r['A'],2)."</td>
<td class='' >".number_format($r['B'],2)."</td>
<td class='' >".number_format($r['C'],2)."</td>
<td class='' >".number_format($r['D'],2)."</td>
<td class='' >".number_format($r['total'],2)."</td>
</tr>

";
$No=$No+1;
}
?>
<tbody>
</tr>
</table>

