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
<h1 class="page-header">Generate & Backup <small>Generate All ES & Backup Table&nbsp;</small></h1>
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
	            <div class="col-md-12 m-b-10 text-center">
	    				<a class="btn-sm btn-primary" onclick="generateAllEs()">Generate All Es</a>
	            </div>

	            <div class="col-md-12 m-b-20 text-center ">
	    				<a class="btn-sm btn-primary form" onclick="backupTable()">Backup Table</a>
	    		
	            </div>
             	<div id="contentx" class="col-md-12 m-b-10 text-center">

             	</div>
	        </div>
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
		$.post("monitoring/edop/master-lookup.php", {jenis:'pilihKodexR3', perta:perta}, function(result){
			$('#kodex').html(result);
		});
	}

	function generateAllEs(){
         $('.loading').css({'visibility':'visible','display':'inline'});
         $.post("generateall/generateall.php", {jenis:'generateall'}, function(result){
			$('#contentx').html(result);
		 });
    }

    function backupTable(){
         $('.loading').css({'visibility':'visible','display':'inline'});
         $.post("generateall/backuptable.php", {jenis:'backuptable'}, function(result){
			$('#contentx').html(result);
		 });
    }

	$(document).ready(function(){
		cariMK();

		$('#perta').change(function(){ cariMK(); });
	 

	})

</script>