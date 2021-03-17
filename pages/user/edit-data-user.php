<div class="row">
<?php
	if (isset($_GET['id'])) {
	$id_user = $_GET['id'];
	}
	else {
		die ("Error. No Kode Selected! ");	
	}
	include "../config/koneksi.php";
	$tampilUsr	= mysqli_query($Open,"SELECT * FROM m_user WHERE id='$id_user'");
	$hasil	= mysqli_fetch_array ($tampilUsr);
				
	if ($_POST['edit'] == "edit") {
	$nama_user	=$_POST['nama_user'];
	$nama_user_old	=$_POST['nama_user_old'];
	$nama	=$_POST['nama'];
	$passtext	=$_POST['password'];
	$password	=md5($_POST['password']);
	$hak_akses	=$_POST['hak_akses'];
	$path 		= $_FILES['avatar']['name'];
	$ext 		= pathinfo($path, PATHINFO_EXTENSION);
	if(empty($ext) || $ext == ""){
		$avatar		= $_POST['avatar_old'];
	}else{
		$avatar		= $nama_user.'.'.$ext;
	}
		
		if (empty($_POST['nama_user']) || empty($_POST['password']) || empty($_POST['hak_akses'])) {
			$_SESSION['pesan'] = "Oops! Please fill all column ...";
			header("location:index.php?page=form-edit-data-user&id_user=$id_user");
		}
		else{

			if($nama_user == $nama_user_old){
				$update= mysqli_query ($Open,"UPDATE m_user SET nama_user='$nama_user', nama='$nama', passtext='$passtext', password='$password', hak_akses='$hak_akses', avatar='$avatar', status='1' WHERE id='$id_user'");
					if($update){
						$_SESSION['pesan'] = "Good! Edit user $nama_user success ...";
						header("location:index.php?page=form-view-data-user");
					}
					else {
						echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
					}
			}else{
				$cekuser	=mysqli_num_rows (mysqli_query($Open,"SELECT nama_user FROM m_user WHERE nama_user='$_POST[nama_user]'"));
				 if($cekuser > 0) {
						$_SESSION['pesan'] = "Oops! Username not Available ...";
							header("location:index.php?page=form-master-data-user");
				 }else{
					$update= mysqli_query ($Open,"UPDATE m_user SET nama_user='$nama_user', nama='$nama', passtext='$passtext', password='$password', hak_akses='$hak_akses', avatar='$avatar', status='1' WHERE id='$id_user'");
					if($update){
						$_SESSION['pesan'] = "Good! Edit user $nama_user success ...";
						header("location:index.php?page=form-view-data-user");
					}
					else {
						echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
					}
				}
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