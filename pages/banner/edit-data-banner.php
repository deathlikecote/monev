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
	$judul		= $_POST['judul'];
	$status		= $_POST['status'];
	$path 		= $_FILES['avatar']['name'];
	$ext 		= pathinfo($path, PATHINFO_EXTENSION);
	$avatarOld 	= explode('.', $_POST['avatar_old']);
	if(empty($ext) || $ext == ""){
		$avatar		= $_POST['avatar_old'];
	}else{
		$avatar		= $avatarOld[0].'.'.$ext;
	}
		unlink("../assets/img/banner/".$_POST['avatar_old']."");	
		if (empty($_POST['judul'])) {
			$_SESSION['pesan'] = "Oops! Isi kolom mandatori ...";
			header("location:index.php?page=form-edit-data-banner&id=$id_user");
		}
		else{
			
			$update= mysqli_query ($Open,"UPDATE m_banner SET judul='$judul', nama='$avatar', status='$status' WHERE id='$id'");
			if($update){
				$_SESSION['pesan'] = "Good! Data berhasil diperbaharui ...";
				header("location:index.php?page=form-view-data-banner");
			}
			else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
		if (strlen($avatar)>0) {
			if (is_uploaded_file($_FILES['avatar']['tmp_name'])) {
				move_uploaded_file ($_FILES['avatar']['tmp_name'], "../assets/img/banner/".$avatar);
			}
		}
	}
?>
</div>