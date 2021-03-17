<?php
ob_start();
session_start();
if(!isset($_SESSION['id_user'])){
    die("<b>Oops!</b> Access Failed.
		<p>Sistem Logout. Anda harus melakukan Login kembali.</p>
		<button type='button' onclick=location.href='../'>Back</button>");
}
if($_SESSION['hak_akses']!="Superadmin" && $_SESSION['hak_akses']!="Pejabat" && $_SESSION['hak_akses']!="Admin"){
    die("<b>Oops!</b> Access Failed.
		<p>Anda Bukan Superadmin.</p>
		<button type='button' onclick=location.href='../'>Back</button>");
}
	include "../config/koneksi.php";
	$tampilUsr	=mysqli_query($Open,"SELECT * FROM tb_user WHERE id_user='$_SESSION[id_user]'");
	$usr		=mysqli_fetch_array($tampilUsr);
	
	$tampilPeg	=mysqli_query($Open,"SELECT * FROM tb_responden");
	$jmlpeg		=mysqli_num_rows($tampilPeg);
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>e-Survei STPB</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="Aplikasi Sistem Informasi Kuisioner Online Berbasis Web" name="description" />
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
	<link rel="stylesheet" type="text/css" href="../assets/plugins/wysihtml5/dist/bootstrap3-wysihtml5.min.css"></link>
	<link href="../assets/plugins/jquery-jvectormap/jquery-jvectormap.css" rel="stylesheet" />
	<link href="../assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
	<link href="../assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet" />
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
	<!-- ================== END PAGE LEVEL STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="../assets/plugins/jquery/jquery-2.1.4.min.js"></script>
	<script src="../assets/plugins/pace/pace.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body>
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
					<a href="./" class="navbar-brand" style="font-size: 8pt"><span class="navbar-logo"><img width="35" style="margin: -6px 0 0 -6px" alt="simpeg" src="../assets/img/logo.png"></span> &nbsp;<b>E-SURVEI STP BANDUNG</b></a>
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
				<!-- end navbar-collapse -->	
				<!-- begin header navigation right -->
				<ul class="nav navbar-nav navbar-right">
					<!-- <li>
						<form action="index.php?page=direct-search" method="POST" enctype="multipart/form-data" class="navbar-form full-width">
							<div class="form-group">
								<input type="text" name="nama" class="form-control" placeholder="Enter name" required/>
								<button type="submit" name="search" value="search" class="btn btn-search"><i class="ion-ios-search-strong"></i></button>
							</div>
						</form>
					</li> -->
					<li class="dropdown navbar-user">
						<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
							<span class="user-image online">
								<?php
									if (empty($usr['avatar']))													
										echo "<img src='../assets/img/no-avatar.jpg' alt='simpeg' />";
										else
										echo "<img src='../assets/img/$usr[avatar]' alt='simpeg' />";
								?>
							</span>
							<span class="hidden-xs"><span class="text-warning">Welcome , </span><?=$usr['nama_user']?></span> <span class="text-warning"><i class="fa fa-caret-down"></i></span>
						</a>
						<ul class="dropdown-menu animated fadeInLeft">
							<li class="arrow"></li>
							<li><a href="index.php?page=form-ganti-password&id_user=<?=$_SESSION['id_user']?>"><i class="ion-ios-locked"></i> &nbsp;Change Password</a></li>
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
										echo "<img src='../assets/img/no-avatar.jpg' alt='simpeg' />";
										else
										echo "<img src='../assets/img/$usr[avatar]' alt='simpeg' />";
								?>
							</a>
						</div>
						<div class="info">
							<?=$usr['nama_user']?>
							<small><?=$usr['hak_akses']?></small>
						</div>
					</li>
				</ul>
				<!-- end sidebar user -->
				<!-- begin sidebar nav -->
				<ul class="nav">
					<li class="nav-header">Navigasi <i class="fa fa-paper-plane m-l-5"></i></li>
					<li><a href="./"><i class="ion-stats-bars bg-blue"></i><span>Dashboard</span> <span class="badge bg-primary pull-right">HOME</span></a></li>
					<li class="has-sub">
						<a href="javascript:;"><b class="caret pull-right"></b><i class="ion-ios-gear bg-purple"></i><span>Master</span></a>
						<ul class="sub-menu">
							<li><a href="index.php?page=form-view-data-responden"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Responden</a></li>
							<li><a href="index.php?page=form-view-data-user"><i class="menu-icon fa fa-caret-right"></i> &nbsp;User Akses</a></li>
						</ul>
					</li>
					<li class="has-sub">
						<a href="javascript:;"><b class="caret pull-right"></b><i class="ion-document-text bg-red"></i><span>Survei</span></a>
						<ul class="sub-menu">
							<li><a href="index.php?page=form-master-data-projek"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Buat Baru</a></li>
							<li><a href="index.php?page=form-view-data-projek"><i class="menu-icon fa fa-caret-right"></i> &nbsp;Semua Survei</a></li>
						</ul>
					</li>
					<!-- <li><a href="index.php?page=form-data-email"><i class="ion-ios-email bg-purple"></i><span>Mail</span></a></li> -->
					<!-- <li><a href="index.php?page=form-data-reminder"><i class="ion-ios-email bg-purple"></i><span>Reminder</span></a></li> -->

					<li><a href="index.php?page=backup-data"><i class="ion-ios-cloud bg-blue"></i><span>Backup Database</span></a></li>
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
				$page = (isset($_GET['page']))? $_GET['page'] : "main";
				switch ($page) {
					
					case 'login-responden': include "../kuisioner/proses/check-login.php"; break;
				
					case 'form-view-data-user': include "../pages/user/form-view-data-user.php"; break;
					case 'form-master-data-user': include "../pages/user/form-master-data-user.php"; break;
					case 'master-data-user': include "../pages/user/master-data-user.php"; break;
					case 'form-edit-data-user': include "../pages/user/form-edit-data-user.php"; break;
					case 'edit-data-user': include "../pages/user/edit-data-user.php"; break;
					case 'delete-data-user': include "../pages/user/delete-data-user.php"; break;
					case 'reset-password': include "../pages/user/reset-password.php"; break;
					

					case 'form-view-data-projek': include "../pages/projek/form-view-data-projek.php"; break;
					case 'form-view-detail-projek': include "../pages/projek/form-view-detail-projek.php"; break;
					case 'edit-lp-projek': include "../pages/projek/edit-lp-projek.php"; break;
					case 'form-master-data-projek': include "../pages/projek/form-master-data-projek.php"; break;
					case 'master-data-projek': include "../pages/projek/master-data-projek.php"; break;

					case 'master-data-kuisioner': include "../pages/projek/master-data-kuisioner.php"; break;

					case 'form-data-email': include "../pages/mailblast/form-data-email.php"; break;

					case 'form-data-reminder': include "../pages/reminder/form-data-reminder.php"; break;
					

					case 'import-data-responden': include "../pages/projek/import-data-responden.php"; break;
					case 'form-edit-data-projek': include "../pages/projek/form-edit-data-projek.php"; break;
					case 'edit-projek': include "../pages/projek/edit-projek.php"; break;
					case 'delete-projek': include "../pages/projek/delete-projek.php"; break;
					case 'master-data-responden': include "../pages/projek/master-data-responden.php"; break;

					case 'form-view-data-responden': include "../pages/responden/form-view-data-responden.php"; break;
					case 'form-master-data-responden': include "../pages/projek/form-master-data-responden.php"; break;

					case 'reset-passwordpeg': include "../pages/responden/reset-passwordpeg.php"; break;
					case 'view-data-responden': include "../pages/responden/view-data-responden.php"; break;
					case 'verifikasi-data-responden': include "../pages/responden/verifikasi-data-responden.php"; break;
					
					case 'backup-data': include "../pages/backup/backup-data.php"; break;
					
					case 'form-ganti-password': include "../pages/form-ganti-password.php"; break;
					case 'ganti-password': include "../pages/ganti-password.php"; break;
					
					case 'direct-search': include "../pages/direct-search.php"; break;
					
					default : include '../pages/dashboard.php';	
				}
			?>
		</div>
		<!-- end #content -->
		<!-- begin #footer -->
		<div id="footer" class="footer">
		    &copy;2020 <a href="#">Pusat Penjaminan Mutu (PPM) | e-Survei STP Bandung</a> - All Rights Reserved
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
    <script src="../assets/plugins/select2/dist/js/select2.min.js"></script>
    <script src="../assets/plugins/bootstrap-eonasdan-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <script src="../assets/plugins/bootstrap-show-password/bootstrap-show-password.js"></script>
    <script src="../assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
    <script src="../assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.js"></script>
    <script src="../assets/plugins/clipboard/clipboard.min.js"></script>
	<script src="../assets/js/form-plugins.demo.min.js"></script>
	<script src="../assets/js/dashboard.min.js"></script>
	<script src="../assets/js/apps.min.js"></script>
	<script src="../assets/plugins/wysihtml5/dist/js/bootstrap3-wysihtml5.min.js"></script>
	<script src="../assets/plugins/wysihtml5/dist/bootstrap3-wysihtml5.all.min.js"></script>
	<!-- ==== Tedsh script === -->
	<script src="../assets/mystyle/js/survei.js" ></script>
	<!-- ================== END PAGE LEVEL JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
			TableManageResponsive.init();
			FormPlugins.init();
		});

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