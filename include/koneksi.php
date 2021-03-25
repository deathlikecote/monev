<?php
session_start();	
$local = mysqli_connect("localhost", "root", "", "dbreferensi");
$plm = mysqli_connect("localhost", "root", "", "plm");
$plm_edom = mysqli_connect("localhost", "root", "", "plm_edom");

$pertanow=mysqli_query($plm,"select PERTA as periode from tahunakademik where aktif ='1'") ;
$rz = mysqli_fetch_assoc($pertanow);
$_SESSION['pertan'] = $rz['periode'];
?>
