<div class="row">
<?php
	include "config/koneksi.php";
	$nama_user		= $_POST['nama_user'];
	$password		= md5($_POST['password']);
	$op 			= $_GET['op'];

	if($op=="in"){
		$sql = mysqli_query($Open,"SELECT * FROM m_user WHERE nama_user='$nama_user' AND password='$password'");
		if(mysqli_num_rows($sql)==1){
			$qry = mysqli_fetch_array($sql);
			$_SESSION['id']	= $qry['id'];
			$_SESSION['idopt']	= $qry['id'];
			$_SESSION['id_user']	= $qry['nama_user'];
			$_SESSION['nama_user']	= $qry['nama'];
			$_SESSION['hak_akses']	= $qry['hak_akses'];
			$_SESSION['id_user_kuis']		= '1';
			
			if($qry['hak_akses']=="Admin" || $qry['hak_akses']=="Operator" || $qry['hak_akses']=="Manajemen" || $qry['hak_akses']=="Prodi" || $qry['hak_akses']=="Mahasiswa" || $qry['hak_akses']=="Dosen"){
				$profil = mysqli_query($Open,"SELECT * FROM m_profil");
				$rProfil = mysqli_fetch_array($profil);

				$perta = mysqli_query($Open,"SELECT * FROM m_periode ORDER BY perta DESC");
				$rPerta = mysqli_fetch_array($perta);

				$lap = mysqli_query($Open,"SELECT * FROM m_laporan");
				$rLap = mysqli_fetch_array($lap);

				$_SESSION['perta']		= $rPerta['perta'];
				$_SESSION['perteks']	= $rPerta['periode'];
				$_SESSION['utsuas']		= $rPerta['utsuas'];
				$_SESSION['nama_pt']	= $rProfil['nama'];
				$_SESSION['alamat_pt']	= $rProfil['alamat'];
				$_SESSION['unit']		= $rProfil['unit'];
				$_SESSION['pengelola']	= $rProfil['pengelola'];
				$_SESSION['jabatan']	= $rProfil['jabatan'];
				$_SESSION['logo_inst']	= $rProfil['logo'];
				$_SESSION['judul_lap']	= $rLap['judul'];
				$_SESSION['head_lap']	= $rLap['header'];
				$_SESSION['foot_lap']	= $rLap['footer'];

				$_SESSION['pesan'] = "Login Success!";
				header("location:pages/");
			}
		}
		else{
			$_SESSION['pesan'] = "Login Failed! Username & password tidak sesuai ...";
			header("location:./");
		}
	}
	else if($op=="out"){
		unset($_SESSION['nama_user']);
		unset($_SESSION['hak_akses']);
		header("location:./");
	}
?>
</div>