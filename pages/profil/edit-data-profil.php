<div class="row">
<?php
	if (isset($_GET['id'])) {
	$id = $_GET['id'];
	}
	else {
		die ("Error. No Kode Selected! ");	
	}
	include "../config/koneksi.php";
	$tampilUsr	= mysqli_query($Open,"SELECT * FROM m_profil WHERE id='$id'");
	$hasil	= mysqli_fetch_array ($tampilUsr);
				
	if ($_POST['edit'] == "edit") {
	$nama	=$_POST['nama'];
	$alamat	=$_POST['alamat'];
	$unit	=$_POST['unit'];
	$pengelola	=$_POST['pengelola'];
	$jabatan	=$_POST['jabatan'];
	$path 		= $_FILES['logo']['name'];
	$ext 		= pathinfo($path, PATHINFO_EXTENSION);
	if(empty($ext) || $ext == ""){
		$logo		= $_POST['logo_old'];
	}else{
		$logo		= 'logo.'.$ext;
	}

	$path_unit 		= $_FILES['logo_unit']['name'];
	$ext_unit 		= pathinfo($path_unit, PATHINFO_EXTENSION);
	if(empty($ext_unit) || $ext_unit == ""){
		$logo_unit		= $_POST['logo_unit_old'];
	}else{
		$logo_unit		= 'logo_unit.'.$ext_unit;
	}

	$fav 	= "favicon.ico";
		
		if (empty($_POST['nama']) || empty($_POST['alamat']) || empty($_POST['unit']) || empty($_POST['pengelola']) || empty($_POST['jabatan'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-edit-data-profil&id=$id");
		}
		else{
			$update= mysqli_query ($Open,"UPDATE m_profil SET 
				nama='$nama', 
				alamat='$alamat', 
				logo='$logo', 
				unit='$unit', 
				pengelola='$pengelola', 
				jabatan='$jabatan', 
				logo_unit='$logo_unit'
				WHERE id='$id'");
			if($update){
				$_SESSION['nama_pt']	= $nama;
				$_SESSION['alamat_pt']	= $alamat;
				$_SESSION['unit']		= $unit;
				$_SESSION['pengelola']	= $pengelola;
				$_SESSION['jabatan']	= $jabatan;
				$_SESSION['pesan'] = "Good! Edit profil success ...";
				header("location:index.php?page=form-view-data-profil");
			}
			else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
		if (strlen($logo)>0) {
			if (is_uploaded_file($_FILES['logo']['tmp_name'])) {
				move_uploaded_file ($_FILES['logo']['tmp_name'], "../assets/img/".$logo);
				copy("../assets/img/".$logo, '../'.$fav);
			}
		}
		if (strlen($logo_unit)>0) {
			if (is_uploaded_file($_FILES['logo_unit']['tmp_name'])) {
				move_uploaded_file ($_FILES['logo_unit']['tmp_name'], "../assets/img/".$logo_unit);
			}
		}
	}
?>
</div>