<div class="row">
<?php
include "../config/koneksi.php";
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if (!empty($id) && $id != "") {
		$delete		=mysqli_query($Open,"DELETE FROM m_timdosen WHERE id='$id'");
		if($delete){
			$_SESSION['pesan'] = "Good! Data berhasil dihapus ...";
			header("location:index.php?page=form-view-data-timdosen");
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	mysqli_close($Open);
?>
</div>