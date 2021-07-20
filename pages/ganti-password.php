<div class="row">
	<?php
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	} else {
		die("Error. No ID Selected! ");
	}
	include "../config/koneksi.php";

	if ($_POST['change'] == "change") {
		$password_lama	= md5($_POST['password_lama']);
		$passtext = $_POST['password_baru'];
		$password_baru	= md5($_POST['password_baru']);
		$confirm_password	= md5($_POST['confirm_password']);

		//cek old password
		$old = mysqli_query($Open, "SELECT * FROM m_user WHERE id='$id' AND password='$password_lama'");
		$cek = mysqli_num_rows($old);

		if (empty($_POST['password_lama']) || empty($_POST['password_baru']) || empty($_POST['confirm_password'])) {
			$_SESSION['pesan'] = "Wajib ISI setiap kolom yang tersedia!";
			header("location:index.php?page=form-ganti-password&id=$id");
		} else if (!$cek >= 1) {
			$_SESSION['pesan'] = "Password salah! ...";
			header("location:index.php?page=form-ganti-password&id=$id");
		} else if (($_POST['password_baru']) != ($_POST['confirm_password'])) {
			$_SESSION['pesan'] = "Oops! Konfirmasi password salah ...";
			header("location:index.php?page=form-ganti-password&id=$id");
		} else {
			$changep = "UPDATE m_user SET passtext='$passtext', password='$password_baru' WHERE id='$id'";
			$query = mysqli_query($Open, $changep);

			if ($query) {
				$_SESSION['pesan'] = "Password berhasil diperbaharui!";
				header("location:./");
			} else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
	?>
</div>