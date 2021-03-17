<div class="row">
<?php
include "../config/koneksi.php";
if (isset($_GET['perta'])) {
		$perta = $_GET['perta'];
	}
	else {
		die ("404 Error Server");	
	}
	
	if ($perta != '' or !empty($perta)) {

		$delete		=mysqli_query($Open,"DELETE FROM t_penugasan WHERE perta='$perta'");
		if($delete){
			
			$_SESSION['pesan'] = "Good! Data berhasil dihapus ...";
			header("location:index.php?page=form-view-data-penugasan");
		
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	mysqli_close($Open);
?>
</div>