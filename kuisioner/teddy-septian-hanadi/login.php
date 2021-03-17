
			<?php
			session_start();
			include "../../config/koneksi.php";
			$cek=mysqli_fetch_assoc(mysqli_query($Open,"SELECT * FROM tb_projek WHERE nama='Teddy septian hanadi'"));
			if(date('Y-m-d') >= $cek['tgl_terbit'] && date('Y-m-d') < $cek['tgl_tutup']){
			?>
			<!DOCTYPE html>
			<html>
			<head>
				<title>Teddy septian hanadi</title>
				<meta charset="utf-8" />
				<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
				<link rel="shortcut icon" href="../../favicon.ico" type="image/x-icon" />	

				<link href="../../assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
				<link href="../../assets/plugins/bootstrap-441/css/bootstrap.min.css" rel="stylesheet" />
				<link href="../../assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
				<link href="../../assets/plugins/ionicons/css/ionicons.min.css" rel="stylesheet" />
				<link href="../../assets/css/animate.min.css" rel="stylesheet" />
				<link href="../../assets/css/style.min.css" rel="stylesheet" />
				<link href="../../assets/css/style-responsive.min.css" rel="stylesheet" />
				<link href="../../assets/css/theme/default.css" rel="stylesheet" id="theme" />

				<script src="../../assets/plugins/jquery/jquery-2.1.4.min.js"></script>

			</head>
			<body>
				<div class="d-flex flex-row h-100 animated fadeInDown col-md-5  mx-auto" >
				<div class="col-12 align-self-center bg-light rounded-sm">

					<div class="row mt-4">
						<div class="col-9 text-left">
							<h3 class="m-0" style="font-weight: 300">E-SURVEI STP BANDUNG</h3>
							<h6 class="text-muted m-0" style="font-weight: 300">Pusat Penjaminan Mutu</h6>
						</div>
						<div class="col-3 text-right">
							<img alt="" width="60" src="../../assets/img/logo.png">
						</div>
					</div>

					<div class="col-md-12 p-0 mt-4 overflow-hidden" >
					<?php
						$cek=mysqli_fetch_assoc(mysqli_query($Open,"SELECT * FROM tb_projek WHERE nama='Teddy septian hanadi'"));
						if($cek['img'] == "" || is_null($cek['img'])){
					?>
						<img alt="banner" class="img-fluid rounded-sm"  src="../../assets/img/banner-login.jpg">
					<?php		
						}else{
					?>
						<img alt="banner" class="img-fluid rounded-sm"  src="img/<?=$cek['img']?>">
					<?php		
						}
					?>
					</div>

					<div class="col-12 p-0 mt-4 text-left">
					<?php
						if($cek['deskripsi'] == "" || is_null($cek['deskripsi'])){
					?>
						<h5>Teddy septian hanadi</h5>
						<p>Selamat datang. Silahkan isi kolom password di bawah menggunakan password yang telah kami kirim melalui email. Selamat mengisi kuisioner! 
						</p>
					<?php		
						}else{
					?>
						<h5><?php echo $cek['judul']; ?></h5>
						<p><?php echo $cek['deskripsi']; ?></p>
					<?php		
						}
					?>
						
					</div>

					<div class="col-12 p-0 mt-4 mb-4">
						<form action="../proses/check-login.php?op=in" method="POST">
							<input type="hidden" name="kuis" value="teddy_septian_hanadi"/>
							<div class="form-row">
								<div class="col-8">
									<input type="password" name="password" maxlength="255" class="form-control input-lg no-border" placeholder="Password" required />
								</div>			
								<div class="col-4">
									<button type="submit" class="btn btn-primary btn-block "><i class="fa fa-key"></i> &nbsp;Login</button>
								</div>
							</div>
						</form>
						<div class="pesans text-danger">
						<?php 
							if(isset($_SESSION['pesan'])){
								echo $_SESSION['pesan'];
							} 
							$_SESSION['pesan'] ="";
						?></div>
					</div>
					<div class="col-12 p-0 mt-4 mb-4 text-center">
						<small>©2020 | Pusat Penjaminan Mutu - STP NHI Bandung</small>
					</div>
				</div>
				</div>
			</div>
				<script src="../../assets/plugins/jquery/jquery-3.4.1.slim.min.js"></script>
				<script src="../../assets/plugins/bootstrap-441/js/bootstrap.min.js"></script>
			</body>
			</html>
			<?php
				}else{
					echo'
					<body style="background-color:#E4E7E8;">
					<div style="width:100%;text-align:center;">
					<br><br><br>
					<h4>Mohon maaf, pengisian kuisioner belum dibuka / telah ditutup. Terima Kasih.</h4><hr>
					</div>
					</body>';
				}
			?>
			