<div class="row">
<?php
	
	include "../config/koneksi.php";
				
	if ($_POST['edit'] == "edit") {
	$perta 		= $_POST['perta'];
	$cPerta = mysqli_query($Open, "SELECT TABLE_NAME AS cPerta FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".$DB."' AND TABLE_NAME = 'edomparameter".$perta."'");
	$row = mysqli_num_rows($cPerta);
	if($row > 0){
		$_SESSION['pesan'] = "Oops! Perta tersebut sudah dilakukan ...";
		header("location:index.php?page=form-view-data-periode");
	}else{
		$update= mysqli_query ($Open,"UPDATE m_periode SET 
			perta = '$perta'");
		if($update){
			$_SESSION['perta'] = $perta; 
			$_SESSION['pesan'] = "Good! Data berhasil diperbaharui ...";
			header("location:index.php?page=form-view-data-periode");
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
}
		
?>
</div>