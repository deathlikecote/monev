<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
	<li>
		<?php
			if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
				echo "<span class='pesan'><div class='btn btn-sm btn-inverse m-b-10'><i class='fa fa-bell text-warning'></i>&nbsp; ".$_SESSION['pesan']." &nbsp; &nbsp; &nbsp;</div></span>";
			}
			$_SESSION['pesan'] ="";
		?>
	</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Data <small>Profil&nbsp;</small></h1>
<!-- end page-header -->
<?php
	include "../config/koneksi.php";
	$tampilUsr	=mysqli_query($Open,"SELECT * FROM m_profil");
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
				<h4 class="panel-title">Results <span class="text-info"><?php echo mysqli_num_rows($tampilUsr);?></span> rows for "Data Profil"</h4>
			</div>
            <div class="alert alert-success fade in">
				<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
				<i class="fa fa-info fa-2x pull-left"></i> Gunakan button di sebelah kanan setiap baris tabel untuk menuju instruksi edit ...
			</div>
			<div class="panel-body">
				<table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
					<thead>
						<tr>
							<th>Nama PT</th>
							<th>Alamat</th>
							<th>Logo</th>
							<th>Unit</th>
							<th>Pengelola</th>
							<th>Jabatan</th>
							<th>Logo</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<?php
							$no=0;
							while($usr	=mysqli_fetch_array($tampilUsr)){
							$no++;
						?>
						<tr>
							<td><?php echo $usr['nama']?></td>
							<td><?php echo $usr['alamat'].', '.$usr['kota']?></td>
							<td><img width="35" style="margin: -6px 0 0 -6px" alt="monev" src="../assets/img/<?=$usr['logo']?>"></td>
							<td><?php echo $usr['unit']?></td>
							<td><?php echo $usr['pengelola']?></td>
							<td><?php echo $usr['jabatan']?></td>
							<td><img width="35" style="margin: -6px 0 0 -6px" alt="monev" src="../assets/img/<?=$usr['logo_unit']?>"></td>
							<td class="text-center">
								<a type="button" class="btn btn-info btn-icon btn-sm" href="index.php?page=form-edit-data-profil&id=<?=$usr['id']?>" title="edit"><i class="fa fa-pencil fa-lg"></i></a>
							</td>
						</tr>
						<?php
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
		<!-- end panel -->
	</div>
    <!-- end col-10 -->
</div>
<!-- end row -->
<script> // 500 = 0,5 s
	$(document).ready(function(){setTimeout(function(){$(".pesan").fadeIn('slow');}, 500);});
	setTimeout(function(){$(".pesan").fadeOut('slow');}, 7000);
</script>