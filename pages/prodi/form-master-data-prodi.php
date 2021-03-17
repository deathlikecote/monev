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
<h1 class="page-header">Data <small>Prodi <i class="fa fa-angle-right"></i> Insert&nbsp;</small></h1>
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
				<h4 class="panel-title">Form master data prodi</h4>
			</div>
			<div class="panel-body">
				<form action="index.php?page=master-data-prodi" class="form-horizontal" method="POST" enctype="multipart/form-data" >
					<div class="form-group">
		    			<label for="kodeprodi" class="col-md-3 control-label"><font color="red">*&nbsp;</font>Kode PRODI</label>
		    			<div class="col-md-2">
		    				<input type="text" class="form-control" name="kodeprodi" id="kodeprodi" placeholder="" value="">
		    			</div>
		    		</div>

		    		<div class="form-group">
		    			<label for="nama" class="col-md-3 control-label"><font color="red">*&nbsp;</font>Nama Prodi</label>
		    			<div class="col-md-4">
		    				<input type="text" class="form-control" name="namaprodi" id="namaprodi" placeholder="" value="">
		    			</div>
		    		</div>

		    		<div class="form-group">
		    			<label for="jurprodi" class="col-md-3 control-label">Jurusan</label>
		    			<div class="col-md-4">
		    				<input type="text" class="form-control" name="jurprodi" id="jurprodi" placeholder="" value="">
		    			</div>
		    		</div>

		    		<div class="form-group">
		    			<label for="jenprodi" class="col-md-3 control-label"><font color="red">*&nbsp;</font>Jenjang</label>
		    			<div class="col-md-2">
		    				<input type="text" class="form-control" id="jenprodi" name="jenprodi" placeholder="" value="">
		    			</div>
		    		</div>
					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-6">
							<button type="submit" name="save" value="save" class="btn btn-primary"><i class="fa fa-floppy-o"></i> &nbsp;Save</button>&nbsp;
							<a type="button" class="btn btn-default active" href="index.php?page=form-view-data-prodi"><i class="ion-arrow-return-left"></i>&nbsp;Cancel</a>
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
<script> // 500 = 0,5 s
	$(document).ready(function(){setTimeout(function(){$(".pesan").fadeIn('slow');}, 500);});
	setTimeout(function(){$(".pesan").fadeOut('slow');}, 7000);
</script>