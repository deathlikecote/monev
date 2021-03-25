
<?php
// definisi nama database dan tabel 
include "../../include/koneksi.php";
include "header.php";
$hasil=mysqli_query($plm_edom, "select * from epompotensi group by kode order by idprogstudi,kelas_id");
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
		  <td align=center>POTENSI</td>
		  <td align=center>PENGISIAN</td>
		  <td align=center>BELUM MENGISI</td>
		</tr>
	</thead>
	<tbody>
		
<?php while($data=mysqli_fetch_array($hasil)) { ?>
<?php $nou=$nou+1 ?>
<?php
$hasil2=mysqli_query($plm_edom, "select * from epompotensi where kode='".$data['kode']."'");
$row=mysqli_num_rows($hasil2);
$hasil3=mysqli_query($plm_edom, "select * from epompotensi where kode='".$data['kode']."' and done=1");
$row3=mysqli_num_rows($hasil3);
$hasil4=mysqli_query($plm_edom, "select * from epompotensi where kode='".$data['kode']."' and done=''");
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
  <?php echo $data['kelas_id'] ?></span>
</td>
<td align=center> 
  <?php echo $row ?></span>
</td>
<td align=center> 
  <?php echo $row3 ?></span>
</td>
<td align=center> 
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
		  <td align=center>POTENSI</td>
		  <td align=center>PENGISIAN</td>
		  <td align=center>BELUM MENGISI</td>
		</tr>
	</tfoot>
	
</table>
<?php include "footer.php"; ?>