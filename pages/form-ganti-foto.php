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
<h1 class="page-header">Foto <small>Ubah <i class="fa fa-user"></i></small></h1>
<!-- end page-header -->
<?php
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	$query   = mysqli_query($Open, "SELECT * FROM m_user WHERE id='$id'");
	$data    = mysqli_fetch_array($query);
} else {
	die("Error. No ID Selected! ");
}
include "../config/koneksi.php";
?>
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
				<h4 class="panel-title">Form ubah foto</h4>
			</div>
			<div class="panel-body">
				<form action="index.php?page=ganti-foto&id=<?= $id ?>" class="form-horizontal" method="POST" enctype="multipart/form-data">
					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-2">
							<?php
							if ($data['avatar'] != '') {
								$imgs = $data['avatar'];
							} else {
								$imgs = 'no-avatar.jpg';
							}
							?>
							<img src="../assets/img/profil/<?= $imgs ?>" width="100">
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Pilih</label>
						<div class="col-md-2">
							<input type="file" name="avatar" id="avatar" value="<?= $data['avatar'] ?>" maxlength="255" class="form-control" />
							<small class="text-warning">Max. 500 Kb</small>
							<input type="hidden" name="avatar_old" value="<?= $data['avatar'] ?>" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-6">
							<button type="submit" name="change" value="change" class="btn btn-primary"><i class="fa fa-edit"></i> &nbsp;Ubah</button>&nbsp;
							<a type="button" class="btn btn-default active" href="./"><i class="ion-arrow-return-left"></i>&nbsp;Cancel</a>
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

	document.forms[0].addEventListener('submit', function(evt) {
		var file = document.getElementById('avatar').files[0];

		if (file && file.size < 500000) { // 500Kb (this size is in bytes)
			//Submit form        
		} else {
			alert('Ukuran max 500kb');
			evt.preventDefault();
		}
	}, false);
</script>