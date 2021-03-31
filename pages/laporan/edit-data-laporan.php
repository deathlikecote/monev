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
	$judul	=$_POST['judul'];
	$header	=$_POST['header'];
	$footer	=$_POST['footer'];
		
		if (empty($_POST['judul']) || empty($_POST['header']) || empty($_POST['footer'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-edit-data-laporan&id=$id");
		}
		else{
			$update= mysqli_query ($Open,"UPDATE m_laporan SET 
				judul='$judul', 
				header='$header', 
				footer='$footer' 
				WHERE id='$id'");
			if($update){
				$_SESSION['judul_lap']	= $judul;
				$_SESSION['head_lap']	= $header;
				$_SESSION['foot_lap']	= $footer;
				$_SESSION['pesan'] = "Good! Edit laporan success ...";
				header("location:index.php?page=form-view-data-laporan");
			}
			else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
?>
</div>