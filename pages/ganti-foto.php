<div class="row">
	<?php
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	} else {
		die("Error. No ID Selected! ");
	}
	include "../config/koneksi.php";

	if ($_POST['change'] == "change") {
		$nama_user	= $_SESSION['id_user'];
		$path 		= $_FILES['avatar']['name'];
		$ext 		= pathinfo($path, PATHINFO_EXTENSION);
		if (empty($ext) || $ext == "") {
			$avatar		= $_POST['avatar_old'];
		} else {
			$avatar		= $nama_user . '.' . $ext;
		}

		//cek old password
		$old = mysqli_query($Open, "SELECT * FROM m_user WHERE id='$id' AND password='$password_lama'");
		$cek = mysqli_num_rows($old);

		if (empty($_FILES['avatar']['name'])) {
			$_SESSION['pesan'] = "Oops! Pilih foto terlebih dahulu ...";
			header("location:index.php?page=form-fanti-foto&id=$id");
		} else {
			$changep = "UPDATE m_user SET avatar='$avatar' WHERE id='$id'";
			$query = mysqli_query($Open, $changep);

			if ($query) {
				if (strlen($avatar) > 0) {
					if (is_uploaded_file($_FILES['avatar']['tmp_name'])) {
						move_uploaded_file($_FILES['avatar']['tmp_name'], "../assets/img/profil/" . $avatar);
					}
				}
				$_SESSION['pesan'] = "Foto berhasil diperbaharui!";
				header("location:./");
			} else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
	?>
</div>