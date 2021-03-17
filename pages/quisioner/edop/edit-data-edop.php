<div class="row">
<?php
	if (isset($_GET['id'])) {
	$id = $_GET['id'];
	}
	else {
		die ("Error. No Kode Selected! ");	
	}
	include "../config/koneksi.php";
				
	if ($_POST['edit'] == "edit") {
	$nourut 	= $_POST['nourut'];
	$aspek 		= $_POST['aspek'];
	$parameter 	= $_POST['parameter'];
	$jenis 		= $_POST['jenis'];	

		$update= mysqli_query ($Open,"UPDATE edopparameter SET 
			nourut = '$nourut', 
			aspek = '$aspek',  
			parameter = '$parameter', 
			jenis = '$jenis' 
			WHERE id = '$id'");
		if($update){
			$_SESSION['pesan'] = "Good! Data berhasil diperbaharui ...";
			header("location:index.php?page=form-view-data-edop");
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
		
?>
</div>