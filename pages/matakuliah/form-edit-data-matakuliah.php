<?php
	if (isset($_GET['id'])) {
	$id = $_GET['id'];
	
	include "../config/koneksi.php";
	$query   =mysqli_query($Open,"SELECT * FROM m_matakuliah WHERE id='$id'");
	$data    =mysqli_fetch_array($query);
	}
	else {
		die ("Error. No ID Selected!");	
	}
?>
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
<h1 class="page-header">Data <small>Matakuliah <i class="fa fa-angle-right"></i> Edit <i class="fa fa-key"></i> id_<?=$id?></small></h1>
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
				<h4 class="panel-title">Form edit data matakuliah</h4>
			</div>
			<div class="panel-body">
				<form action="index.php?page=edit-data-matakuliah&id=<?=$id?>" class="form-horizontal" method="POST" enctype="multipart/form-data" >

		    		<div class="form-group">
		    			<label for="kodemk" class="col-md-3 control-label"><font color="red">*&nbsp;</font>Kode MK</label>
		    			<div class="col-md-2">
		    				<input type="text" class="form-control" name="kodemk" id="kodemk" placeholder="" value="<?=$data['kodemk']?>">
		    				<input type="hidden" class="form-control" name="kodemk_old" id="kodemk_old"  value="<?=$data['kodemk']?>">
		    			</div>
		    		</div>

		    		<div class="form-group">
		    			<label for="namamk" class="col-md-3 control-label"><font color="red">*&nbsp;</font>Nama</label>
		    			<div class="col-md-4">
		    				<input type="text" class="form-control" name="namamk" id="namamk" placeholder="" value="<?=$data['namamk']?>">
		    			</div>
		    		</div>

		            <div class="form-group">
		                <label for="namemk" class="col-md-3 control-label">Nama Eng</label>
		                <div class="col-md-4">
		                    <input type="text" class="form-control" name="namemk" id="namemk" placeholder="" value="<?=$data['namemk']?>">
		                </div>
		            </div>

		            <div class="form-group">
		                <label for="skst" class="col-md-3 control-label"><font color="red">*&nbsp;</font>SKS Teori</label>
		                <div class="col-md-1">
		                    <input type="text" class="form-control" name="skst" id="skst" placeholder="" value="<?=$data['skst']?>" onkeyup="hitung()">
		                </div>
		            </div>

		            <div class="form-group">
		                <label for="sksp" class="col-md-3 control-label"><font color="red">*&nbsp;</font>SKS Praktek</label>
		                <div class="col-md-1">
		                    <input type="text" class="form-control" name="sksp" id="sksp" placeholder="" value="<?=$data['sksp']?>" onkeyup="hitung()">
		                </div>
		            </div>

		    		<div class="form-group">
		    			<label for="sks" class="col-md-3 control-label">SKS</label>
		    			<div class="col-md-1">
		    				<input type="text" class="form-control" name="sks" id="sks" placeholder="" value="<?=$data['sks']?>" readonly="">
		    			</div>
		    		</div>

		    		<div class="form-group">
		    			<label for="kelmk" class="col-md-3 control-label">Kelompok</label>
		    			<div class="col-md-3">
		    				<input type="text" class="form-control" id="kelmk" name="kelmk" placeholder="" value="<?=$data['kelmk']?>">
		    			</div>
		    		</div>
					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-6">
							<button type="submit" name="edit" value="edit" class="btn btn-primary"><i class="fa fa-edit"></i> &nbsp;Edit</button>&nbsp;
							<a type="button" class="btn btn-default active" href="index.php?page=form-view-data-matakuliah"><i class="ion-arrow-return-left"></i>&nbsp;Cancel</a>
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

	function hitung() {
    var skst = parseInt($('#skst').val());
    var sksp = parseInt($('#sksp').val());
    var hasil = skst + sksp;

    $('#sks').val(hasil);

	}
</script>