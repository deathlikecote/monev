<?php
	if (isset($_GET['id'])) {
	$id = $_GET['id'];
	
	include "../config/koneksi.php";
	$query   =mysqli_query($Open,"SELECT * FROM edopparameter WHERE id='$id'");
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
<h1 class="page-header">Data <small>Aspek - Parameter EDOP <i class="fa fa-angle-right"></i> Edit <i class="fa fa-key"></i> id_<?=$id?></small></h1>
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
				<h4 class="panel-title">Form edit data aspek - parameter EDOP</h4>
			</div>
			<div class="panel-body">
				<form action="index.php?page=edit-data-edop&id=<?=$id?>" name="isian" class="form-horizontal" method="POST" enctype="multipart/form-data" >

		    		<div class="form-group">
		                <label for="nourut" class="col-md-3 control-label">No. Urut</label>
		                <div class="col-md-1">
		                    <input type="text" class="form-control" name="nourut" id="nourut" placeholder="" value="<?=$data['nourut']?>">
		                </div>
		            </div>

		            <div class="form-group">
		                <label for="aspek" class="col-md-3 control-label">Aspek</label>
		                <div class="col-md-4">
		                    <input type="text" class="form-control" name="aspek" id="aspek" placeholder="" value="<?=$data['aspek']?>">
		                </div>
		            </div>

		            <div class="form-group">
		                <label for="parameter" class="col-md-3 control-label">Parameter</label>
		                <div class="col-md-8">
		                    <input type="text" class="form-control" name="parameter" id="parameter" placeholder="" value="<?=$data['parameter']?>"> 
		                </div>
		            </div>

		             <div class="form-group">
		                <label for="jenis" class="col-md-3 control-label">Jenis Pertanyaan</label>
		                <div class="col-md-2">
		                    <select id="jenis" name="jenis" class="form-control" >
		                      <option value="1" <?php echo ($data['jenis'] == '1') ? 'selected' : '';?>>1 - Ordinal</option>
		                      <option value="2" <?php echo ($data['jenis'] == '2') ? 'selected' : '';?>>2 - Ya/Tidak</option>
		                      <option value="3" <?php echo ($data['jenis'] == '3') ? 'selected' : '';?>>3 - Isian</option>
		                    </select>
		                </div>
		            </div>

					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-6">
							<button type="submit" name="edit" value="edit" class="btn btn-primary" onclick="return validateForm()"><i class="fa fa-edit"></i> &nbsp;Edit</button>&nbsp;
							<a type="button" class="btn btn-default active" href="index.php?page=form-view-data-edop"><i class="ion-arrow-return-left"></i>&nbsp;Cancel</a>
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


		function validateForm(isian)
{if(""==document.forms.isian.nourut.value)
{
alert("Silahkan isi No. Urut");
document.getElementById('nourut').style.borderColor='red';
document.getElementById('nourut').focus();;
return false;
}

if(""==document.forms.isian.aspek.value)
{
alert("Silahkan isi Aspek");
document.getElementById('aspek').style.borderColor='red';
document.getElementById('aspek').focus();;
return false;
}

if(""==document.forms.isian.parameter.value)
{
alert("Silahkan isi Parameter");
document.getElementById('parameter').style.borderColor='red';
document.getElementById('parameter').focus();;
return false;
}

if(""==document.forms.isian.jenis.value)
{
alert("Silahkan isi Jenis Pertanyaan");
document.getElementById('jenis').style.borderColor='red';
document.getElementById('jenis').focus();;
return false;
}
}
</script>