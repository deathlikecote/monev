<?php
include "./../include/koneksi.php";
if($_SESSION['jabatan']!="operator"){
header('Location: ./../');
}
// Fungsi header dengan mengirimkan raw data excel
header("Content-type: application/vnd-ms-excel");
 
// Mendefinisikan nama file ekspor "hasil-export.xls"
header("Content-Disposition: attachment; filename=EPOD-Report.xls");
 $perta = $_GET['perta']; 			
?>
<h2 style="margin:0px;">REKAPITULASI EPOD</h2> <h3 style="margin:0px;"><?php echo $perta; ?></h3>
<br>
<table border="1">
<tr>
<thead>
<td>No</td>
<td>Kode Prodi</td>
<td>Nama</td>
<td>Jurusan</td>
<td>A</td>
<td>B</td>
<td>C</td>
<td>NA</td>
</thead>
</tr>


<?php
$a=0;
$No=1;
$sql=mysqli_query($plm_edom,'select * from epoddata_es where ta = "'.$perta.'" order by namaprodi,total asc');
while($r=mysqli_fetch_array($sql)){



$nprodi=strtoupper($r['namaprodi']);



echo"<tr >
<td>".$No."</td>
<td>".$r['idprogstudi']."</td>
<td>".$r['namaprodi']."</td>
<td>".$r['jurprodi']."</td>
<td>".number_format($r['A'],2)."</td>
<td>".number_format($r['B'],2)."</td>
<td>".number_format($r['C'],2)."</td>
<td>".number_format($r['total'],2)."</td>
</tr>

";
$No=$No+1;
}
?>
<tbody>
</tr>
</table>

