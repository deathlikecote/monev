<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
	<li>
		<?php
		if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
			echo "<span class='pesan'><div class='btn btn-sm btn-inverse m-b-10'><i class='fa fa-bell text-warning'></i>&nbsp; " . $_SESSION['pesan'] . " &nbsp; &nbsp; &nbsp;</div></span>";
		}
		$wheres = '1';
		$cKodeprodi = '';
		$ckelas = '';
		$_SESSION['pesan'] = "";

		if (isset($_POST['perta'])) {
			$pertax = $_POST['perta'];
		} else {
			$pertax = $_SESSION['perta'];
		}

		if ($_SESSION['perta'] != $pertax) {
			$tax = $_POST['perta'];
		} else {
			$tax = '';
		}
		?>
	</li>

</ol>


<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">EPOD R.02 <small>Prodi&nbsp;</small></h1>
<!-- end page-header -->
<?php

include "../config/koneksi.php";
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
				<h4 class="panel-title">&nbsp;</h4>
			</div>

			<div class="panel-body">

				<form action="monitoring/epod/epodreport2-pdf.php" name="isian" class="form-horizontal" method="POST">
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
							<div class="col-md-12 text-left tombolPrint">
								<button type="submit" name="caridpmk" class="btn btn-success"><i class="fa fa-print"></i></button>
								</select>
							</div>
						</div>

					</div>


				</form>

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
		cekData();
		$('#perta').change(function() {
			cekData();
		})
	});
	setTimeout(function() {
		$(".pesan").fadeOut('slow');
	}, 7000);



	function cekData() {
		var perta = $('#perta').val();
		$.ajax({
			url: 'monitoring/cek.php',
			type: 'post',
			data: {
				jenis: 'epod',
				pertapost: perta
			},
			success: function(data) {
				if (data == 0) {
					$('.tombolPrint').html(`Data belum tersedia`);
				} else {
					$('.tombolPrint').html(`
					<button type="submit" name="caridpmk" class="btn btn-success"><i class="fa fa-print"></i></button>`);
				}
			}
		})
	}
</script>