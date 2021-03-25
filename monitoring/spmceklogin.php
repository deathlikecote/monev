<?php
include "./../include/koneksi.php";

$username=$_POST['login'];
$password=$_POST['password'];


$hasil = mysqli_query ($plm, "SELECT * FROM m_user WHERE BINARY username='$username' AND password='".md5($password)."' AND status='1'");


if($bar = mysqli_fetch_array($hasil)){
	$_SESSION['jabatan']= $bar['jabatan'];
	$_SESSION['susername']= $bar['username'];
	$_SESSION['spassword']= $bar['passtext'];
	$_SESSION['nama']= $bar['nama'];
	$_SESSION['masuk']=1;
	if($_SESSION['jabatan']=='operator' or $_SESSION['jabatan']=='monitoringoperator'){
		header ('location:spmadmin.php');
}else{
		header ('location:./../palembang');
	}
}else{
	header ('location:./../palembang');
}

?>

