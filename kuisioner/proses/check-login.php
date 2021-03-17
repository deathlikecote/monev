<div class="row">
<?php
session_start();
if ($_POST['kuis'] != "") {
	include "../../config/koneksi.php";
	$kuis = $_POST['kuis'];
	$nama_domain	= str_replace("_","-", $kuis);
	$password = $_POST['password'];
	$op = $_GET['op'];

	if($op=="in"){
		$sql = mysqli_query($Open,"SELECT * FROM tb_".$kuis."_user WHERE password='$password'");
		if(mysqli_num_rows($sql)==1){
			$qry = mysqli_fetch_array($sql);
			$_SESSION['id_user_kuis']	= $qry['id'];
			$_SESSION['kode_user']  = $qry['kode'];
			$_SESSION['nama_user']	= $qry['nama_user'];
			$_SESSION['hak_akses']	= "responden";
			
			$_SESSION['pesan'] = "Login Success!";
			header("location:../".$nama_domain."");
			
		}
		else{
			$_SESSION['pesan'] = "Login Failed! password tidak ditemukan ...";
			unset($_SESSION['id_user_kuis']);
			unset($_SESSION['kode_user']);
			unset($_SESSION['nama_user']);
			unset($_SESSION['hak_akses']);
			header("location:../".$nama_domain."");
		}
	}
	else if($op=="out"){
		unset($_SESSION['id_user_kuis']);
		unset($_SESSION['kode_user']);
		unset($_SESSION['nama_user']);
		unset($_SESSION['hak_akses']);
		header("location:../".$nama_domain."");
	}
}
?>
</div>