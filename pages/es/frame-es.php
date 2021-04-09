<!-- begin breadcrumb -->
<style type="text/css">
	div.panel-body {
  position: relative;
  padding-bottom: 56.25%;
  height: 0;
  overflow: hidden;
  max-width: 100%;
}
</style>
<ol class="breadcrumb pull-right">
	<li>
		<?php
			if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
				echo "<span class='pesan'><div class='btn btn-sm btn-inverse m-b-10'><i class='fa fa-bell text-warning'></i>&nbsp; ".$_SESSION['pesan']." &nbsp; &nbsp; &nbsp;</div></span>";
			}
			$_SESSION['pesan'] ="";
			$xxx = md5(date('hyhdhmhyhmhdhhh').$_SESSION['id_user']);
		?>
	</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Executive Summary <small>Evaluasi Dosen Oleh Mahasiswa&nbsp;</small></h1>
<!-- end page-header -->
<?php
	include "../config/koneksi.php";
?>
<!-- begin row -->
<div class="row">
	<!-- begin col-12 -->
    <div class="col-md-12">
			<div class="panel-body">
				<iframe class="embed-responsive-item" src="../pm?nim=<?=$_SESSION['id_user']?>&to=edom"></iframe>
			</div>
	</div>
    <!-- end col-10 -->
</div>
<!-- end row -->
<script> // 500 = 0,5 s
	$(document).ready(function(){setTimeout(function(){$(".pesan").fadeIn('slow');}, 500);});
	setTimeout(function(){$(".pesan").fadeOut('slow');}, 7000);

	
</script>