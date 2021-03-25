
<?php
// definisi nama database dan tabel 
include "../../include/koneksi.php";
include "header.php";
$hasil=mysqli_query($plm_edom, "select idprogstudi, kodedosen, kodemk, namadosen, namamk, komentar_p, spote_p from exoxpotensi where spote_p > 0 order by idprogstudi" ) or die("error:".mysql_error());
$nou=0;
$isi=0;
?>
	<br/>

	<table id="example1" style="font-size:9pt" class="table table-bordered table-striped">
	<thead>
		<tr>
		  <td align=center>NO</td>
		  <td align=center>PENILAI</td>
		  <td align=center>YANG DINILAI</td>
		  <td align=center>NILAI</td>
		  <td align=center>KOMENTAR</td>
		</tr>
	</thead>
	<tbody>
		
<?php while($data=mysqli_fetch_array($hasil)) { ?>
<?php $nou=$nou+1 ?>
<tr >
<td align=left>  
  <?php echo $nou ?></span>
</td>
<td align=center> 
  <?php echo strtolower($data['kodedosen']) ?></span>
</td>
<td align=left> 
  <?php echo $data['idprogstudi'] ?></span>
</td>
<td align=center> 
  <?php echo number_format($data['spote_p'],2,'.',',') ?></span>
</td>
<td align=left> 
  <?php echo $data['komentar_p'] ?></span>
</td>

</tr>
<?php
}
?>

</tbody>
<tfoot>
		<tr>
		<td align=center>NO</td>
		  <td align=center>PENILAI</td>
		  <td align=center>YANG DINILAI</td>
		  <td align=center>NILAI</td>
		  <td align=center>KOMENTAR</td>
		</tr>
	</tfoot>
	
</table>
<?php include "footer.php"; ?>