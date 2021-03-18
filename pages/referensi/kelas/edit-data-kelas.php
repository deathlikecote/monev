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
	$perta		= $_POST['perta'];
	$kdprodi	= $_POST['kdprodi'];
	$kelas		= $_POST['kelas'];
	$nim		= $_POST['nim'];
	$status		= $_POST['status'];
	$nim_old	= $_POST['nim_old'];
	
	$cari=mysqli_query($Open,"select * from t_kelas where nim='".$nim."' and perta = '".$perta."'") ;
	$datas=mysqli_num_rows($cari);

	$qr=mysqli_query($Open,"SELECT nama, tgllahir FROM m_siswa WHERE nim='".$nim."'") ;
	$r=mysqli_fetch_assoc($qr);
	$tgllahir = str_replace('-', '', $r['tgllahir']);

	$cekuser	=mysqli_num_rows (mysqli_query($Open,"SELECT * FROM t_kelas WHERE nim='".$nim."' AND PERTA = '".$perta."'"));
	 if($cekuser > 0 && $nim != $nim_old) {
			$_SESSION['pesan'] = "Oops! Data sudah ada ...";
			header("location:index.php?page=form-edit-data-kelas&id=$id");
	 	
	 }else{
		$update= mysqli_query ($Open,"UPDATE t_kelas SET 
			perta		= '$perta',
			kdprodi		= '$kdprodi',
			kelas		= '$kelas',
			nim			= '$nim',
			nama		= '".$r['nama']."',
			status		= '$status'
			WHERE id='$id'");
		if($update){
			$update= mysqli_query ($Open,"UPDATE m_user SET 
				nama_user='$nim', 
				nama='".(ucwords(strtolower($r['nama'])))."',
				passtext = '$tgllahir',
				password = '".(md5($tgllahir))."'
				WHERE nama_user='$nim_old'");
			if($update){
				$_SESSION['pesan'] = "Good! Data berhasil diperbaharui ...";
				header("location:index.php?page=form-view-data-kelas");
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
?>
</div>