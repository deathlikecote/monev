
<?php
// definisi nama database dan tabel 
include "./../../include/koneksi.php";
include "header.php";
$hasil=mysqli_query($plm_edom, "select idprogstudi, kodedosen, kodemk, namadosen, namamk, komentar_d, spote_d from exoxpotensi order by kodedosen" ) or die("error:".mysqli_error());
$nou=0;
$isi=0;
?>

	<br/>
<table id="example1" style="font-size:9pt" class="table table-bordered table-striped">
	<thead>
		<tr>
		  <td align=center>NO</td>
		  <td align=center>PENILAI (PRODI)</td>
		  <td align=center>YANG DINILAI</td>
		  <td align=center>MATAKULIAH</td>
		  <td align=center>NILAI</td>
		  <td align=center>KOMENTAR</td>
		</tr>
	</thead>
	<tbody>
		
<?php while($data=mysqli_fetch_array($hasil)) { ?>
<?php $nou=$nou+1 ?>
<tr class="first">
<td align=left>  
  <?php echo $nou ?></span>
</td>
<td align=center> 
  <?php echo strtoupper($data['idprogstudi']) ?></span>
</td>
<td align=center> 
  <?php echo strtoupper($data['kodedosen']) ?></span>
</td>
<td align=center> 
  <?php echo strtoupper($data['kodemk']) ?></span>
</td>
<td align=center> 
  <?php echo number_format($data['spote_d'],2,'.',',') ?></span>
</td>
<td align=left> 
  <?php echo $data['komentar_d'] ?></span>
</td>

</tr>
<?php
}
?>

</tbody>
<tfoot>
		<tr>
		<td align=center>NO</td>
		  <td align=center>PENILAI (PRODI)</td>
		  <td align=center>YANG DINILAI</td>
		  <td align=center>MATAKULIAH</td>
		  <td align=center>NILAI</td>
		  <td align=center>KOMENTAR</td>
		</tr>
	</tfoot>
	
</table>
<?php include "footer.php"; ?>