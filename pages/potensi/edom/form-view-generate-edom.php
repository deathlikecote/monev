<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
	<li>
		<?php
		if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
			echo "<span class='pesan'><div class='btn btn-sm btn-inverse m-b-10'><i class='fa fa-bell text-warning'></i>&nbsp; " . $_SESSION['pesan'] . " &nbsp; &nbsp; &nbsp;</div></span>";
		}

		$cekRow	= mysqli_query($Open, "SELECT * FROM t_penugasan WHERE perta = '" . $_SESSION['perta'] . "'");
		$row = mysqli_num_rows($cekRow);


		$wheres = '1';
		$cKodeprodi = '';
		$ckelas = '';
		$_SESSION['pesan'] = "";

		if (isset($_POST['perta'])) {
			$pertax = $_POST['perta'];
		} else {
			$pertax = $_SESSION['perta'];
		}

		$wheres .= " AND ta ='" . $pertax . "'";

		if (isset($_POST['kdprodi'])) {
			if (!empty($_POST['kdprodi'])) {
				$cKodeprodi = $_POST['kdprodi'];
				$wheres .= " AND idprogstudi ='" . $_POST['kdprodi'] . "'";
			}
		}

		if (isset($_POST['kelas'])) {
			if (!empty($_POST['kelas'])) {
				$ckelas = $_POST['kelas'];
				$wheres .= " AND kelas ='" . $_POST['kelas'] . "'";
			}
		}
		?>
	</li>
	<?php
	if ($row > 0) {
	?>
		<li>
			<a href="potensi/edom/export-generate-edom.php" class="btn btn-sm btn-success m-b-10"><i class="fa fa-file"></i> &nbsp;Export</a>
		</li>

		<li><a href="index.php?page=form-master-generate-edom" class="btn btn-sm btn-primary m-b-10"><i class="fa fa-plus-circle"></i> &nbsp;Add</a></li>
	<?php
	}
	?>
</ol>

<!-- Modal DellAll -->
<div id="deleteall" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><span class="label label-inverse"> # Delete</span> &nbsp; Anda yakin ?</h5>
			</div>
			<div class="modal-body" align="center">
				<a href="index.php?page=deleteall-generate-edom&perta=<?= $pertax ?>" class="btn btn-danger">&nbsp; &nbsp;YES&nbsp; &nbsp;</a>
			</div>
			<div class="modal-footer">
				<a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Cancel</a>
			</div>
		</div>
	</div>
</div>

<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Generate <small>EDOM & EPOM&nbsp;</small></h1>
<!-- end page-header -->
<?php

include "../config/koneksi.php";
$tampilUsr	= mysqli_query($Open, "SELECT a.*, b.nama FROM edompotensi a, m_siswa b WHERE $wheres AND (b.nim = a.nim) GROUP BY a.ta, a.per, a.utsuas, a.nim, a.idprogstudi, a.kelas ORDER BY a.ta, a.per, a.utsuas, a.nim, a.kodemk, a.idprogstudi, a.kelas asc");
?>
<!-- begin row -->
<div class="row">
	<!-- begin col-12 -->
	<div class="col-md-12">
		<!-- begin panel -->
		<div class="panel panel-inverse">
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
				</div>
				<h4 class="panel-title">Results <span class="text-info"><?php echo mysqli_num_rows($tampilUsr); ?></span> rows for "Data Generate EDOM & EPOM"</h4>
			</div>
			<div class="alert alert-success fade in">
				<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
				<i class="fa fa-info fa-2x pull-left"></i> Gunakan button di sebelah kanan setiap baris tabel untuk menuju instruksi edit dan hapus ...
			</div>
			<div class="panel-body">
				<?php
				if ($row < 1) {
					echo "Silahkan isi terlebih dahulu data Kelas Mhs Aktif dan Penugasan Dosen perta $_SESSION[perta] sebelum melakukan generate potensi
						";
				} else {
				?>
					<div class="row" style="margin-bottom: 30px">
						<div class="col-md-12">
							<?php
							$edom = mysqli_query($Open, "select * from t_generate where perta = '" . $_SESSION['perta'] . "' and generate ='edompotensi'");
							$r_edom = mysqli_fetch_assoc($edom);
							?>
							<div class="col-md-10 text-muted" style="padding: 0;">
								<span class="col-md-6" style="padding: 0;"><b>GENERATE EDOM - <?php echo $_SESSION['perta']; ?></b></span>
								<span class="col-md-6 text-right" id="lastgenerate"><small><i>Last generate : <span id="edom_bar_lastgenerate"><?php echo $r_edom['waktu']; ?></span></i></small></span>
								<hr style="margin: 7px 0 10px 0">
							</div>

							<div class="progress col-md-10" style="padding: 0;margin-bottom: 0">
								<?php
								if ($r_edom['generate'] != '') {
									echo '<div class="progress-bar progress-bar-striped progress-bar-animated" style="width:100%" id="edom_bar" role="progressbar" aria-valuemin="0" aria-valuemax="100">Selesai</div>';
								} else {
									echo '<input type="hidden" name="edomask" id="edomask" value="0">';
									echo '<div class="progress-bar progress-bar-striped progress-bar-animated" id="edom_bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>';
								}
								?>

							</div>
							<div class="form-group">
								<div class="col-md-1" style="">
									<a type="button" name="generateedom" id="generateedom" class="btn btn-warning" style="font-size: 1.2rem;padding: 2px 10px"><i class="fa fa-repeat"></i> &nbsp;Generate</a>
								</div>
							</div>

							<div class="col-md-12 text-muted " style="padding: 0;">
								<small>Total Potensi: <span id="edom_bar_total"><?php echo $r_edom['total']; ?></span> | Berhasil : <span id="edom_bar_ok"><?php echo $r_edom['berhasil']; ?></span> | Duplikat (diabaikan) : <span id="edom_bar_dup"><?php echo $r_edom['duplikat']; ?></span> | Gagal : <span id="edom_bar_no"><?php echo $r_edom['gagal']; ?></span></small>
							</div>
						</div>


						<!-- EPOM -->
						<div class="col-md-12" style="margin-top: 1.6em">
							<?php
							$epom = mysqli_query($Open, "select * from t_generate where perta = '" . $_SESSION['perta'] . "' and generate ='epompotensi'");
							$r_epom = mysqli_fetch_assoc($epom);
							?>
							<div class="col-md-10 text-muted" style="padding: 0;">
								<span class="col-md-6" style="padding: 0;"><b>GENERATE EPOM - <?php echo $_SESSION['perta']; ?></b></span>
								<span class="col-md-6 text-right" id="lastgenerate"><small><i>Last generate : <span id="epom_bar_lastgenerate"><?php echo $r_epom['waktu']; ?></span></i></small></span>
								<hr style="margin: 7px 0 10px 0">
							</div>

							<div class="progress col-md-10" style="padding: 0;margin-bottom: 0">
								<?php
								if ($r_epom['generate'] != '') {
									echo '<div class="progress-bar progress-bar-striped progress-bar-animated" style="width:100%" id="epom_bar" role="progressbar" aria-valuemin="0" aria-valuemax="100">Selesai</div>';
								} else {
									echo '<div class="progress-bar progress-bar-striped progress-bar-animated" id="epom_bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>';
								}
								?>

							</div>

							<div class="col-md-1" style="">
								<a type="button" name="generateepom" id="generateepom" class="btn btn-warning " value="Generate" style="font-size: 1.2rem;padding: 2px 10px"><i class="fa fa-repeat"></i> Generate</a>
							</div>

							<div class="col-md-12 text-muted " style="padding: 0;">
								<small>Total Potensi: <span id="epom_bar_total"><?php echo $r_epom['total']; ?></span> | Berhasil : <span id="epom_bar_ok"><?php echo $r_epom['berhasil']; ?></span> | Duplikat (diabaikan) : <span id="epom_bar_dup"><?php echo $r_epom['duplikat']; ?></span> | Gagal : <span id="epom_bar_no"><?php echo $r_epom['gagal']; ?></span></small>
							</div>
						</div>
					</div> <!-- EOF Generate -->

					<form action="index.php?page=form-view-generate-edom" name="isian" class="form-horizontal" method="POST">
						<div class="form-inline" style="margin-bottom: 20px">
							<div class="form-group">

								<div class="col-md-2 text-left">
									<select id="perta" name="perta" class="form-control">
										<option value="<?= $_SESSION['perta'] ?>" <?php echo ($pertax == $_SESSION['perta']) ? 'selected' : ''; ?>><?= $_SESSION['perta'] ?></option>
										<?php
										$cPerta = mysqli_query($Open, "SELECT TABLE_NAME AS cPerta FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '" . $DB . "' AND (TABLE_NAME like 'edomparameter%' AND LENGTH(TABLE_NAME) > 14)");
										$per = 1;
										$sampaithn = date('Y') + 1;
										while ($rPerta = mysqli_fetch_array($cPerta)) {
											$listPerta = substr($rPerta['cPerta'], 13);
										?>
											<option value="<?= $listPerta ?>" <?php echo ($pertax == $listPerta) ? 'selected' : ''; ?>><?= $listPerta ?></option>
										<?php
										}

										?>
									</select>
								</div>
							</div>

							<div class="form-group">

								<div class="col-md-2 text-left">
									<select id="kdprodi" name="kdprodi" class="form-control" searchable="">
										<option value="">--Pilih Prodi--</option>
										<?php
										$a = 0;
										$t = mysqli_query($Open, "SELECT * FROM m_prodi ORDER BY kodeprodi ASC");
										while ($tak = mysqli_fetch_array($t)) {
										?>
											<option value="<?= $tak['kodeprodi'] ?>" <?php echo ($cKodeprodi == $tak['kodeprodi']) ? 'selected' : ''; ?>><?= $tak['kodeprodi'] ?></option>";

										<?php } ?>
									</select>
								</div>
							</div>

							<div class="form-group">

								<div class="col-md-2 text-left">
									<select id="kelas" name="kelas" class="form-control" searchable="">
										<option value="">--Pilih Kelas--</option>
										<?php
										$a = 0;
										$t = mysqli_query($Open, "SELECT DISTINCT(kelas) FROM t_kelas ORDER BY kelas ASC");
										while ($tak = mysqli_fetch_array($t)) {
										?>
											<option value="<?= $tak['kelas'] ?>" <?php echo ($ckelas == $tak['kelas']) ? 'selected' : ''; ?>><?= $tak['kelas'] ?></option>";
										<?php
										}
										?>
									</select>
								</div>
							</div>
						</div>


					</form>

					<table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
						<thead>
							<tr>
								<th align=center>No</th>
								<th align=center>Perta</th>
								<th align=center></th>
								<th align=center>NIM</th>
								<th align=center>Nama</th>
								<th align=center>Prodi</th>
								<th align=center>Kls</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 0;
							while ($usr = mysqli_fetch_array($tampilUsr)) {
								$no++;
							?>
								<tr>
									<td align=left style="width: 10px">
										<?php echo $no; ?>
									</td>

									<td align=center>
										<?php echo strtoupper($usr['ta']); ?>
									</td>

									<td align=left>
										<?php echo strtoupper($usr['utsuas']); ?>
									</td>

									<td align=left>
										<?php echo strtoupper($usr['nim']); ?>
									</td>

									<td align=left>
										<?php echo strtoupper($usr['nama']); ?>
									</td>

									<td align=left>
										<?php echo strtoupper($usr['idprogstudi']); ?>
									</td>

									<td align=left>
										<?php echo strtoupper($usr['kelas']); ?>
									</td>
									<td class="text-center">
										<!-- <a type="button" class="btn btn-info btn-icon btn-sm" href="index.php?page=form-edit-generate-edom&id=<?= $usr['id'] ?>" title="edit"><i class="fa fa-pencil fa-lg"></i></a> -->

										<a type="button" class="btn btn-danger btn-icon btn-sm" data-toggle="modal" data-target="#Del<?php echo $usr['id'] ?>" title="delete"><i class="fa fa-trash-o fa-lg"></i></a>
									</td>
								</tr>
								<!-- #modal-dialog -->
								<div id="Del<?php echo $usr['id'] ?>" class="modal fade" role="dialog">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title"><span class="label label-inverse"> # Delete</span> &nbsp; Anda yakin?</h5>
											</div>
											<div class="modal-body" align="center">
												<a href="index.php?page=delete-generate-edom&perta=<?= $usr['ta'] ?>&nim=<?= $usr['nim'] ?>" class="btn btn-danger">&nbsp; &nbsp;YES&nbsp; &nbsp;</a>
											</div>
											<div class="modal-footer">
												<a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Cancel</a>
											</div>
										</div>
									</div>
								</div>
							<?php
							}
							?>
						</tbody>
					</table>

				<?php } ?>
			</div>
		</div>
		<!-- end panel -->
	</div>
	<!-- end col-10 -->
</div>
<iframe id="loadarea" style="display:none;"></iframe><br />
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

	$(document).ready(function() {

		$('#perta, #kdprodi, #kelas, #status').change(function() {
			// alert();
			$('form[name="isian"]').submit();
		});

		$("#generateedom").click(function() {

			var edomask = $('#edom_bar_lastgenerate');
			if (edomask.html() != '') {
				if (confirm('Anda sudah melakukan generate sebelumnya. Anda yakin ?')) {
					edomgenerate();
				}
			} else {
				edomgenerate();
			}


			function edomgenerate() {
				document.getElementById("edom_bar_no").innerHTML = "0";
				document.getElementById("edom_bar_ok").innerHTML = "0";
				document.getElementById("edom_bar_total").innerHTML = "0";
				document.getElementById("edom_bar_dup").innerHTML = "0";
				document.getElementById('loadarea').src = 'potensi/edom/generate-edom.php';
			}

		});

		$("#generateepom").click(function() {

			var epomask = $('#epom_bar_lastgenerate');
			if (epomask.html() != '') {
				if (confirm('Anda sudah melakukan generate sebelumnya. Anda yakin ?')) {
					epomgenerate();
				}
			} else {
				epomgenerate();
			}

			function epomgenerate() {
				document.getElementById("epom_bar_no").innerHTML = "0";
				document.getElementById("epom_bar_ok").innerHTML = "0";
				document.getElementById("epom_bar_total").innerHTML = "0";
				document.getElementById("epom_bar_dup").innerHTML = "0";
				document.getElementById('loadarea').src = 'potensi/edom/generate-epom.php';
			}

		});

	})


	function validateForm() {

		function hasExtension(inputID, exts) {
			var fileName = document.getElementById(inputID).value;
			return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(fileName);
		}

		if (!hasExtension('import', ['.xlsx'])) {
			alert("Hanya file excel yang diijinkan.");
			return false;
		}
	}
</script>