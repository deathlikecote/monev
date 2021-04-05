<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
	<li>
		<?php
			if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
				echo "<span class='pesan'><div class='btn btn-sm btn-inverse m-b-10'><i class='fa fa-bell text-warning'></i>&nbsp; ".$_SESSION['pesan']." &nbsp; &nbsp; &nbsp;</div></span>";
			}
			$wheres = '1';
			$cKodeprodi = '';
			$ckelas = '';
			$_SESSION['pesan'] ="";

			if(isset($_POST['perta'])){
				$pertax = $_POST['perta'];
			}else{
				$pertax = $_SESSION['perta'];
			}

		?>
	</li>
	
</ol>


<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">EPOD R.01 <small>Prodi&nbsp;</small></h1>
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

				<form action="monitoring/epod/epodreport1-pdf.php" name="isian" class="form-horizontal" method="GET" >
				<div class="form-inline"  style="margin-bottom: 20px">
					<div class="form-group">
					
		                <div class="col-md-2 text-left">
		                    <select id="perta" name="perta" class="form-control" >
		                    	<option value="<?=$_SESSION['perta']?>" <?php echo ($pertax == $_SESSION['perta']) ? 'selected' : '';?>><?=$_SESSION['perta']?></option>
		                    	<?php
		                    		$cPerta = mysqli_query($Open, "SELECT TABLE_NAME AS cPerta FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = '".$DB."' AND (TABLE_NAME like 'edomparameter%' AND LENGTH(TABLE_NAME) > 14)");
		                            $per=1;
		                            $sampaithn = date('Y')+1;
		                            while($rPerta = mysqli_fetch_array($cPerta)){
		                            	$listPerta = substr($rPerta['cPerta'], 13);
		                            	 ?>
		                              	<option value="<?=$listPerta?>" <?php echo ($pertax == $listPerta) ? 'selected' : '';?>><?=$listPerta?></option>
 										<?php
		                            }
		                            
		                           ?>
		                    </select>
	                    </div>
		            </div>

					<div class="form-group">
		    			<div class="col-md-3">
		    				<select id="kodex" name="kodex" class="form-control select2" searchable=""  style="width: 300px;">
	                        	<option value="" disabled selected>--Pilih Kode--</option>
	                    	</select>
		    			</div>
		            </div>

		            <div class="form-group">
		    			<div class="col-md-2 text-left">
		    				<button type="submit" name="caridpmk" class="btn btn-success"><i class="fa fa-print"></i></button>
		    			</div>
		            </div>
		           	
		           	<div class="form-group">
		    			<div class="col-md-2 text-left">
		    				<a type="button" name="all" class="btn btn-primary" onclick="return cetakall()"><i class="fa fa-print"></i> All <span id="numberOf"></span></a>
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
<script> // 500 = 0,5 s
	$(document).ready(function(){setTimeout(function(){$(".pesan").fadeIn('slow');}, 500);});
	setTimeout(function(){$(".pesan").fadeOut('slow');}, 7000);
	
	function cariMK(){
		var perta = $('#perta').val();
		$.post("monitoring/epod/master-lookup.php", {jenis:'pilihKodexR1', perta:perta}, function(result){
			$('#kodex').html(result);
		});
	}

	function cetakall(){
		$('.loading').css({'visibility':'visible','display':'inline'});
		var perta = $('#perta').val();
		var no = 0;
		var len = 0;
		$("#kodex > option:not(:first)").each(function(i) {
			len++;
			var vals = this.value;
			setTimeout(function(){
		         window.location.href = 'monitoring/epod/epodreport1-pdf.php?kodex=' + vals +'&perta=' + perta;
		         no++;
		         $('#numberOf').html(no + ' dari ' + len);
		    },500 + ( i * 1000 ));
		});
		$('.loading').css({'visibility':'hidden','display':'none'});
		
	}

	$(document).ready(function(){
		cariMK();

		$('#perta').change(function(){ cariMK(); });
	 

	})


	
</script>