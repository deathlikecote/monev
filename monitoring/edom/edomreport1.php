<?php
include "../../include/koneksi.php";
include "header.php";
?>

<br>
<div class="row">
<form class="form-horizontal" method="post" action="edomreport1-pdf.php" > 
	<div class="form-group">
    			<label for="kodedosen" style="" class="col-sm-1 control-label">PILIH</label>
    			<div class="col-sm-6">
    				<select name="kode" class="form-control select2" searchable="">
    					<option value="">Kode</option>
    					<option value="">Kode</option>
    					<option value="">Kode</option>
						<?php

							$query = mysqli_query($plm_edom, "SELECT *,concat(kodedosen,kodemk,idprogstudi,kelas) as kodex FROM edompotensi where ta = '".$_SESSION['pertan']."' and spote != 0 group by kodedosen,kodemk,idprogstudi,kelas order by concat(idprogstudi,kelas) asc") or die(mysqli_error());
							while($row = mysqli_fetch_assoc($query)){
								$skode = $row["kodex"];
						?>
						<option value="<?php echo $skode ?>" > <?php echo $row['namadosen']." | ".$row['namamk']." | ".$row['idprogstudi']." ".$row['kelas']   ?> </option>
						<?php
						}
						?>
					</select>
					
    			</div>
    			<div class="col-sm-2">
    				<input type="submit" class="btn btn-success" value="CETAK">
    			</div>
    		</div>
</form>
</div>
