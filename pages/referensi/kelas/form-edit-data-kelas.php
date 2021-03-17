<?php
	if (isset($_GET['id'])) {
	$id = $_GET['id'];
	
	include "../config/koneksi.php";
	$query   =mysqli_query($Open,"SELECT * FROM t_kelas WHERE id='$id'");
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
<h1 class="page-header">Referensi <small>Kelas Mahasiswa Aktif <i class="fa fa-angle-right"></i> Edit <i class="fa fa-key"></i> id_<?=$id?></small></h1>
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
				<h4 class="panel-title">Form edit data kelas mahasiswa aktif</h4>
			</div>
			<div class="panel-body">
				<form action="index.php?page=edit-data-kelas&id=<?=$id?>" class="form-horizontal" method="POST" enctype="multipart/form-data" >
					
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
						<label for="kdprodi" class="col-md-3 control-label"><font color="red">*&nbsp;</font>Prodi</label>
						<div class="col-md-2">
	                     <select id="kdprodi" name="kdprodi" class="form-control" searchable="" >
	                        <option value="" disabled selected>--Pilih Prodi--</option>
	                         <?php
	                            $a=0;
	                            $t=mysqli_query($Open,"SELECT * FROM m_prodi ORDER BY kodeprodi ASC");
	                            while($tak=mysqli_fetch_array($t)){
	                           ?>

	                            <option value="<?=$tak['kodeprodi']?>" <?php echo ($data['kdprodi'] == $tak['kodeprodi']) ? 'selected' : '';?>><?=$tak['kodeprodi']?></option>  
	                           
	                           <?php } ?>
	                    </select>
	                	</div>
	                </div>

		    		<div class="form-group">
		    			<label for="kelas" class="col-md-3 control-label"><font color="red">*&nbsp;</font>Kelas</label>
		    			<div class="col-md-2">
		    				<input type="text" class="form-control" name="kelas" id="kelas" placeholder="" value="<?=$data['kelas']?>">
		    			</div>
		    		</div>

		    		<div class="form-group">
		    			<label for="nim" class="col-md-3 control-label"><font color="red">*&nbsp;</font>NIM</label>
		    			<div class="col-md-4">
		    				<input type="hidden" class="form-control" name="nim_old" id="nim_old"  value="<?=$data['nim']?>">
		    				<select id="nim" name="nim" class="form-control select2" searchable="" >
	                        <option value="" disabled selected>--Pilih NIM--</option>
	                         <?php
	                            $a=0;
	                            $t=mysqli_query($Open,"SELECT * FROM m_siswa ORDER BY nim ASC");
	                            while($tak=mysqli_fetch_array($t)){
	                           	?>
	                            	<option value="<?=$tak['nim']?>" <?php echo ($data['nim'] == $tak['nim']) ? 'selected' : '';?>><?php echo $tak['nim']." | ".$tak['nama']; ?></option> 

	                            <?php } ?>
	                    </select>
		    				
		    			</div>
		    		</div>
					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-6">
							<button type="submit" name="edit" value="edit" class="btn btn-primary" onclick="return validateForm()"><i class="fa fa-edit"></i> &nbsp;Edit</button>&nbsp;
							<a type="button" class="btn btn-default active" href="index.php?page=form-view-data-kelas"><i class="ion-arrow-return-left"></i>&nbsp;Cancel</a>
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

	$('.select2').select2();

 	function validateForm(isian)
	{
		if(""==document.forms.isian.kdprodi.value){
			alert("Silahkan pilih Prodi");
			document.getElementById('kdprodi').style.borderColor='red';
			document.getElementById('kdprodi').focus();;
			return false;
		}

		if(""==document.forms.isian.kelas.value){
			alert("Silahkan isi Kelas");
			document.getElementById('kelas').style.borderColor='red';
			document.getElementById('kelas').focus();;
			return false;
		}

		if(""==document.forms.isian.nim.value){
			alert("Silahkan pilih NIM");
			document.getElementById('nim').style.borderColor='red';
			document.getElementById('nim').focus();;
			return false;
		}

	}
</script>