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
	$nim		= $_POST['nim'];
	$nama		= strtoupper($_POST['nama']);
	$sex		= $_POST['sex'];
	$tgllahir	= $_POST['tgllahir'];
	$thnmasuk	= $_POST['thnmasuk'];
	$nemail		= strtolower($_POST['nemail']);
	$nim_old	=$_POST['nim_old'];
	
	$tampilUsr	= mysqli_query($Open,"SELECT id FROM m_user WHERE nama_user='$nim_old'");
	$hasil	= mysqli_fetch_assoc ($tampilUsr);

		 if (empty($_POST['nim']) || empty($_POST['nama']) || empty($_POST['nama'])) {
				$_SESSION['pesan'] = "Oops! Silahkan isi kolom mandatori ...";
				header("location:index.php?page=form-edit-data-mahasiswa&id=$id");

		}else{
			$cekuser	=mysqli_num_rows (mysqli_query($Open,"SELECT nim FROM m_siswa WHERE nim='$_POST[nim]'"));
			 if($cekuser > 0 && $nim != $nim_old) {
					$_SESSION['pesan'] = "Oops! Data sudah ada ...";
					header("location:index.php?page=form-edit-data-mahasiswa&id=$id");
			 	
			 }else{
				$update= mysqli_query ($Open,"UPDATE m_siswa SET 
					nim='$nim', 
					nama='$nama',
					sex='$sex', 
					tgllahir='$tgllahir', 
					thnmasuk='$thnmasuk', 
					nemail='$nemail' 
					WHERE id='$id'");
				if($update){
					$update= mysqli_query ($Open,"UPDATE m_user SET nama_user='$nim', nama='".$_POST['nama']."' WHERE id='".$hasil['id']."'");
					if($update){
						$_SESSION['pesan'] = "Good! Data berhasil disimpan ...";
						header("location:index.php?page=form-view-data-mahasiswa");
					}
					else {
						echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
					}
					
				}
				else {
					echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
				}
			}
			
			
		}
	}
?>
</div>