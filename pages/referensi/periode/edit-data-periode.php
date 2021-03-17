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
	$perta 		= $_POST['perta'];
	$periode 	= $_POST['periode'];
	$utsuas 	= $_POST['utsuas'];
	$tglawal 	= $_POST['tglawal'];
	$tglakhir 	= $_POST['tglakhir'];	

		$update= mysqli_query ($Open,"UPDATE m_periode SET 
			perta = '$perta', 
			periode = '$periode',  
			utsuas = '$utsuas',  
			tglawal = '$tglawal', 
			tglakhir = '$tglakhir' 
			WHERE id = '$id'");
		if($update){
			$_SESSION['perta'] = $perta; 
			$_SESSION['perteks']	= $periode;
			$_SESSION['utsuas']	= $utsuas;
			$_SESSION['pesan'] = "Good! Data berhasil diperbaharui ...";
			header("location:index.php?page=form-view-data-periode");
		}
		else {
			echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
		}
	}
		
?>
</div>