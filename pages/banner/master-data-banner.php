<div class="row">
<?php	
	if ($_POST['save'] == "save") {
		$judul		= $_POST['judul'];
		$status		= $_POST['status'];

		include "../config/koneksi.php";
		$qry = mysqli_query($Open,"SELECT MAX(id) AS maxID FROM m_banner");
		$row = mysqli_fetch_array($qry);
		$imgName 	= $row['maxID'] + 1;

		$path 		= $_FILES['avatar']['name'];
		$ext 		= pathinfo($path, PATHINFO_EXTENSION);
		$avatar		= $imgName.'.'.$ext;
		
		if (empty($_FILES['avatar']['name'])) {
			$_SESSION['pesan'] = "Oops! Pilih banner terlebih dahulu ...";
			header("location:index.php?page=form-master-data-banner");
		}
		else{
		$insert = "INSERT INTO m_banner (judul, nama, status) VALUES ('$judul', '$avatar', '$status')";
		$query = mysqli_query ($Open,$insert);
		
		if($query){
			$_SESSION['pesan'] = "Good! Data berhasil disimpan ...";
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