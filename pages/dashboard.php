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
<h1 class="page-header">Dashboard <small>Overview &amp; statistic</small></h1>
<!-- end page-header -->

<?php
include "../config/koneksi.php";

$queryPotEdom = mysqli_query($Open, "SELECT nim FROM edompotensi");
$potEdom = mysqli_num_rows($queryPotEdom);
$queryIsiEdom = mysqli_query($Open, "SELECT * FROM edompotensi WHERE done=1 ");
$isiEdom = mysqli_num_rows($queryIsiEdom);

$queryPotEpom = mysqli_query($Open, "SELECT nim FROM epompotensi");
$potEpom = mysqli_num_rows($queryPotEpom);
$queryIsiEpom = mysqli_query($Open, "SELECT * FROM epompotensi WHERE done=1");
$isiEpom = mysqli_num_rows($queryIsiEpom);

$queryPotEdop = mysqli_query($Open, "SELECT kedop FROM exoxpotensi");
$potEdop = mysqli_num_rows($queryPotEdop);
$queryIsiEdop = mysqli_query($Open, "SELECT * FROM exoxpotensi WHERE done_d=1 ");
$isiEdop = mysqli_num_rows($queryIsiEdop);

$queryPotEpod = mysqli_query($Open, "SELECT kodedp FROM exoxpotensi GROUP BY kodedp");
$potEpod = mysqli_num_rows($queryPotEpod);
$queryIsiEpod = mysqli_query($Open, "SELECT * FROM exoxpotensi WHERE done_p=1 GROUP BY kodedp");
$isiEpod = mysqli_num_rows($queryIsiEpod);
?>
<style type="text/css">
	.progress {
		text-align: center;
	}

	.progress-value {
		position: absolute;
		right: 0;
		left: 0;
		top: 1px;
	}
</style>
<div class="row">
	<!-- begin col-3 -->
	<div class="col-md-3 col-sm-6">
		<div class="widget widget-stats bg-white text-inverse">
			<div class="stats-icon stats-icon-lg stats-icon-square bg-gradient-red"><i class="ion-ios-paper"></i></div>
			<div class="stats-title">EDOM POTENSI</div>
			<div class="stats-number">
				<?= $potEdom ?>
			</div>
			<div class="stats-progress progress">
				<div class="progress-bar" style="width: 90%;"></div>
			</div>
			<div class="stats-desc">Mengisi : <?= $isiEdom; ?></div>
		</div>
	</div>
	<!-- end col-3 -->
	<!-- begin col-3 -->
	<div class="col-md-3 col-sm-6">
		<div class="widget widget-stats bg-white text-inverse">
			<div class="stats-icon stats-icon-lg stats-icon-square bg-gradient-orange"><i class="ion-ios-paper"></i></div>
			<div class="stats-title">EPOM POTENSI</div>
			<div class="stats-number">
				<?= $potEpom ?>
			</div>
			<div class="stats-progress progress">
				<div class="progress-bar" style="width: 90%;"></div>
			</div>
			<div class="stats-desc">Mengisi : <?= $isiEpom; ?></div>
		</div>
	</div>
	<!-- end col-3 -->
	<!-- begin col-3 -->
	<div class="col-md-3 col-sm-6">
		<div class="widget widget-stats bg-white text-inverse">
			<div class="stats-icon stats-icon-lg stats-icon-square bg-gradient-green"><i class="ion-ios-paper"></i></div>
			<div class="stats-title">EPOD POTENSI</div>
			<div class="stats-number">
				<?= $potEpod ?>
			</div>
			<div class="stats-progress progress">
				<div class="progress-bar" style="width: 90%;"></div>
			</div>
			<div class="stats-desc">Mengisi : <?= $isiEpod; ?></div>
		</div>
	</div>
	<!-- end col-3 -->
	<!-- begin col-3 -->
	<div class="col-md-3 col-sm-6">
		<div class="widget widget-stats bg-white text-inverse">
			<div class="stats-icon stats-icon-lg stats-icon-square bg-gradient-orange"><i class="ion-ios-paper"></i></div>
			<div class="stats-title">EDOP POTENSI</div>
			<div class="stats-number">
				<?= $potEdop ?>
			</div>
			<div class="stats-progress progress">
				<div class="progress-bar" style="width: 90%;"></div>
			</div>
			<div class="stats-desc">Mengisi : <?= $isiEdop; ?></div>
		</div>
	</div>
	<!-- end col-3 -->
</div>
<!-- end row -->
<div class="row">
	<!-- begin col-12 -->
	<div class="col-md-12">
		<div class="panel panel-inverse" data-sortable-id="index-1">
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
				</div>
				<h4 class="panel-title"><i class="ion-stats-bars fa-lg text-warning"></i> &nbsp;Progres EDOM</h4>
			</div>
			<div class="panel-body">
				<table id="table-edom" class="data-table table table-striped table-bordered nowrap" width="100%">
					<thead>
						<tr>
							<th style="text-align:center">NO</th>
							<th style="text-align:center">NIM</th>
							<th style="text-align:center">KMK</th>
							<th style="text-align:center">K.DOSEN</th>
							<th style="text-align:center">KELAS</th>
							<th style="text-align:center">PRODI</th>
							<th style="text-align:center">STATUS</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$nou = 0;
						$isi = 0;
						$hasil = mysqli_query($Open, "select nim,kodemk,kodedosen,kelas,idprogstudi,done from edompotensi");
						while ($data = mysqli_fetch_array($hasil)) { ?>
							<?php $nou = $nou + 1 ?>
							<tr>
								<td align=left>
									<?php echo $nou ?></span>
								</td>
								<td align=center>
									<?php echo $data['nim'] ?></span>
								</td>
								<td align=center>
									<?php echo strtoupper($data['kodemk']) ?></span>
								</td>
								<td align=center>
									<?php echo strtoupper($data['kodedosen']) ?></span>
								</td>
								<td align=center>
									<?php echo strtoupper($data['kelas']) ?></span>
								</td>
								<td align=center>
									<?php echo strtoupper($data['idprogstudi']) ?></span>
								</td>
								<td align=center>
									<?php if ($data['done'] > 0) { ?>
										<span class="style20"><?php echo "-ok-" ?></span>
										<?php $isi = $isi + 1 ?>
									<?php
									}
									?>
								</td>
							</tr>
						<?php
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<!-- end col-12 -->
</div>

<div class="row">
	<!-- begin col-12 -->
	<div class="col-md-12">
		<div class="panel panel-inverse" data-sortable-id="index-1">
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
				</div>
				<h4 class="panel-title"><i class="ion-stats-bars fa-lg text-warning"></i> &nbsp;Progres EPOM</h4>
			</div>
			<div class="panel-body">
				<table id="table-epom" class="data-table table table-striped table-bordered nowrap" width="100%">
					<thead>
						<tr>
							<th style="text-align:center">NO</th>
							<th style="text-align:center">NIM</th>
							<th style="text-align:center">KELAS</th>
							<th style="text-align:center">PRODI</th>
							<th style="text-align:center">STATUS</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$nou = 0;
						$isi = 0;
						$hasil = mysqli_query($Open, "select nim,kelas_id,idprogstudi,komentar,spote,done from epompotensi");
						while ($data = mysqli_fetch_array($hasil)) { ?>
							<?php $nou = $nou + 1 ?>
							<tr>
								<td align=left>
									<?php echo $nou ?></span>
								</td>

								<td align=center>
									<?php echo $data['nim'] ?></span>
								</td>

								<td align=center>
									<?php echo strtoupper($data['kelas_id']) ?></span>
								</td>

								<td align=center>
									<?php echo strtoupper($data['idprogstudi']) ?></span>
								</td>

								<td align=center>
									<?php if ($data['done'] > 0) { ?>
										<span class="style20"><?php echo "-ok-" ?></span>
									<?php
										$isi = $isi + 1;
									}
									?>
								</td>
							</tr>
						<?php
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<!-- end col-12 -->
</div>
<!-- eof row epom-->

<div class="row">
	<!-- begin col-12 -->
	<div class="col-md-12">
		<div class="panel panel-inverse" data-sortable-id="index-1">
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
				</div>
				<h4 class="panel-title"><i class="ion-stats-bars fa-lg text-warning"></i> &nbsp;Progres EPOD</h4>
			</div>
			<div class="panel-body">
				<table id="table-epod" class="data-table table table-striped table-bordered nowrap" width="100%">
					<thead>
						<tr>
							<th style="text-align:center">NO</th>
							<th style="text-align:center">DOSEN</th>
							<th style="text-align:center">PRODI</th>
							<th style="text-align:center">PENGISIAN</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$nou = 0;
						$isi = 0;
						$hasil = mysqli_query($Open, "select exoxpotensi.kodedosen, exoxpotensi.idprogstudi, count(exoxpotensi.kodedosen) as potensi,  count(epoddata.id_potensi)/10 as diisi from exoxpotensi left join epoddata on exoxpotensi.id = epoddata.id_potensi group by exoxpotensi.kodedosen,exoxpotensi.idprogstudi");
						while ($data = mysqli_fetch_array($hasil)) { ?>
							<?php $nou = $nou + 1 ?>
							<tr>
								<td align=left>
									<?php echo $nou ?></span>
								</td>
								<td align=center>
									<?php echo $data['kodedosen'] ?></span>
								</td>
								<td align=center>
									<?php echo strtoupper($data['idprogstudi']) ?></span>
								</td>
								<td align=center>
									<?php if ($data['diisi'] > 0) { ?>
										<span class="style20"><?php echo "-ok-" ?></span>
										<?php $isi = $isi + 1 ?>
									<?php
									}
									?>
								</td>
							</tr>
						<?php
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<!-- end col-12 -->
</div>
<!-- eof row epod -->

<div class="row">
	<!-- begin col-12 -->
	<div class="col-md-12">
		<div class="panel panel-inverse" data-sortable-id="index-1">
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
				</div>
				<h4 class="panel-title"><i class="ion-stats-bars fa-lg text-warning"></i> &nbsp;Progres EDOP</h4>
			</div>
			<div class="panel-body">
				<table id="table-epod" class="data-table table table-striped table-bordered nowrap" width="100%">
					<thead>
						<tr>
							<th style="text-align:center">NO</th>
							<th style="text-align:center">PRODI</th>
							<th style="text-align:center">DOSEN</th>
							<th style="text-align:center">MATAKULIAH</th>
							<th style="text-align:center">STATUS</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$nou = 0;
						$isi = 0;
						$hasil = mysqli_query($Open, "select idprogstudi, kodedosen, kodemk, namadosen, namamk, komentar_d, spote_d from exoxpotensi order by kodedosen");
						while ($data = mysqli_fetch_array($hasil)) { ?>
							<?php $nou = $nou + 1 ?>
							<tr>
								<td align=left>
									<?php echo $nou ?></span>
								</td>
								<td align=center>
									<?php echo strtoupper($data['idprogstudi']) ?></span>
								</td>
								<td align=center>
									<?php echo strtoupper($data['kodedosen']) ?></span>
								</td>
								<td align=center>
									<?php echo strtoupper($data['kodemk']) ?></span>
								</td>
								<td align=center>
									<?php if ($data['spote_d'] > 0) { ?>
										<span class="style20"><?php echo "-ok-" ?></span>
										<?php $isi = $isi + 1 ?>
									<?php
									}
									?>
								</td>
							</tr>
						<?php
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<!-- end col-12 -->
</div>
<script src="../assets/plugins/highcharts/js/highcharts.js"></script>
<script src="../assets/plugins/highcharts/js/modules/data.js"></script>

<script>
	$(document).ready(function() {
		$('table.data-table').dataTable();

		setTimeout(function() {
			$(".pesan").fadeIn('slow');
		}, 500);
	});
	setTimeout(function() {
		$(".pesan").fadeOut('slow');
	}, 7000);
</script>