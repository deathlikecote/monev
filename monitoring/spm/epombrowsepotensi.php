
<?php
// definisi nama database dan tabel 
include "../../include/koneksi.php";
include "header.php";
$hasil=mysqli_query($plm_edom, "select nim,kelas_id,idprogstudi,komentar,spote,done from epompotensi") or die("error:".mysql_error());
$hasil2=mysqli_query($plm_edom, "select distinct nim from edompotensi") or die("error:".mysql_error());
$row=mysqli_num_rows($hasil2);
$hasil3=mysqli_query($plm_edom, "select * from edompotensi where done=1 group by nim") or die("error:".mysql_error());
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
		  <td align=center>KELAS</td>
		  <td align=center>PRODI</td>
		  <td align=center>KOMENTAR</td>
		  <td align=center>NILAI</td>
		  <td align=center>STATUS</td>
		</tr>
	</thead>
	<tbody>
			
					<?php while($data=mysqli_fetch_array($hasil)) { 
						$nou=$nou+1
					?>
						<tr >
					<td align=left>  
					  <?php echo $nou ?></span>
					</td>

					<td align=center> 
					  <?php echo $data['nim'] ?></span>
					</td>

					<td align=center> 
					  <?php echo strtoupper($data['kelas_id']) ?></span>
					</td>

					<td align=center> 
					  <?php echo strtoupper($data['idprogstudi']) ?></span>
					</td>

					<td align=left> 
					  <?php echo strtoupper($data['komentar']) ?></span>
					</td>

					<td align=left> 
					  <?php echo number_format($data['spote'],2) ?></span>
					</td>

					<td align=center> 
					<?php if ($data['done']>0) { ?>
					 	<span class="style20"><?php echo "-ok-" ?></span>
					<?php 
						$isi=$isi+1 ;
						}
					?>
					</td>

				</tr>
				<?php } ?>
			</tbody>
			<tfoot>
				<tr>
				  <td align=center>NO</td>
				  <td align=center>NIM</td>
				  <td align=center>KELAS</td>
				  <td align=center>PRODI</td>
				  <td align=center>KOMENTAR</td>
				  <td align=center>NILAI</td>
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
	