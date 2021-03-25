<?php
include "koneksi.php";

if(isset($_POST['user']) && isset($_POST['password'])){
	$user=$_POST['user'];
	$pass=$_POST['password'];
	$cari=mysqli_query($plm,"Select a.*, b.jabatan as jabatan2 from m_user a, m_dosen b where (a.username='$user' and a.password='".md5($pass)."') and a.status='1' and b.kodedosen = a.username");
	$r=mysqli_fetch_array($cari);
	
	if($r['username']!=''){
		$_SESSION['iduser']=$r['id'];
		$_SESSION['jabatan']=$r['jabatan'];
		$_SESSION['jabatan2']=$r['jabatan2'];
		$_SESSION['nama']=$r['nama'];
		$_SESSION['username']=$r['username'];
		$_SESSION['password']=$r['passtext'];
			header ('location:../main.php');	
	}else{
		echo'
		<script>
			alert("User and password not found or do not match");
		</script>
		<meta http-equiv="refresh" content="0;../">
		';	
	}
	
}
if(isset($_GET['logout'])){
	session_destroy();
	echo'<meta http-equiv="refresh" content="0;../">';	
}
?>