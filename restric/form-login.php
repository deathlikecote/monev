<?php
include "config/koneksi.php";
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
	<title>Login Template</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

	<!-- Bootstrap 4 css -->

	<!-- Custom css -->

	<!-- Favicon -->
	<link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
	<link rel="icon" href="./favicon.ico" type="image/x-icon">

	<!-- Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

	<!-- fontawesome JS -->

</head>

<body>

	<div class="container-fluid h-100">
		<div class="row h-100 align-items-center justify-content-center">

			<!-- BEGIN CONTENT -->
			<div class="col-12 h-100">
				<!-- id="login-container" -->
				<div class="row h-100">

					<!-- BEGIN LEFT CONTENT -->
					<div class="col-12 col-sm-9 d-none d-lg-inline h-100 text-white p-0" id="left-content">
						<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<?php
								$a = 0;
								$t = mysqli_query($Open, "SELECT * FROM m_banner ORDER BY tgl_upload DESC");
								while ($tak = mysqli_fetch_array($t)) {
									if ($a == 0) {
										$aktif = "active";
										$a++;
									} else {
										$aktif = "";
									}
								?>

									<div class="carousel-item <?= $aktif ?>">
										<img style="height: 100vh !important;" class="d-block w-100" src="assets/img/banner/<?= $tak['nama'] ?>">
									</div>

								<?php } ?>


							</div>
							<a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
								<span class="carousel-control-prev-icon" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
								<span class="carousel-control-next-icon" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
						</div>
						<div class="row h-100 align-items-center justify-content-center">

							<!-- <div class="col-10">
								<h1>Panel Admin</h1>
								<p>Selamat Datang</p>
							</div> -->

						</div>
					</div> <!-- End div #left-content -->
					<!-- END LEFT CONTENT -->


					<!-- BEGIN RIGHT CONTENT -->
					<div class="d-flex justify-content-end w-100" id="right-content">

						<!-- BEGIN lOGIN -->
						<div class="col-12 col-lg-3 pt-5 pb-5 bg-white" id="log-in">
							<div class="row align-items-start justify-content-center">
								<div class="col-9">
									<img src="assets/img/logo.png" alt="logo" class="logo mx-auto d-block mb-3" style="width: 80px">
									<div class="w-100 mb-5 text-center" style="line-height: 1.2em;">MONEV STP BANDUNG<br><small>Pusat Penjaminan Mutu</small></div>
								</div>
							</div>
							<div class="row h-50 align-items-center justify-content-center">
								<div class="col-9">
									<div class="w-100 mb-3 text-center"><small>Silahkan login dengan akun anda</small></div>

									<div class='pesan alert alert-danger col-sm-12' style="font-size:0.8em; display: none"><?= $_SESSION['pesan'] ?>
									</div>
									<form method="post" class="mt-0" action="index.php?page=login&op=in" autocomplete="off">

										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text bg-white text-primary"><i class="fas fa-user"></i></span>
											</div>
											<input type="search" name="nama_user" class="form-control" id="username" placeholder="Username" required="" autofocus>
										</div>

										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text bg-white text-primary"><i class="fas fa-key"></i></span>
											</div>
											<input type="password" name="password" class="form-control" id="password" placeholder="Password" required="">
										</div>

										<div class="form-row clearfix mb-3">
											<div class="col-6 float-left">
												<div class="custom-control custom-checkbox">
													<input type="checkbox" name="remember" class="custom-control-input" id="remember">
													<label class="custom-control-label" for="remember"><small>Remember me</small></label>
												</div>
											</div>
											<!-- <div class="col-6 float-right text-right">
												<a href="#" class="text-primary"><small>Forgot password?</small></a>
											</div> -->
										</div>

										<div class="form-group mb-5">
											<input type="submit" name="login" class="btn btn-primary form-control" value="Login">
										</div>

									</form>
								</div>
							</div>
							<div class="col-12 text-center"><small>&copy;2021 All Rights Reserved</small></div>
						</div> <!-- End div #log-in -->
						<!-- END LOGIN -->

					</div> <!-- End div #right-content -->
					<!-- END RIGHT CONTENT -->

				</div>
			</div> <!-- End div .login-container -->
			<!-- END CONTENT -->

		</div>
	</div> <!-- End div .container-fluid -->

	<?php
	if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
		echo "<script>
	$(document).ready(function(){
		$('.pesan').css('display', 'block');
	})
	</script>";
	}
	$_SESSION['pesan'] = "";
	?>
</body>

</html>