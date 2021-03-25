
<?php
// definisi nama database dan tabel 
include "./../../include/koneksi.php";
include "header.php";
$hasil=mysqli_query($plm_edom, "select exoxpotensi.kodedosen, exoxpotensi.idprogstudi, count(exoxpotensi.kodedosen) as potensi,  count(epoddata.id_potensi)/10 as diisi from exoxpotensi left join epoddata on exoxpotensi.id = epoddata.id_potensi group by exoxpotensi.kodedosen,exoxpotensi.idprogstudi" ) or die("error:".mysqli_error());
$hasil2=mysqli_query($plm_edom, "select kodedosen from exoxpotensi");
$nou=0;
$isi=0;
?>
	
	<br/>

	<table id="example1" style="font-size:9pt" class="table table-bordered table-striped">
	<thead>
		<tr>
		  <td align=center>NO</td>
		  <td align=center>DOSEN</td>
		  <td align=center>PRODI</td>
		  <td align=center>PENGISIAN</td>
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
  <?php echo $data['kodedosen'] ?></span>
</td>
<td align=center> 
  <?php echo strtoupper($data['idprogstudi']) ?></span>
</td>
<td align=center> 
<?php if ($data['diisi']>0) { ?>
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
		  <td align=center>DOSEN</td>
		  <td align=center>PRODI</td>
		  <td align=center>PENGISIAN</td>
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