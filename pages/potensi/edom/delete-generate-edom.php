<div class="row">
<?php
include "../config/koneksi.php";
if (isset($_GET['nim'])){
	$perta = $_GET['perta']; 
	$nim = $_GET['nim'];
	}
	else {
		die ("Error. No nim Selected! ");	
	}
	
	if (!empty($nim) && $nim != "") {
		$tampil	= mysqli_query($Open,"SELECT id FROM edompotensi WHERE ta = '$perta' AND nim ='$nim'");
		while($r	= mysqli_fetch_array ($tampil)){
			$delete = mysqli_query($Open,"DELETE FROM edomdata WHERE id_potensi = '".$r['id']."'");
		}

		$delete = mysqli_query($Open,"DELETE FROM edompotensi WHERE ta = '$perta' AND nim ='$nim'");

		$tampil	= mysqli_query($Open,"SELECT id FROM epompotensi WHERE ta = '$perta' AND nim ='$nim'");
		while($r	= mysqli_fetch_array ($tampil)){
			$delete = mysqli_query($Open,"DELETE FROM epomdata WHERE id_potensi = '".$r['id']."'");
		}

		$delete = mysqli_query($Open,"DELETE FROM epompotensi WHERE ta = '$perta' AND nim ='$nim'");
		if($delete){
			
			$_SESSION['pesan'] = "Good! Data berhasil dihapus ...";
			header("location:index.php?page=form-view-generate-edom");
		
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
	mysqli_close($Open);
?>
</div>