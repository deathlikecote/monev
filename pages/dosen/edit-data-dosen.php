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
	$nama		=$_POST['nama'];
	$kodedosen	=strtoupper($_POST['kodedosen']);
	$kodedosen_old	=$_POST['kodedosen_old'];
	
	$tampilUsr	= mysqli_query($Open,"SELECT id FROM m_user WHERE nama_user='$kodedosen_old'");
	$hasil	= mysqli_fetch_assoc ($tampilUsr);

		 if (empty($_POST['kodedosen']) || empty($_POST['nama'])) {
				$_SESSION['pesan'] = "Oops! Silahkan isi kolom mandatori ...";
				header("location:index.php?page=form-edit-data-dosen&id=$id");

		}else{
			$cekuser	=mysqli_num_rows (mysqli_query($Open,"SELECT kodedosen FROM m_dosen WHERE kodedosen='$_POST[kodedosen]'"));
			 if($cekuser > 0 && $kodedosen != $kodedosen_old) {
					$_SESSION['pesan'] = "Oops! Data sudah ada ...";
					header("location:index.php?page=form-edit-data-dosen&id=$id");
			 	
			 }else{
				$update= mysqli_query ($Open,"UPDATE m_dosen SET kodedosen='$kodedosen', nama='$nama' WHERE id='$id'");
				if($update){
					$update= mysqli_query ($Open,"UPDATE m_user SET nama_user='$kodedosen', nama='".$_POST['nama']."' WHERE id='".$hasil['id']."'");
					if($update){
						$_SESSION['pesan'] = "Good! Data berhasil disimpan ...";
						header("location:index.php?page=form-view-data-dosen");
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