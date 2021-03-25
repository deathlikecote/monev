
<?php
// definisi nama database dan tabel 
include "../../config/koneksi.php";
include "header.php";
$hasil=mysqli_query($Open, "SELECT nim,kodemk,kodedosen,kelas,idprogstudi,done FROM edompotensi");
$hasil2=mysqli_query($Open, "SELECT DISTINCT nim FROM edompotensi");
$row=mysqli_num_rows($hasil2);
$hasil3=mysqli_query($Open, "SELECT * FROM edompotensi WHERE done=1 GROUP BY nim");
$row2=mysqli_num_rows($hasil3);
$nou=0;
$isi=0;
?>
<br>
	<table id="example1" style="font-size:9pt" class="table table-bordered table-striped">
	<thead>
		<tr>
		  <td align=center>NO</td>
		  <td align=center>NIM</td>
		  <td align=center>KMK</td>
		  <td align=center>K.DOSEN</td>
		  <td align=center>KELAS</td>
		  <td align=center>PRODI</td>
		  <td align=center>STATUS</td>
		</tr>
	</thead>
	<tbody>
<?php while($data=mysqli_fetch_array($hasil)) { ?>
<?php $nou=$nou+1 ?>
<tr>
<td align=left>  
  <?php echo $nou ?></span>
</td>
<td align=center> 
  <?php echo $data['nim'] ?></span>
</td>
<td align=center> 
  <?php echo strtoupper($data['kodemk']) ?></span>
</td>
<td align=center> 
  <?php echo strtoupper($data['kodedosen']) ?></span>
</td>
<td align=center> 
  <?php echo strtoupper($data['kelas']) ?></span>
</td>
<td align=center> 
  <?php echo strtoupper($data['idprogstudi']) ?></span>
</td>
<td align=center> 
<?php if ($data['done']>0) { ?>
 <span class="style20"><?php echo "-ok-" ?></span>
<?php $isi=$isi+1 ?>
<?php
}
?>
</td>
</tr>
<?php 
}
?>
</tbody>
<tfoot>
		<tr>
		<td align=center>NO</td>
		  <td align=center>NIM</td>
		  <td align=center>KMK</td>
		  <td align=center>K.DOSEN</td>
		  <td align=center>KELAS</td>
		  <td align=center>PRODI</td>
		  <td align=center>STATUS</td>
		</tr>
	</tfoot>
	
</table>

<span class="tablescroll">Jumlah Pengisian :</span>
	<br/>
<span class="tablescroll">+ Potensi : <?php echo number_format($nou,0,'.',',') ?></span>
	<br/>
<span class="tablescroll">+ Pengisian : <?php echo number_format($isi,0,'.',',') ?></span>
	<br/>
	<?php include "footer.php"; ?>