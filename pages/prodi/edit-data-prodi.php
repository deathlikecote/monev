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
	$namaprodi	=strtoupper($_POST['namaprodi']);
	$kodeprodi	=strtoupper($_POST['kodeprodi']);
	$kodeprodi_old	=$_POST['kodeprodi_old'];
	$jenprodi	=strtoupper($_POST['jenprodi']);
	$jurprodi	=strtoupper($_POST['jurprodi']);
	
	$tampilUsr	= mysqli_query($Open,"SELECT id FROM m_user WHERE nama_user='$kodeprodi_old'");
	$hasil	= mysqli_fetch_assoc ($tampilUsr);

		 if (empty($_POST['kodeprodi']) || empty($_POST['namaprodi']) || empty($_POST['jenprodi'])) {
				$_SESSION['pesan'] = "Oops! Silahkan isi kolom mandatori ...";
				header("location:index.php?page=form-edit-data-prodi&id=$id");

		}else{
			$cekuser	=mysqli_num_rows (mysqli_query($Open,"SELECT kodeprodi FROM m_prodi WHERE kodeprodi='$_POST[kodeprodi]'"));
			 if($cekuser > 0 && $kodeprodi != $kodeprodi_old) {
					$_SESSION['pesan'] = "Oops! Data sudah ada ...";
					header("location:index.php?page=form-edit-data-prodi&id=$id");
			 	
			 }else{
				$update= mysqli_query ($Open,"UPDATE m_prodi SET kodeprodi='$kodeprodi', namaprodi='$namaprodi', jenprodi='$jenprodi', jurprodi='$jurprodi' WHERE id='$id'");
				if($update){
					$update= mysqli_query ($Open,"UPDATE m_user SET nama_user='$kodeprodi', nama='".$_POST['namaprodi']."' WHERE id='".$hasil['id']."'");
					if($update){
						$_SESSION['pesan'] = "Good! Data berhasil disimpan ...";
						header("location:index.php?page=form-view-data-prodi");
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
		if (strlen($avatar)>0) {
			if (is_uploaded_file($_FILES['avatar']['tmp_name'])) {
				move_uploaded_file ($_FILES['avatar']['tmp_name'], "../assets/img/profil/".$avatar);
			}
		}
	}
?>
</div>