<?php
session_start();	
$local = mysqli_connect("localhost", "palembang", "P0ltekp@r", "DBREFERENSI");
$plm = mysqli_connect("localhost", "palembang", "P0ltekp@r", "plm");
$plm_edom = mysqli_connect("localhost", "palembang", "P0ltekp@r", "plm_edom");

 $pertanow=mysqli_query($plm,"select max(PERTA) as periode from tahunakademik") ;
 $rz = mysqli_fetch_assoc($pertanow);
 $_SESSION['pertan'] = $rz['periode'];
?>
