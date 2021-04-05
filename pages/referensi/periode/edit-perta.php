<div class="row">
<?php
	
	include "../config/koneksi.php";
				
	if ($_POST['edit'] == "edit") {
	$perta 		= $_POST['perta'];

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
		
?>
</div>