<?php
include "../../include/koneksi.php";
include "header.php";
?>
<script type="text/javascript">
	function validations(){
		var kode = $('#kode').val();
		if(kode == ''){
			alert('Data masih kosong');
			return false;
		}
	}
</script>
<br>
<div class="row">
<form class="form-horizontal" method="post" action="edopreport4-pdf.php" >
<div class="form-group">
    			<label for="kodedosen" style="" class="col-sm-1 control-label">PILIH</label>
    			<div class="col-sm-2">  
					<select name="dkode" id="kode" class="form-control">
						<option value="">Kode</option>

						<?php
							$query = mysqli_query($plm_edom, "SELECT distinct(kodedosen) from edopdata order by kodedosen") or die(mysqli_error());
							while($row = mysqli_fetch_assoc($query)){
								$skode = $row["kodedosen"];
						?>
						<option value="<?php echo $skode ?>" > <?php echo $skode ?> </option>
						<?php
						}
						?>
					</select>
				</div>
    			<div class="col-sm-2">
    				<input type="submit" onclick="return validations()" class="btn btn-success" value="CETAK">
    			</div>
    		</div>
</form>
</div>