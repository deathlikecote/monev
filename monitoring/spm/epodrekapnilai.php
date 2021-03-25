
<?php
// definisi nama database dan tabel 
include "../../include/koneksi.php";
include "header.php";
$hasil=mysqli_query($plm_edom, "select idprogstudi, avg(spote_p) as rata2 from exoxpotensi where spote_p > 0 group by idprogstudi" ) or die("error:".mysql_error());
$nou=0;
$isi=0;
?>
	<br/>

<table id="example1" style="font-size:9pt" class="table table-bordered table-striped">
	<thead>
		<tr>
		  <td align=center>NO</td>
		  <td align=center>PRODI</td>
		  <td align=center>SCORE RATA2</td>
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
  <?php echo strtoupper($data['idprogstudi']) ?></span>
</td>

<td align=center> 
  <?php echo number_format($data['rata2'],2,'.',',') ?></span>
</td>
</tr>
<?php
}
?>

</tbody>
<tfoot>
		<tr>
		<td align=center>NO</td>
		  <td align=center>PRODI</td>
		  <td align=center>SCORE RATA2</td>
		</tr>
	</tfoot>
	
</table>
<?php include "footer.php"; ?>