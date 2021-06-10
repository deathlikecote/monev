<?php
if (isset($_GET['id'])) {
	$id = $_GET['id'];

	include "../config/koneksi.php";
	$query   = mysqli_query($Open, "SELECT * FROM m_laporan WHERE id='$id'");
	$data    = mysqli_fetch_array($query);
} else {
	die("Error. No ID Selected!");
}
?>
<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
	<li>
		<?php
		if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
			echo "<span class='pesan'><div class='btn btn-sm btn-inverse m-b-10'><i class='fa fa-bell text-warning'></i>&nbsp; " . $_SESSION['pesan'] . " &nbsp; &nbsp; &nbsp;</div></span>";
		}
		$_SESSION['pesan'] = "";
		?>
	</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Data <small>Laporan <i class="fa fa-angle-right"></i> Edit <i class="fa fa-key"></i> id_<?= $id ?></small></h1>
<!-- end page-header -->
<!-- begin row -->
<div class="row">
	<!-- begin col-12 -->
	<div class="col-md-12">
		<!-- begin panel -->
		<div class="panel panel-inverse" data-sortable-id="form-stuff-1">
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
				</div>
				<h4 class="panel-title">Form edit data laporan</h4>
			</div>
			<div class="panel-body">
				<form action="index.php?page=edit-data-laporan&id=<?= $id ?>" class="form-horizontal" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label class="col-md-3 control-label">Judul</label>
						<div class="col-md-6">
							<input type="text" name="judul" value="<?= $data['judul'] ?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Header</label>
						<div class="col-md-6">
							<input type="text" name="header" value="<?= $data['header'] ?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Footer</label>
						<div class="col-md-6">
							<input type="text" name="footer" value="<?= $data['footer'] ?>" class="form-control" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-6">
							<button type="submit" name="edit" value="edit" class="btn btn-primary"><i class="fa fa-save"></i> &nbsp;Simpan</button>&nbsp;
							<a type="button" class="btn btn-default active" href="index.php?page=form-view-data-laporan"><i class="ion-arrow-return-left"></i>&nbsp;Cancel</a>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- end panel -->
	</div>
	<!-- end col-6 -->
</div>
<!-- end row -->
<script>
	// 500 = 0,5 s
	$(document).ready(function() {
		setTimeout(function() {
			$(".pesan").fadeIn('slow');
		}, 500);
	});
	setTimeout(function() {
		$(".pesan").fadeOut('slow');
	}, 7000);
</script>