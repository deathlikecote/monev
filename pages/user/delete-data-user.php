<div class="row">
<?php
include "../config/koneksi.php";
if (isset($_GET['id_user'])) {
	$id_user = $_GET['id_user'];
	
	$query   =mysqli_query($Open,"SELECT * FROM m_user WHERE id='$id_user'");
	$data    =mysqli_fetch_array($query);
	}
	else {
		die ("Error. No ID Selected! ");	
	}
	
	if (!empty($id_user) && $id_user != "") {
		if ($data['hak_akses'] =="Admin") {
			$_SESSION['pesan'] = "Oops! You cant delete this $data[hak_akses] ...";
			header("location:index.php?page=form-view-data-user");
		}
		
		else{
			$delete		=mysqli_query($Open,"DELETE FROM m_user WHERE id='$id_user'");
			if($delete){
				unlink("../assets/img/profil/".$data['avatar']."");
				$_SESSION['pesan'] = "Good! Delete user $data[id_user] success ...";
				header("location:index.php?page=form-view-data-user");
			}
			else {
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
		}
	}
	mysqli_close($Open);
?>
</div>