<div class="row">
<?php
include "../config/koneksi.php";
	if (isset($_GET['kdsn'])){
		$perta = $_GET['perta']; 
		$kodedosen = $_GET['kdsn'];
	}else {
		die ("Error. No kodedosen Selected! ");	
	}
	
	if (!empty($kodedosen) && $kodedosen != "") {

		$tampil	= mysqli_query($Open,"SELECT id FROM exoxpotensi WHERE ta = '$perta' AND kodedosen ='$kodedosen'");
		while($r = mysqli_fetch_array ($tampil)){
			mysqli_query($Open,"DELETE FROM epoddata WHERE id_potensi = '".$r['id']."'");
			mysqli_query($Open,"DELETE FROM edopdata WHERE id_potensi = '".$r['id']."'");
		}

		$delete = mysqli_query($Open,"DELETE FROM exoxpotensi WHERE ta = '$perta' AND kodedosen ='$kodedosen'");

		if($delete){
			
			$_SESSION['pesan'] = "Good! Data berhasil dihapus ...";
			header("location:index.php?page=form-view-generate-epod");
		
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}else{
		echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
	}
	mysqli_close($Open);
?>
</div>