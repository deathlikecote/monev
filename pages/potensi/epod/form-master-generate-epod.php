
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
<h1 class="page-header">Generate <small>Potensi EPOD & EDOP <i class="fa fa-angle-right"></i> Add&nbsp;</small></h1>
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
				<h4 class="panel-title">Form Generate EPOD & EDOP</h4>
			</div>
			<div class="panel-body">
				<form action="index.php?page=master-generate-epod" name="isian" class="form-horizontal" method="POST" enctype="multipart/form-data" >

		            <div class="form-group">
						<label for="kdprodi" class="col-md-3 control-label"><font color="red">*&nbsp;</font>Prodi</label>
						<div class="col-md-2">
	                     <select id="kdprodi" name="kdprodi" class="form-control" searchable="" >
	                        <option value="" disabled selected>--Pilih Prodi--</option>
	                         <?php
	                            $a=0;
	                            $t=mysqli_query($Open,"SELECT * FROM m_prodi ORDER BY kodeprodi ASC");
	                            while($tak=mysqli_fetch_array($t)){
	                           
	                            echo "<option value=".$tak['kodeprodi'].">".$tak['kodeprodi']."</option>";  
	                           
	                          }
	                          ?>
	                    </select>
	                	</div>
	                </div>

		    		<div class="form-group">
		    			<label for="kodemk" class="col-md-3 control-label"><font color="red">*&nbsp;</font>Matakuliah</label>
		    			<div class="col-md-4">
		    				<select id="kodemk" name="kodemk" class="form-control select2" searchable="" >
	                        <option value="" disabled selected>--Pilih MK--</option>
	                         <?php
	                            $a=0;
	                            $t=mysqli_query($Open,"SELECT * FROM m_matakuliah ORDER BY kodemk ASC");
	                            while($tak=mysqli_fetch_array($t)){
	                          	?>
	                            	<option value="<?=$tak['kodemk']?>"><?php echo $tak['kodemk']." | ".$tak['namamk']; ?></option> 

	                            <?php } ?>
	                    </select>
		    				
		    			</div>
		    		</div>

	                <div class="form-group">
		    			<label for="kodedosen" class="col-md-3 control-label"><font color="red">*&nbsp;</font>Dosen</label>
		    			<div class="col-md-4">
		    				<select id="kodedosen" name="kodedosen" class="form-control select2" searchable="" >
	                        <option value="" disabled selected>--Pilih Dosen--</option>
	                         <?php
	                            $a=0;
	                            $t=mysqli_query($Open,"
	                            SELECT kodedosen AS kodedosen, nama AS nama FROM m_dosen 
                            	UNION 
                            	SELECT tim AS kodedosen, 'Tim dosen' AS nama FROM m_timdosen
                            	ORDER BY kodedosen ASC");
	                            while($tak=mysqli_fetch_array($t)){
	                            	?>
	                            	<option value="<?=$tak['kodedosen']?>" ><?php echo $tak['kodedosen']." | ".$tak['nama']; ?></option> 

	                            <?php } ?>
	                    </select>
		    				
		    			</div>
		    		</div>

					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-6">
							<button type="submit" name="save" value="save" class="btn btn-primary" onclick="return validateForm()"><i class="fa fa-floppy-o"></i> &nbsp;Save</button>&nbsp;
							<a type="button" class="btn btn-default active" href="index.php?page=form-view-generate-epod"><i class="ion-arrow-return-left"></i>&nbsp;Cancel</a>
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
		if(""==document.forms.isian.kodemk.value){
			alert("Silahkan pilih Matakuliah");
			document.getElementById('kodemk').style.borderColor='red';
			document.getElementById('kodemk').focus();;
			return false;
		}

		if(""==document.forms.isian.kodedosen.value){
			alert("Silahkan pilih Dosen");
			document.getElementById('kodedosen').style.borderColor='red';
			document.getElementById('kodedosen').focus();;
			return false;
		}
	}
$(document).ready(function(){
	$('#kdprodi').change(function(){
		var lookVarFilter = $(this).val();
		$.post("potensi/edom/master-lookup.php", {jenis:'lookValFilter', lookVarFilter:lookVarFilter}, function(result){
			$('#kelas').html(result);
			$('#nim').find('option').not(':first').remove();
			$("#nim").val($("#nim option:first").val());
		});

	});

	$('#kelas').change(function(){
		var kelas = $(this).val();
		var kdprodi = $('#kdprodi').val();
		$.post("potensi/edom/master-lookup.php", {jenis:'lookValFilterNim', kdprodi:kdprodi, kelas:kelas}, function(result){
			$('#nim').html(result);
		});

	});
});
</script>