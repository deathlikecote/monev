<?php
ob_start();
session_start();
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title>MONEV STPB</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="Aplikasi Sistem Informasi Kuisioner Online Berbasis Web" name="description" />
	<meta content="aplikasi kuisioner berbasis web, aplikasi kuisioner, kuisioner berbasis web" name="keywords" />
	<meta content="Teddy Septian H" name="author" />
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
	<!-- ================== BEGIN BASE CSS STYLE ================== -->

	<!-- Bootstrap 4 css -->
	<link rel="stylesheet" href="assets/mystyle/css/bootstrap.min.css">

	<!-- Custom css -->
	<link rel="stylesheet" href="assets/mystyle/css/custom.css">

	<!-- Favicon -->
	<link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
	<link rel="icon" href="./favicon.ico" type="image/x-icon">

	<!-- Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="assets/mystyle/js/bootstrap.min.js"></script>
	<script src="assets/mystyle/js/jquery-3.2.1.min.js"></script>

	<!-- fontawesome JS -->
	<script src="assets/mystyle/js/solid.min.js"></script>
	<script src="assets/mystyle/js/fontawesome.min.js"></script>

	<!-- ================== END BASE CSS STYLE ================== -->
	<!-- ================== BEGIN BASE JS ================== -->
	<!-- <script src="assets/plugins/pace/pace.min.js"></script>
	<script src="assets/plugins/jquery/jquery-2.1.4.min.js"></script> -->
	<!-- ================== END BASE JS ================== -->
</head>

<body class="pace-top">
	<?php
	$page = (isset($_GET['page'])) ? $_GET['page'] : "main";
	switch ($page) {
		case 'login':
			include "restric/login.php";
			break;
		default:
			include "restric/form-login.php";
	}
	?>
	<script>
		$(document).ready(function() {
			App.init();
		});
	</script>
</body>

</html>