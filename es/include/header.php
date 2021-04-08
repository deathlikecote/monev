<?php
// session_start();
include "./../include/koneksi.php";
if($_SESSION['jabatan']=="operator" or $_SESSION['jabatan']=="pejabat"){

}else{
	session_destroy();
	header('Location: ./../');
}
?>
<!DOCTYPE html>
<html>
<head>
<title>EKSEKUTIF</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- <link rel="stylesheet" type="text/css" href="./CSS/style.css"> -->
<!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script> -->
<script src="../persiapan/bootstrap/js/bootstrap.min.js"></script>

    <link href="../persiapan/bootstrap/css/bootstrap.css" rel="stylesheet">
    <script src="../assets/jquery-3.1.1.min.js"></script>
    <link rel="stylesheet" href="../assets/clock.css">
    
    <style type="text/css">
    	.loader {
			position: absolute;
			left: 45%;
			top: 30%;
			width: 150px;
			height: auto;
			z-index: 9999;
			background: url('images/page-loader.gif');
			background-size:15% ;
			background-repeat:no-repeat;
			background-position:right;
			background-origin:content-box;
			padding:10px;
			background-color:#CCCCCC;
			border-radius:8px;
		}
		.yellow{
			background-color:#FDB813;
			color:#FFFFFF;
		}
		.blue{
			background-color:#30466F;
			color:#FFFFFF;
		}
		.centext{
			text-align:center;
		}
		#ket{
			font-size:12px;
		}
		.tabel{
			width:100%;
			text-align:center;
			font-size:12px;
		}
		.tabel thead td{
			background-color:#30466F;
			color:#FFFFFF;
			text-align:center;
			padding:5px 0px;
			
		}

		.tabel2{
			width:100%;
			text-align:center;
			font-size:12px;
		}

		.tabel2 thead td{
			background-color:#FDB813;
			color:#FFFFFF;
			text-align:center;
			padding:5px 0px;
			
		}
		input[type="text"]#ipt{
			color:#272125;
			padding:5px;
			outline:none;
		}
		.search{
			width:11.5%;
			height:25px;
			min-width:25px;
			background-image:url(images/srch.png);
			background-size:100%;
			background-repeat:no-repeat;
			background-position: center;
			background-color:white;
			border:none;
			outline:none;
		}
    </style>
</head>
<body>
    <div class="jav"></div>