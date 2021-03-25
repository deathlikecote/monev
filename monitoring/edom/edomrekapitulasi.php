<?php
// definisi nama database dan tabel 
include "../../config/koneksi.php";
include "header.php";
$hasil=mysqli_query($plm_edom, "select * from edompotensi group by kode order by idprogstudi,kelas") or die("error:".mysqli_error());
$nou=0;
$isi=0;
?>
	
	<br/>

<table id="example1" style="font-size:9pt" class="table table-bordered table-striped">
	<thead>
		<tr>
		  <td align=center>NO</td>
		  <td align=center>PRODI</td>
		  <td align=center>KELAS</td>
		  <td align=center>KMK</td>
		  <td align=center>KODE DOSEN</td>
		  <td align=center>POTENSI</td>
		  <td align=center>PENGISIAN</td>
		  <td align=center>BELUM MENGISI</td>
		</tr>
	</thead>
	<tbody>
		
<?php while($data=mysqli_fetch_array($hasil)) { ?>
<?php $nou=$nou+1 ?>
<?php
$hasil2=mysqli_query($plm_edom, "select * from edompotensi where kode='".$data['kode']."'") or die("error:".mysql_error());
$row=mysqli_num_rows($hasil2);
$hasil3=mysqli_query($plm_edom, "select * from edompotensi where kode='".$data['kode']."' and done=1") or die("error:".mysql_error());
$row3=mysqli_num_rows($hasil3);
$hasil4=mysqli_query($plm_edom, "select * from edompotensi where kode='".$data['kode']."' and done=''") or die("error:".mysql_error());
$row4=mysqli_num_rows($hasil4);
?>
<tr >
<td align=left>  
  <?php echo $nou ?></span>
</td>
<td align=center> 
  <?php echo $data['idprogstudi'] ?></span>
</td>
<td align=center> 
  <?php echo $data['kelas'] ?></span>
</td>
<td align=center> 
  <?php echo strtoupper($data['kodemk']) ?></span>
</td>
<td align=center> 
  <?php echo strtoupper($data['kodedosen']) ?></span>
</td>

<td align=left> 
  <?php echo $row ?></span>
</td>
<td align=left> 
  <?php echo $row3 ?></span>
</td>
<td align=left> 
  <?php echo $row4 ?></span>
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
		  <td align=center>KELAS</td>
		  <td align=center>KMK</td>
		  <td align=center>KODE DOSEN</td>
		  <td align=center>POTENSI</td>
		  <td align=center>PENGISIAN</td>
		  <td align=center>BELUM MENGISI</td>
		</tr>
	</tfoot>
	
</table>
<?php include "footer.php"; ?>