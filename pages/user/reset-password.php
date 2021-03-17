<div class="row">
<?php
	if (isset($_GET['id_user'])) {
		$id_user = $_GET['id_user'];
	}
	else {
		die ("Error. No Kode Selected! ");	
	}
	
	include "../../config/koneksi.php";
	$query	= mysqli_query($Open,"SELECT * FROM m_user WHERE id='$id_user'");
	$hasil	= mysqli_fetch_array ($query);
	if($hasil['hak_akses'] == 'Mahasiswa'){
		$qr=mysqli_query($Open,"SELECT nama, tgllahir FROM m_siswa WHERE nim='".$hasil['nama_user']."'") ;
		$r=mysqli_fetch_assoc($qr);
		$tgllahir = str_replace('-', '', $r['tgllahir']);

		$passtext	=$tgllahir;
		$password	=md5($tgllahir);
	}else{
		$passtext	="123";
		$password	=md5("123");
	}	
	$reset= mysqli_query ($Open,"UPDATE m_user SET passtext='".$passtext."', password='$password' WHERE id='$id_user'");
	if($reset){
		$_SESSION['pesan'] = "Password $hasil[nama_user] berhasil direset ...";
		header("location:index.php?page=form-view-data-user");
	}
	else {
		echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
	}	
?>
</div>