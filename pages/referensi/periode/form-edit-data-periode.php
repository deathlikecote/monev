<?php
	if (isset($_GET['id'])) {
	$id = $_GET['id'];
	
	include "../config/koneksi.php";
	$query   =mysqli_query($Open,"SELECT * FROM m_periode WHERE id='$id'");
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
<h1 class="page-header">Referensi <small>Setup Periode <i class="fa fa-angle-right"></i> Edit <i class="fa fa-key"></i> id_<?=$id?></small></h1>
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
				<h4 class="panel-title">Form edit data periode</h4>
			</div>
			<div class="panel-body">
				<form action="index.php?page=edit-data-periode&id=<?=$id?>" name="isian" class="form-horizontal" method="POST" enctype="multipart/form-data" >

		    		<!-- <div class="form-group">
		                <label for="jenis" class="col-md-3 control-label">Jenis</label>
		                <div class="col-md-2">
		                    <select id="jenis" name="jenis" class="form-control" >
		                      <option value="EDOM" <?php echo ($data['jenis'] == 'EDOM') ? 'selected' : '';?>>EDOM</option>
		                      <option value="EPOM" <?php echo ($data['jenis'] == 'EPOM') ? 'selected' : '';?>>EPOM</option>
		                      <option value="EPOD" <?php echo ($data['jenis'] == 'EPOD') ? 'selected' : '';?>>EPOD</option>
		                      <option value="EDOP" <?php echo ($data['jenis'] == 'EDOP') ? 'selected' : '';?>>EDOP</option>
		                    </select>
		                </div>
		            </div> -->

		             <div class="form-group">
		                <label for="perta" class="col-md-3 control-label">Perta</label>
		                <div class="col-md-2">
		                    <select id="perta" name="perta" class="form-control" >
		                    	<?php
		                            $per=1;
		                            $sampaithn = date('Y')+1;
		                            for($i=$sampaithn;$i>=2017;$i--){
		                            if($per==2){
		                                $pers = $i."2";  
		                                ?>
		                              <option value="<?=$pers?>" <?php echo ($data['perta'] == $pers) ? 'selected' : '';?>><?=$pers?></option>
 										<?php
		                                $per=1;
		                              }

		                              if($per==1){
		                                $pers = $i."1";
		                               ?>
		                             <option value="<?=$pers?>" <?php echo ($data['perta'] == $pers) ? 'selected' : '';?>><?=$pers?></option>

		                               <?php
		                                $per++;
		                              }
		                             
		                           } 
		                           ?>
		                    </select>
		                </div>
		            </div>

		            <div class="form-group">
		                <label for="periode" class="col-md-3 control-label">Periode</label>
		                <div class="col-md-2">
		                    <select id="periode" name="periode" class="form-control" >
		                      <option value="JAN-AGT" <?php echo ($data['periode'] == 'JAN-AGT') ? 'selected' : '';?>>JAN-AGT </option>
		                      <option value="JUL-DES" <?php echo ($data['periode'] == 'JUL-DES') ? 'selected' : '';?>>JUL-DES </option>
		                    </select>
		                </div>
		            </div>

		             <div class="form-group">
		    			<label for="tglawal" class="col-md-3 control-label">Dibuka</label>
		    			<div class="col-md-2">
		    				<div class="input-group date" id="datepicker-disabled-past2" data-date-format="yyyy-mm-dd">
								<input type="text" name="tglawal" class="form-control" value="<?=$data['tglawal']?>" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
		    			</div>
		    		</div>

		    		<div class="form-group">
		    			<label for="tglakhir" class="col-md-3 control-label">Ditutup</label>
		    			<div class="col-md-2">
		    				<div class="input-group date" id="datepicker-disabled-past3" data-date-format="yyyy-mm-dd">
								<input type="text" name="tglakhir" class="form-control" value="<?=$data['tglakhir']?>" />
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
		    			</div>
		    		</div>

					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-6">
							<button type="submit" name="edit" value="edit" class="btn btn-primary" onclick="return validateForm()"><i class="fa fa-edit"></i> &nbsp;Edit</button>&nbsp;
							<a type="button" class="btn btn-default active" href="index.php?page=form-view-data-periode"><i class="ion-arrow-return-left"></i>&nbsp;Cancel</a>
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

	function validateForm(isian)
	{
		if(""==document.forms.isian.tglawal.value){
			alert("Silahkan isi Tanggal Buka");
			document.getElementById('tglawal').style.borderColor='red';
			document.getElementById('tglawal').focus();;
			return false;
		}

		if(""==document.forms.isian.tglakhir.value){
			alert("Silahkan isi Tanggal Tutup");
			document.getElementById('tglakhir').style.borderColor='red';
			document.getElementById('tglakhir').focus();;
			return false;
		}

	}
</script>