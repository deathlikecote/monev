<?php
ob_start();
session_start();
if (!isset($_SESSION['id_user'])) {
	die("<b>Oops!</b> Access Failed.
		<p>Sistem Logout. Anda harus melakukan Login kembali.</p>
		<button type='button' onclick=location.href='../'>Back</button>");
}
if ($_SESSION['hak_akses'] != "Manajemen" && $_SESSION['hak_akses'] != "Admin" && $_SESSION['hak_akses'] != "Operator" && $_SESSION['hak_akses'] != "Mahasiswa" && $_SESSION['hak_akses'] != "Dosen" && $_SESSION['hak_akses'] != "Prodi") {
	die("<b>Oops!</b> Access Failed.
		<p>Anda Bukan Admin.</p>
		<button type='button' onclick=location.href='../'>Back</button>");
}
include "../config/koneksi.php";
$tampilUsr	= mysqli_query($Open, "SELECT * FROM m_user WHERE nama_user='$_SESSION[id_user]'");
$usr		= mysqli_fetch_array($tampilUsr);

/*$tampilPeg	=mysqli_query($Open,"SELECT * FROM tb_responden");
	$jmlpeg		=mysqli_num_rows($tampilPeg);*/

// include_once ('reminder.php');
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->

<head>
	<meta charset="utf-8" />
	<title>MONEV <?= strtoupper($_SESSION['nama_pt']) ?></title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="Aplikasi Sistem Informasi Monev Berbasis Web" name="description" />
	<meta content="aplikasi kuisioner berbasis web, aplikasi kuisioner, kuisioner berbasis web" name="keywords" />
	<meta content="Teddy Septian H" name="author" />
	<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon" />
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="../assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css" rel="stylesheet" />
	<link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="../assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
	<link href="../assets/plugins/ionicons/css/ionicons.min.css" rel="stylesheet" />
	<link href="../assets/css/animate.min.css" rel="stylesheet" />
	<link href="../assets/css/style.min.css" rel="stylesheet" />
	<link href="../assets/css/style-responsive.min.css" rel="stylesheet" />
	<link href="../assets/css/theme/default.css" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->


	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link rel="stylesheet" type="text/css" href="../assets/plugins/wysihtml5/dist/bootstrap3-wysihtml5.min.css">
	</link>
	<link href="../assets/plugins/jquery-jvectormap/jquery-jvectormap.css" rel="stylesheet" />
	<link href="../assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
	<link href="../assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
	<link href="../assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet" />

	<link href="../assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
	<link href="../assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css" rel="stylesheet" />
	<link href="../assets/plugins/ionRangeSlider/css/ion.rangeSlider.css" rel="stylesheet" />
	<link href="../assets/plugins/ionRangeSlider/css/ion.rangeSlider.skinNice.css" rel="stylesheet" />
	<link href="../assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
	<link href="../assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
	<link href="../assets/plugins/password-indicator/css/password-indicator.css" rel="stylesheet" />
	<link href="../assets/plugins/bootstrap-combobox/css/bootstrap-combobox.css" rel="stylesheet" />
	<link href="../assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
	<link href="../assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" />
	<link href="../assets/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet" />
	<link href="../assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
	<link href="../assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
	<link href="../assets/plugins/bootstrap-eonasdan-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
	<link href="../assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css" rel="stylesheet" />
	<link href="../assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.css" rel="stylesheet" />
	<link href="../assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-fontawesome.css" rel="stylesheet" />
	<link href="../assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-glyphicons.css" rel="stylesheet" />
	<link rel="stylesheet" href="../assets/plugins/amcharts/samples/style.css" type="text/css">
	<script src="../assets/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
	<script src="../assets/plugins/amcharts/amcharts/radar.js" type="text/javascript"></script>
	<script src="../assets/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
	<!-- ================== END PAGE LEVEL STYLE ================== -->

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="../assets/plugins/jquery/jquery-2.1.4.min.js"></script>
	<script src="../assets/plugins/pace/pace.min.js"></script>
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	<style type="text/css">
		.fileContainer {
			overflow: hidden;
			position: relative;
			float: left;
			top: -33px;
		}

		.fileContainer [type=file] {
			cursor: inherit;
			display: block;
			filter: alpha(opacity=0);
			min-height: 100%;
			min-width: 100%;
			opacity: 0;
			position: absolute;
			right: 0;
			text-align: right;
			top: 0;
		}

		.fileContainer [type=file] {
			cursor: pointer;
		}

		iframe {
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			border: 0;
		}

		.loading {
			width: 100%;
			background: rgba(51, 51, 51, 0.7);
			position: fixed;
			z-index: 9999;
			left: 0;
			height: 100vh;
			text-align: center;
			line-height: 100vh;
			display: none;
			visibility: hidden;
		}

		.persen {
			position: absolute;
			top: 53%;
			left: 50%;
			transform: translateX(-50%);

			z-index: 999;
			color: white;
			font-size: 1.2em;
		}

		#navcenter {
			position: absolute;
			width: 100%;
			left: 0;
			top: 50%;
			transform: translateY(-50%);
			text-align: center;
			margin: 0 auto;
		}

		@media only screen and (max-width: 600px) {
			#navcenter {
				top: 75%;
			}
		}
	</style>
</head>

<body>
	<div class="loading" style="">
		<img src="../assets/img/Blocks.gif" style="width: 100px;height:100px;" />
		<h3 class="persen" style="">Mohon Tunggu..</h3>
	</div>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		<!-- begin #header -->
		<div id="header" class="header navbar navbar-default navbar-fixed-top">
			<!-- begin container-fluid -->
			<div class="container-fluid">
				<!-- begin mobile sidebar expand / collapse button -->
				<div class="navbar-header">
					<a href="./" class="navbar-brand" style="font-size: 8pt"><span class="navbar-logo">
							<img width="35" style="margin: -6px 0 0 -6px" alt="simpeg" src="../assets/img/logo.png"></span>&nbsp;
						<div class="text-left" style="position:relative;top:-25px;left:37px; line-height: 1.1em"><b>MONEV<br><?= strtoupper($_SESSION['nama_pt']) ?></b></div>
					</a>

					<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<!-- end mobile sidebar expand / collapse button -->

				<!-- begin navbar-collapse -->
				<div class="collapse navbar-collapse pull-left" id="top-navbar">
					<ul class="nav navbar-nav">
						<li><a href="javascript:;" data-click="sidebar-minify"><i class="ion-navicon-round m-r-5 f-s-20 pull-left text-inverse"></i></a></li>
					</ul>
				</div>
				<!-- begin middle nav -->
				<div class="nav navbar-nav" id="navcenter">
					<h4><small>Perta Aktif</small><br><?= $_SESSION['perta']; ?></h4>
				</div>
				<!-- end navbar-collapse -->
				<!-- begin header navigation right -->
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown navbar-user">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<span class="user-image online">
								<?php
								if (empty($usr['avatar']))
									echo "<img src='../assets/img/profil/no-avatar.jpg' alt='simpeg' />";
								else
									echo "<img src='../assets/img/profil/$usr[avatar]' alt='simpeg' />";
								?>
							</span>
							<span class="hidden-xs"><span class="text-warning">Selamat datang, </span><?= $usr['nama'] ?></span> <span class="text-warning"><i class="fa fa-caret-down"></i></span>
						</a>
						<ul class="dropdown-menu animated fadeInLeft">
							<li class="arrow"></li>
							<li><a href="index.php?page=form-ganti-foto&id=<?= $_SESSION['id'] ?>"><i class="ion-person"></i> &nbsp;Ubah Foto</a></li>
							<li><a href="index.php?page=form-ganti-password&id=<?= $_SESSION['id'] ?>"><i class="ion-ios-locked"></i> &nbsp;Ubah Password</a></li>
							<li class="divider"></li>
							<li><a href="../restric/logout.php"><i class="ion-power"></i> &nbsp;Log Out</a></li>
						</ul>
					</li>
				</ul>
				<!-- end header navigation right -->
			</div>
			<!-- end container-fluid -->
		</div>
		<!-- end #header -->
		<!-- begin #sidebar -->
		<div id="sidebar" class="sidebar">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar user -->
				<ul class="nav">
					<li class="nav-profile">
						<div class="image">
							<a href="javascript:;">
								<?php
								if (empty($usr['avatar']))
									echo "<img src='../assets/img/profil/no-avatar.jpg' alt='simpeg' />";
								else
									echo "<img src='../assets/img/profil/$usr[avatar]' alt='simpeg' />";
								?>
							</a>
						</div>
						<div class="info">
							<?= $usr['nama'] ?>
							<small><?= $usr['hak_akses'] ?></small>
						</div>
					</li>
				</ul>
				<!-- end sidebar user -->
				<!-- begin sidebar nav -->
				<ul class="nav">
					<li class="nav-header p-b-0">Perta : <?= $_SESSION['perta'] ?></li>
					<li class="nav-header">Navigasi <i class="fa fa-paper-plane m-l-5"></i></li>
					<?php if ($_SESSION['hak_akses'] == 'Manajemen' || $_SESSION['hak_akses'] == 'Admin') {
					?>
						<li><a href="./"><i class="ion-stats-bars bg-blue"></i><span>Dashboard</span> <span class="badge bg-primary pull-right">HOME</span></a></li>
					<?php } ?>
					<?php if ($_SESSION['hak_akses'] == 'Admin' || $_SESSION['hak_akses'] == 'Operator') { ?>
						<li><a href="index.php?page=form-view-data-banner"><i class="ion-image bg-pink"></i><span>Banner</span></a></li>
						<li class="has-sub">
							<a href="javascript:;"><b class="caret pull-right"></b><i class="ion-ios-gear bg-purple"></i><span>Master</span></a>
							<ul class="sub-menu">
								<li><a href="index.php?page=form-view-data-profil"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Profil</a></li>
								<li><a href="index.php?page=form-view-data-laporan"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Laporan</a></li>
								<li><a href="index.php?page=form-view-data-prodi"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Prodi</a></li>
								<li><a href="index.php?page=form-view-data-dosen"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Dosen</a></li>
								<li><a href="index.php?page=form-view-data-timdosen"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Tim Dosen</a></li>
								<li><a href="index.php?page=form-view-data-matakuliah"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Mata Kuliah</a></li>
								<li><a href="index.php?page=form-view-data-mahasiswa"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Mahasiswa</a></li>
								<li><a href="index.php?page=form-view-data-user"><i class="menu-icon fa fa-caret-right"></i> &nbsp;User</a></li>
							</ul>
						</li>
						<li class="has-sub">
							<a href="javascript:;"><b class="caret pull-right"></b><i class="ion-ios-list-outline bg-yellow"></i><span>Quesioner</span></a>
							<ul class="sub-menu">
								<li><a href="index.php?page=form-view-data-edom"><i class="menu-icon fa fa-caret-right"></i> &nbsp;EDOM</a></li>
								<li><a href="index.php?page=form-view-data-epom"><i class="menu-icon fa fa-caret-right"></i> &nbsp;EPOM</a></li>
								<li><a href="index.php?page=form-view-data-epod"><i class="menu-icon fa fa-caret-right"></i> &nbsp;EPOD</a></li>
								<li><a href="index.php?page=form-view-data-edop"><i class="menu-icon fa fa-caret-right"></i> &nbsp;EDOP</a></li>
							</ul>
						</li>
						<li class="has-sub">
							<a href="javascript:;"><b class="caret pull-right"></b><i class="ion-ios-settings-strong bg-pink"></i><span>Referensi</span></a>
							<ul class="sub-menu">
								<li><a href="index.php?page=form-view-data-periode"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Periode</a></li>
								<li><a href="index.php?page=form-view-data-kelas"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Kls Mhs Aktif</a></li>
								<li><a href="index.php?page=form-view-data-penugasan"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Penugasan Dosen</a></li>
							</ul>
						</li>
						<li class="has-sub">
							<a href="javascript:;"><b class="caret pull-right"></b><i class="ion-load-b bg-green"></i><span>Generate Potensi</span></a>
							<ul class="sub-menu">
								<li><a href="index.php?page=form-view-generate-edom"><i class="menu-icon fa fa-caret-right"></i> &nbsp;EDOM & EPOM</a></li>
								<li><a href="index.php?page=form-view-generate-epod"><i class="menu-icon fa fa-caret-right"></i> &nbsp;EPOD & EDOP</a></li>
							</ul>
						</li>
					<?php } ?>
					<!-- EOF Menu Admin -->

					<!-- Menu Mahasiswa -->
					<?php if ($_SESSION['hak_akses'] == 'Mahasiswa') { ?>

						<li><a href="index.php?page=frame-edom"><i class="ion-ios-list-outline bg-yellow"></i><span>Quesioner EDOM</span></a></li>

						<li><a href="index.php?page=frame-epom"><i class="ion-ios-list-outline bg-blue"></i><span>Quesioner EPOM</span></a></li>
						<li><a href="index.php?page=frame-survei"><i class="ion-document-text bg-pink"></i><span>e-Survei</span></a></li>

					<?php } ?>
					<!-- EOF Menu Mahasiswa -->

					<!-- Menu Dosen -->
					<?php if ($_SESSION['hak_akses'] == 'Dosen') { ?>

						<li><a href="index.php?page=frame-epod"><i class="ion-ios-list-outline bg-yellow"></i><span>Quesioner EPOD</span></a></li>
						<li><a href="index.php?page=resume-edom"><i class="ion-document-text bg-blue"></i><span>Resume EDOM</span></a></li>
						<li><a href="index.php?page=resume-edop"><i class="ion-document-text bg-green"></i><span>Resume EDOP</span></a></li>
						<li><a href="index.php?page=frame-survei"><i class="ion-document-text bg-pink"></i><span>e-Survei</span></a></li>

					<?php } ?>
					<!-- EOF Menu Dosen -->

					<!-- Menu Prodi -->
					<?php if ($_SESSION['hak_akses'] == 'Prodi') { ?>

						<li><a href="index.php?page=frame-edop"><i class="ion-ios-list-outline bg-yellow"></i><span>Quesioner EDOP</span></a></li>
						<li><a href="index.php?page=resume-epom"><i class="ion-document-text bg-blue"></i><span>Resume EPOM</span></a></li>
						<li><a href="index.php?page=resume-epod"><i class="ion-document-text bg-green"></i><span>Resume EPOD</span></a></li>
						<li><a href="index.php?page=frame-survei"><i class="ion-document-text bg-pink"></i><span>e-Survei</span></a></li>

					<?php } ?>
					<!-- EOF Menu Prodi -->

					<?php if ($_SESSION['hak_akses'] == 'Admin' || $_SESSION['hak_akses'] == 'Manajemen') { ?>
						<li class="has-sub">
							<a href="javascript:;"><b class="caret pull-right"></b><i class="ion-ios-eye bg-blue"></i><span>Monitoring</span></a>
							<ul class="sub-menu">
								<li class="has-sub">
									<a href="javascript:;"><b class="caret pull-right"></b><i class="menu-icon fa fa-caret-right"></i> &nbsp;EDOM</a>
									<ul class="sub-menu">
										<li><a href="index.php?page=view-data-potensi"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Daftar Potensi</a></li>
										<li><a href="index.php?page=view-data-rekapitulasi"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Rekap Potensi</a></li>
										<li><a href="index.php?page=report01-edom"><i class="menu-icon fa fa-caret-right"></i> &nbsp;R.01 - DPMK</a></li>
										<li><a href="index.php?page=report02-edom"><i class="menu-icon fa fa-caret-right"></i> &nbsp;R.02 - KP</a></li>
										<li><a href="index.php?page=report03-edom"><i class="menu-icon fa fa-caret-right"></i> &nbsp;R.03 - Prodi</a></li>
										<li><a href="index.php?page=report04-edom"><i class="menu-icon fa fa-caret-right"></i> &nbsp;R.04 - Prodi Kelas</a></li>
										<li><a href="index.php?page=report05-edom"><i class="menu-icon fa fa-caret-right"></i> &nbsp;R.05 - Rek. Dosen</a></li>
									</ul>
								</li>

								<li class="has-sub">
									<a href="javascript:;"><b class="caret pull-right"></b><i class="menu-icon fa fa-caret-right"></i> &nbsp;EPOM</a>
									<ul class="sub-menu">
										<li><a href="index.php?page=view-data-potensi-epom"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Daftar Potensi</a></li>
										<li><a href="index.php?page=view-data-rekapitulasi-epom"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Rekap Potensi</a></li>
										<li><a href="index.php?page=report01-epom"><i class="menu-icon fa fa-caret-right"></i> &nbsp;R.01 - Kelas</a></li>
										<li><a href="index.php?page=report02-epom"><i class="menu-icon fa fa-caret-right"></i> &nbsp;R.02 - Prodi</a></li>
										<li><a href="index.php?page=report03-epom"><i class="menu-icon fa fa-caret-right"></i> &nbsp;R.03 - Jurusan</a></li>
									</ul>
								</li>

								<li class="has-sub">
									<a href="javascript:;"><b class="caret pull-right"></b><i class="menu-icon fa fa-caret-right"></i> &nbsp;EPOD</a>
									<ul class="sub-menu">
										<li><a href="index.php?page=view-data-potensi-epod"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Daftar Potensi</a></li>
										<li><a href="index.php?page=report01-epod"><i class="menu-icon fa fa-caret-right"></i> &nbsp;R.01 - Prodi</a></li>
										<li><a href="index.php?page=report02-epod"><i class="menu-icon fa fa-caret-right"></i> &nbsp;R.02 - Prodi</a></li>
										<li><a href="index.php?page=view-daftar-nilai-epod"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Daftar Nilai</a></li>
										<li><a href="index.php?page=view-rekapitulasi-epod"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Rekapitulasi</a></li>
									</ul>
								</li>

								<li class="has-sub">
									<a href="javascript:;"><b class="caret pull-right"></b><i class="menu-icon fa fa-caret-right"></i> &nbsp;EDOP</a>
									<ul class="sub-menu">
										<li><a href="index.php?page=view-data-potensi-edop"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Daftar Potensi</a></li>
										<li><a href="index.php?page=report01-edop"><i class="menu-icon fa fa-caret-right"></i> &nbsp;R.01 - Dsn Mk Prodi</a></li>
										<li><a href="index.php?page=report02-edop"><i class="menu-icon fa fa-caret-right"></i> &nbsp;R.02 - Dosen Prodi</a></li>
										<li><a href="index.php?page=report03-edop"><i class="menu-icon fa fa-caret-right"></i> &nbsp;R.03 - Rekap Prodi</a></li>
										<li><a href="index.php?page=report04-edop"><i class="menu-icon fa fa-caret-right"></i> &nbsp;R.04 - Dosen Prodi</a></li>
										<li><a href="index.php?page=view-rekapitulasi-edop"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Rekapitulasi</a></li>
									</ul>
								</li>
							</ul>
						</li>
					<?php } ?>
					<!-- EOF Menu Admin -->

					<?php if ($_SESSION['hak_akses'] == 'Manajemen') { ?>
						<li class="has-sub">
							<a href="javascript:;"><b class="caret pull-right"></b><i class="ion-ios-eye bg-pink"></i><span>Executive Summary</span></a>
							<ul class="sub-menu">
								<li><a href="index.php?page=es-grafik"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Grafik</a></li>
								<li><a href="index.php?page=es-edom"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Edom</a></li>
								<li><a href="index.php?page=es-epom"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Epom</a></li>
								<li><a href="index.php?page=es-edop"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Edop</a></li>
								<li><a href="index.php?page=es-epod"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Epod</a></li>
							</ul>
						</li>
					<?php } ?>

					<?php if ($_SESSION['hak_akses'] == 'Admin') { ?>
						<li><a href="index.php?page=generate-all"><i class="ion-ios-cloud bg-blue"></i><span>Generate & Backup</span></a></li>
					<?php } ?>

					<li>&nbsp;</li>
					<li><a href="../restric/logout.php"><i class="ion-log-out bg-dark"></i><span>Log Out</span></a></li>
					<!-- begin sidebar minify button -->
					<li><a href="javascript:;" class="sidebar-minify-btn grey" data-click="sidebar-minify"><i class="ion-ios-arrow-left"></i> <span>Sembunyikan</span></a></li>

					<!-- end sidebar minify button -->
				</ul>
				<!-- end sidebar nav -->
			</div>
			<!-- end sidebar scrollbar -->
		</div>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
		<!-- begin #content -->
		<div id="content" class="content">
			<?php
			$page = (isset($_GET['page'])) ? $_GET['page'] : "main";
			switch ($page) {
					/*MASTER PROFIL*/
				case 'form-view-data-profil':
					include "../pages/profil/form-view-data-profil.php";
					break;
				case 'form-edit-data-profil':
					include "../pages/profil/form-edit-data-profil.php";
					break;
				case 'edit-data-profil':
					include "../pages/profil/edit-data-profil.php";
					break;

					/*MASTER LAPORAN*/
				case 'form-view-data-laporan':
					include "../pages/laporan/form-view-data-laporan.php";
					break;
				case 'form-edit-data-laporan':
					include "../pages/laporan/form-edit-data-laporan.php";
					break;
				case 'edit-data-laporan':
					include "../pages/laporan/edit-data-laporan.php";
					break;

					/*MASTER PRODI*/
				case 'form-view-data-prodi':
					include "../pages/prodi/form-view-data-prodi.php";
					break;
				case 'form-edit-data-prodi':
					include "../pages/prodi/form-edit-data-prodi.php";
					break;
				case 'edit-data-prodi':
					include "../pages/prodi/edit-data-prodi.php";
					break;
				case 'form-master-data-prodi':
					include "../pages/prodi/form-master-data-prodi.php";
					break;
				case 'master-data-prodi':
					include "../pages/prodi/master-data-prodi.php";
					break;
				case 'delete-data-prodi':
					include "../pages/prodi/delete-data-prodi.php";
					break;
					// case 'template-prodi': include "../pages/prodi/template-prodi.php"; break;

					/*MASTER DOSEN*/
				case 'form-view-data-dosen':
					include "../pages/dosen/form-view-data-dosen.php";
					break;
				case 'form-edit-data-dosen':
					include "../pages/dosen/form-edit-data-dosen.php";
					break;
				case 'edit-data-dosen':
					include "../pages/dosen/edit-data-dosen.php";
					break;
				case 'form-master-data-dosen':
					include "../pages/dosen/form-master-data-dosen.php";
					break;
				case 'master-data-dosen':
					include "../pages/dosen/master-data-dosen.php";
					break;
				case 'delete-data-dosen':
					include "../pages/dosen/delete-data-dosen.php";
					break;

					/*MASTER TIM DOSEN*/
				case 'form-view-data-timdosen':
					include "../pages/timdosen/form-view-data-timdosen.php";
					break;
				case 'form-edit-data-timdosen':
					include "../pages/timdosen/form-edit-data-timdosen.php";
					break;
				case 'edit-data-timdosen':
					include "../pages/timdosen/edit-data-timdosen.php";
					break;
				case 'form-master-data-timdosen':
					include "../pages/timdosen/form-master-data-timdosen.php";
					break;
				case 'master-data-timdosen':
					include "../pages/timdosen/master-data-timdosen.php";
					break;
				case 'delete-data-timdosen':
					include "../pages/timdosen/delete-data-timdosen.php";
					break;

					/*MASTER MATAKULIAH*/
				case 'form-view-data-matakuliah':
					include "../pages/matakuliah/form-view-data-matakuliah.php";
					break;
				case 'form-edit-data-matakuliah':
					include "../pages/matakuliah/form-edit-data-matakuliah.php";
					break;
				case 'edit-data-matakuliah':
					include "../pages/matakuliah/edit-data-matakuliah.php";
					break;
				case 'form-master-data-matakuliah':
					include "../pages/matakuliah/form-master-data-matakuliah.php";
					break;
				case 'master-data-matakuliah':
					include "../pages/matakuliah/master-data-matakuliah.php";
					break;
				case 'delete-data-matakuliah':
					include "../pages/matakuliah/delete-data-matakuliah.php";
					break;

					/*MASTER MAHASISWA*/
				case 'form-view-data-mahasiswa':
					include "../pages/mahasiswa/form-view-data-mahasiswa.php";
					break;
				case 'form-edit-data-mahasiswa':
					include "../pages/mahasiswa/form-edit-data-mahasiswa.php";
					break;
				case 'edit-data-mahasiswa':
					include "../pages/mahasiswa/edit-data-mahasiswa.php";
					break;
				case 'form-master-data-mahasiswa':
					include "../pages/mahasiswa/form-master-data-mahasiswa.php";
					break;
				case 'master-data-mahasiswa':
					include "../pages/mahasiswa/master-data-mahasiswa.php";
					break;
				case 'delete-data-mahasiswa':
					include "../pages/mahasiswa/delete-data-mahasiswa.php";
					break;

					/*QUISIONER EDOM*/
				case 'form-view-data-edom':
					include "../pages/quisioner/edom/form-view-data-edom.php";
					break;
				case 'form-edit-data-edom':
					include "../pages/quisioner/edom/form-edit-data-edom.php";
					break;
				case 'edit-data-edom':
					include "../pages/quisioner/edom/edit-data-edom.php";
					break;
				case 'form-master-data-edom':
					include "../pages/quisioner/edom/form-master-data-edom.php";
					break;
				case 'master-data-edom':
					include "../pages/quisioner/edom/master-data-edom.php";
					break;
				case 'delete-data-edom':
					include "../pages/quisioner/edom/delete-data-edom.php";
					break;

					/*QUISIONER EPOM*/
				case 'form-view-data-epom':
					include "../pages/quisioner/epom/form-view-data-epom.php";
					break;
				case 'form-edit-data-epom':
					include "../pages/quisioner/epom/form-edit-data-epom.php";
					break;
				case 'edit-data-epom':
					include "../pages/quisioner/epom/edit-data-epom.php";
					break;
				case 'form-master-data-epom':
					include "../pages/quisioner/epom/form-master-data-epom.php";
					break;
				case 'master-data-epom':
					include "../pages/quisioner/epom/master-data-epom.php";
					break;
				case 'delete-data-epom':
					include "../pages/quisioner/epom/delete-data-epom.php";
					break;

					/*QUISIONER EPOD*/
				case 'form-view-data-epod':
					include "../pages/quisioner/epod/form-view-data-epod.php";
					break;
				case 'form-edit-data-epod':
					include "../pages/quisioner/epod/form-edit-data-epod.php";
					break;
				case 'edit-data-epod':
					include "../pages/quisioner/epod/edit-data-epod.php";
					break;
				case 'form-master-data-epod':
					include "../pages/quisioner/epod/form-master-data-epod.php";
					break;
				case 'master-data-epod':
					include "../pages/quisioner/epod/master-data-epod.php";
					break;
				case 'delete-data-epod':
					include "../pages/quisioner/epod/delete-data-epod.php";
					break;

					/*QUISIONER EDOP*/
				case 'form-view-data-edop':
					include "../pages/quisioner/edop/form-view-data-edop.php";
					break;
				case 'form-edit-data-edop':
					include "../pages/quisioner/edop/form-edit-data-edop.php";
					break;
				case 'edit-data-edop':
					include "../pages/quisioner/edop/edit-data-edop.php";
					break;
				case 'form-master-data-edop':
					include "../pages/quisioner/edop/form-master-data-edop.php";
					break;
				case 'master-data-edop':
					include "../pages/quisioner/edop/master-data-edop.php";
					break;
				case 'delete-data-edop':
					include "../pages/quisioner/edop/delete-data-edop.php";
					break;

					/*PERIODE*/
				case 'form-view-data-periode':
					include "../pages/referensi/periode/form-view-data-periode.php";
					break;
				case 'form-edit-data-periode':
					include "../pages/referensi/periode/form-edit-data-periode.php";
					break;
				case 'edit-data-periode':
					include "../pages/referensi/periode/edit-data-periode.php";
					break;
				case 'edit-perta':
					include "../pages/referensi/periode/edit-perta.php";
					break;
				case 'form-master-data-periode':
					include "../pages/referensi/periode/form-master-data-periode.php";
					break;
				case 'master-data-periode':
					include "../pages/referensi/periode/master-data-periode.php";
					break;
				case 'delete-data-periode':
					include "../pages/referensi/periode/delete-data-periode.php";
					break;

					/*KELAS MHS AKTIF*/
				case 'form-view-data-kelas':
					include "../pages/referensi/kelas/form-view-data-kelas.php";
					break;
				case 'form-edit-data-kelas':
					include "../pages/referensi/kelas/form-edit-data-kelas.php";
					break;
				case 'edit-data-kelas':
					include "../pages/referensi/kelas/edit-data-kelas.php";
					break;
				case 'form-master-data-kelas':
					include "../pages/referensi/kelas/form-master-data-kelas.php";
					break;
				case 'master-data-kelas':
					include "../pages/referensi/kelas/master-data-kelas.php";
					break;
				case 'delete-data-kelas':
					include "../pages/referensi/kelas/delete-data-kelas.php";
					break;
				case 'deleteall-data-kelas':
					include "../pages/referensi/kelas/deleteall-data-kelas.php";
					break;

					/*PENUGASAN DOSEN*/
				case 'form-view-data-penugasan':
					include "../pages/referensi/penugasan/form-view-data-penugasan.php";
					break;
				case 'form-edit-data-penugasan':
					include "../pages/referensi/penugasan/form-edit-data-penugasan.php";
					break;
				case 'edit-data-penugasan':
					include "../pages/referensi/penugasan/edit-data-penugasan.php";
					break;
				case 'form-master-data-penugasan':
					include "../pages/referensi/penugasan/form-master-data-penugasan.php";
					break;
				case 'master-data-penugasan':
					include "../pages/referensi/penugasan/master-data-penugasan.php";
					break;
				case 'delete-data-penugasan':
					include "../pages/referensi/penugasan/delete-data-penugasan.php";
					break;
				case 'deleteall-data-penugasan':
					include "../pages/referensi/penugasan/deleteall-data-penugasan.php";
					break;

					/*QUESIONER EDOM*/
				case 'frame-edom':
					include "../pages/isiquesioner/frame-edom.php";
					break;
				case 'frame-epom':
					include "../pages/isiquesioner/frame-epom.php";
					break;
				case 'frame-epod':
					include "../pages/isiquesioner/frame-epod.php";
					break;
				case 'frame-edop':
					include "../pages/isiquesioner/frame-edop.php";
					break;
				case 'resume-edom':
					include "../pages/isiquesioner/resume-edom.php";
					break;
				case 'resume-epom':
					include "../pages/isiquesioner/resume-epom.php";
					break;
				case 'resume-epod':
					include "../pages/isiquesioner/resume-epod.php";
					break;
				case 'resume-edop':
					include "../pages/isiquesioner/resume-edop.php";
					break;

					// SURVEI
				case 'frame-survei':
					include "../pages/isisurvei/frame-survei.php";
					break;

					/*GENERATE POTENSI EDOM EPOM*/
				case 'form-view-generate-edom':
					include "../pages/potensi/edom/form-view-generate-edom.php";
					break;
				case 'form-master-generate-edom':
					include "../pages/potensi/edom/form-master-generate-edom.php";
					break;
				case 'master-generate-edom':
					include "../pages/potensi/edom/master-generate-edom.php";
					break;
				case 'delete-generate-edom':
					include "../pages/potensi/edom/delete-generate-edom.php";
					break;

					/*GENERATE POTENSI EPOD EDOP*/
				case 'form-view-generate-epod':
					include "../pages/potensi/epod/form-view-generate-epod.php";
					break;
				case 'form-master-generate-epod':
					include "../pages/potensi/epod/form-master-generate-epod.php";
					break;
				case 'master-generate-epod':
					include "../pages/potensi/epod/master-generate-epod.php";
					break;
				case 'delete-generate-epod':
					include "../pages/potensi/epod/delete-generate-epod.php";
					break;

					/*MONITORING*/
				case 'view-data-potensi':
					include "../pages/monitoring/edom/view-data-potensi.php";
					break;
				case 'view-data-rekapitulasi':
					include "../pages/monitoring/edom/view-data-rekapitulasi.php";
					break;
				case 'report01-edom':
					include "../pages/monitoring/edom/report01-edom.php";
					break;
				case 'report02-edom':
					include "../pages/monitoring/edom/report02-edom.php";
					break;
				case 'report03-edom':
					include "../pages/monitoring/edom/report03-edom.php";
					break;
				case 'report04-edom':
					include "../pages/monitoring/edom/report04-edom.php";
					break;
				case 'report05-edom':
					include "../pages/monitoring/edom/report05-edom.php";
					break;

				case 'view-data-potensi-epom':
					include "../pages/monitoring/epom/view-data-potensi-epom.php";
					break;
				case 'view-data-rekapitulasi-epom':
					include "../pages/monitoring/epom/view-data-rekapitulasi-epom.php";
					break;
				case 'report01-epom':
					include "../pages/monitoring/epom/report01-epom.php";
					break;
				case 'report02-epom':
					include "../pages/monitoring/epom/report02-epom.php";
					break;
				case 'report03-epom':
					include "../pages/monitoring/epom/report03-epom.php";
					break;
				case 'report04-epom':
					include "../pages/monitoring/epom/report04-epom.php";
					break;
				case 'report05-epom':
					include "../pages/monitoring/epom/report05-epom.php";
					break;

				case 'view-data-potensi-epod':
					include "../pages/monitoring/epod/view-data-potensi-epod.php";
					break;
				case 'report01-epod':
					include "../pages/monitoring/epod/report01-epod.php";
					break;
				case 'report02-epod':
					include "../pages/monitoring/epod/report02-epod.php";
					break;
				case 'view-daftar-nilai-epod':
					include "../pages/monitoring/epod/view-daftar-nilai-epod.php";
					break;
				case 'view-rekapitulasi-epod':
					include "../pages/monitoring/epod/view-rekapitulasi-epod.php";
					break;

				case 'view-data-potensi-edop':
					include "../pages/monitoring/edop/view-data-potensi-edop.php";
					break;
				case 'report01-edop':
					include "../pages/monitoring/edop/report01-edop.php";
					break;
				case 'report02-edop':
					include "../pages/monitoring/edop/report02-edop.php";
					break;
				case 'report03-edop':
					include "../pages/monitoring/edop/report03-edop.php";
					break;
				case 'report04-edop':
					include "../pages/monitoring/edop/report04-edop.php";
					break;
				case 'view-rekapitulasi-edop':
					include "../pages/monitoring/edop/view-rekapitulasi-edop.php";
					break;


				case 'generate-all':
					include "../pages/generateall/generate-all.php";
					break;

					// ES GRAFIK
				case 'es-grafik':
					include "../pages/es/es-grafik.php";
					break;
				case 'es-edom':
					include "../pages/es/es-edom.php";
					break;
				case 'es-epom':
					include "../pages/es/es-epom.php";
					break;
				case 'es-edop':
					include "../pages/es/es-edop.php";
					break;
				case 'es-epod':
					include "../pages/es/es-epod.php";
					break;

				case 'form-view-data-user':
					include "../pages/user/form-view-data-user.php";
					break;
				case 'form-master-data-user':
					include "../pages/user/form-master-data-user.php";
					break;
				case 'master-data-user':
					include "../pages/user/master-data-user.php";
					break;
				case 'form-edit-data-user':
					include "../pages/user/form-edit-data-user.php";
					break;
				case 'edit-data-user':
					include "../pages/user/edit-data-user.php";
					break;
				case 'delete-data-user':
					include "../pages/user/delete-data-user.php";
					break;
				case 'reset-password':
					include "../pages/user/reset-password.php";
					break;


				case 'reset-passwordpeg':
					include "../pages/responden/reset-passwordpeg.php";
					break;
				case 'view-data-responden':
					include "../pages/responden/view-data-responden.php";
					break;
				case 'verifikasi-data-responden':
					include "../pages/responden/verifikasi-data-responden.php";
					break;

					/* BANNER */
				case 'form-view-data-banner':
					include "../pages/banner/form-view-data-banner.php";
					break;
				case 'form-master-data-banner':
					include "../pages/banner/form-master-data-banner.php";
					break;
				case 'master-data-banner':
					include "../pages/banner/master-data-banner.php";
					break;
				case 'form-edit-data-banner':
					include "../pages/banner/form-edit-data-banner.php";
					break;
				case 'edit-data-banner':
					include "../pages/banner/edit-data-banner.php";
					break;
				case 'delete-data-banner':
					include "../pages/banner/delete-data-banner.php";
					break;

				case 'backup-data':
					include "../pages/backup/backup-data.php";
					break;

				case 'form-ganti-password':
					include "../pages/form-ganti-password.php";
					break;
				case 'ganti-password':
					include "../pages/ganti-password.php";
					break;

				case 'form-ganti-foto':
					include "../pages/form-ganti-foto.php";
					break;
				case 'ganti-foto':
					include "../pages/ganti-foto.php";
					break;

				case 'direct-search':
					include "../pages/direct-search.php";
					break;

				default:
					if ($_SESSION['hak_akses'] == 'Admin' || $_SESSION['hak_akses'] == 'Manajemen') {
						include '../pages/dashboard.php';
					} else if ($_SESSION['hak_akses'] == 'Prodi') {
						include "../pages/isiquesioner/resume-epom.php";
					} else if ($_SESSION['hak_akses'] == 'Dosen') {
						include "../pages/isiquesioner/resume-edom.php";
					} else if ($_SESSION['hak_akses'] == 'Mahasiswa') {
						include "../pages/isiquesioner/frame-edom.php";
					} else if ($_SESSION['hak_akses'] == 'Operator') {
						include "../pages/banner/form-view-data-banner.php";
					}
			}
			?>
		</div>
		<!-- end #content -->
		<!-- begin #footer -->
		<div id="footer" class="footer">
			&copy;2021-<?= date('Y') ?> <a href="#"><?= $_SESSION['unit'] ?> | <a href="#"><?= $_SESSION['nama_pt'] ?></a> - All Rights Reserved
		</div>
		<!-- end #footer -->

		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-primary btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="../assets/plugins/jquery/jquery-1.9.1.min.js"></script>
	<script src="../assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
	<script src="../assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
	<script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!--[if lt IE 9]>
		<script src="assets/crossbrowserjs/html5shiv.js"></script>
		<script src="assets/crossbrowserjs/respond.min.js"></script>
		<script src="assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="../assets/plugins/jquery-cookie/jquery.cookie.js"></script>
	<!-- ================== END BASE JS ================== -->

	<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="../assets/plugins/gritter/js/jquery.gritter.js"></script>
	<script src="../assets/plugins/flot/jquery.flot.min.js"></script>
	<script src="../assets/plugins/flot/jquery.flot.time.min.js"></script>
	<script src="../assets/plugins/flot/jquery.flot.resize.min.js"></script>
	<script src="../assets/plugins/flot/jquery.flot.pie.min.js"></script>
	<script src="../assets/plugins/sparkline/jquery.sparkline.js"></script>
	<script src="../assets/plugins/jquery-jvectormap/jquery-jvectormap.min.js"></script>
	<script src="../assets/plugins/jquery-jvectormap/jquery-jvectormap-world-mill-en.js"></script>
	<script src="../assets/plugins/DataTables/media/js/jquery.dataTables.js"></script>
	<script src="../assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
	<script src="../assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
	<script src="../assets/js/table-manage-responsive.demo.min.js"></script>

	<script src="../assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="../assets/plugins/ionRangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>
	<script src="../assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
	<script src="../assets/plugins/masked-input/masked-input.min.js"></script>
	<script src="../assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
	<script src="../assets/plugins/password-indicator/js/password-indicator.js"></script>
	<script src="../assets/plugins/bootstrap-combobox/js/bootstrap-combobox.js"></script>
	<script src="../assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
	<script src="../assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
	<script src="../assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.js"></script>
	<script src="../assets/plugins/jquery-tag-it/js/tag-it.min.js"></script>
	<script src="../assets/plugins/bootstrap-daterangepicker/moment.js"></script>
	<script src="../assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
	<!-- <script src="../assets/plugins/select2/dist/js/select2.min.js"></script> -->
	<script src="../assets/plugins/bootstrap-eonasdan-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
	<script src="../assets/plugins/bootstrap-show-password/bootstrap-show-password.js"></script>
	<script src="../assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
	<script src="../assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.js"></script>
	<script src="../assets/plugins/clipboard/clipboard.min.js"></script>
	<script src="../assets/js/form-plugins.demo.min.js"></script>
	<script src="../assets/js/dashboard.min.js"></script>
	<script src="../assets/js/apps.min.js"></script>
	<script src="../assets/plugins/wysihtml5/dist/bootstrap3-wysihtml5.all.min.js"></script>
	<script src="../assets/plugins/highcharts/js/highcharts.js"></script>
	<script src="../assets/plugins/highcharts/js/modules/exporting.js"></script>
	<!-- ==== Tedsh script === -->
	<!-- ================== END PAGE LEVEL JS ================== -->

	<script>
		$(document).ready(function() {
			App.init();
			TableManageResponsive.init();
			FormPlugins.init();

			$('#custom1').dataTable({
				"searching": false,
				"lengthChange": false
			});

			$('table.data-table').dataTable();
		});

		$('.select2').select2();

		$('#pesaneditor').wysihtml5({
			"font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
			"emphasis": true, //Italics, bold, etc. Default true
			"lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
			"html": false, //Button which allows you to edit the generated HTML. Default false
			"link": false, //Button to insert a link. Default true
			"image": false, //Button to insert an image. Default true,
			"color": false, //Button to change color of font  
			"blockquote": false
		});
	</script>
</body>

</html>