<div class="row">
<?php	
	if ($_POST['save'] == "save") {
	$nama_user	=$_POST['nama_user'];
	$nama	=$_POST['nama'];
	$passtext	=$_POST['password'];
	$password	=md5($_POST['password']);
	$hak_akses	=$_POST['hak_akses'];
	$path 		= $_FILES['avatar']['name'];
	$ext 		= pathinfo($path, PATHINFO_EXTENSION);
	if(empty($ext) || $ext == ""){
		$avatar		= "";
	}else{
		$avatar		= $nama_user.'.'.$ext;
	}
	
	include "../config/koneksi.php";
	$cekuser	=mysqli_num_rows (mysqli_query($Open,"SELECT nama_user FROM m_user WHERE nama_user='$_POST[nama_user]'"));
	
		if (empty($_POST['nama_user']) || empty($_POST['nama']) || empty($_POST['password']) || empty($_POST['hak_akses'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-master-data-user");
		}
		else if($cekuser > 0) {
		$_SESSION['pesan'] = "Oops! Username not Available ...";
			header("location:index.php?page=form-master-data-user");
		}
		
		else{
		$insert = "INSERT INTO m_user (nama_user, nama, passtext, password, hak_akses, avatar, status) VALUES ('$nama_user', '$nama', '$passtext', '$password', '$hak_akses', '$avatar', '1')";
		$query = mysqli_query ($Open,$insert);
		
		if($query){
			$_SESSION['pesan'] = "Good! Insert User success ...";
			header("location:index.php?page=form-view-data-user");
		}
			else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
		if (strlen($avatar)>0) {
			if (is_uploaded_file($_FILES['avatar']['tmp_name'])) {
				move_uploaded_file ($_FILES['avatar']['tmp_name'], "../assets/img/profil/".$avatar);
			}
		}
	}
?>
</div>