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
		$cari=mysqli_query($Open,"SELECT * FROM t_kelas WHERE id='$id'") ;
	    $datas=mysqli_fetch_assoc($cari);

		$delete		=mysqli_query($Open,"DELETE FROM t_kelas WHERE id='$id'");
		if($delete){
			$delete		=mysqli_query($Open,"DELETE FROM m_user WHERE nama_user='".$datas['nim']."'");
			if($delete){
				$_SESSION['pesan'] = "Good! Data berhasil dihapus ...";
				header("location:index.php?page=form-view-data-kelas");
			}
			else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
			
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	mysqli_close($Open);
?>
</div>