<div class="row">
<?php
include "../config/koneksi.php";
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$query   =mysqli_query($Open,"SELECT * FROM m_banner WHERE id='$id'");
	$data    =mysqli_fetch_array($query);
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if (!empty($id) && $id != "") {
		$delete		=mysqli_query($Open,"DELETE FROM m_banner WHERE id='$id'");
		if($delete){
			unlink("../assets/img/banner/".$data['nama']."");
			$_SESSION['pesan'] = "Good! Data berhasil dihapus ...";
			header("location:index.php?page=form-view-data-banner");
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	mysqli_close($Open);
?>
</div>