<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
	<li>
		<?php
			if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
				echo "<span class='pesan'><div class='btn btn-sm btn-inverse m-b-10'><i class='fa fa-bell text-warning'></i>&nbsp; ".$_SESSION['pesan']." &nbsp; &nbsp; &nbsp;</div></span>";
			}
			$_SESSION['pesan'] ="";

			if(isset($_POST['perta'])){
				$pertax = $_POST['perta'];
			}else{
				$pertax = $_SESSION['perta'];
			}

			if($_SESSION['perta'] != $pertax){
				$tax=$_POST['perta'];
			}else{
				$tax='';
			}
			
		?>
	</li>
	<!-- <li>
		<a href="potensi/epod/export-generate-epod.php" class="btn btn-sm btn-success m-b-10"><i class="fa fa-file"></i> &nbsp;Export</a>
	</li> -->
	
</ol>


<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Data <small>Potensi EDOM&nbsp;</small></h1>
<!-- end page-header -->
<?php
	echo $tax;
	include "../config/koneksi.php";
	$tampilUsr=mysqli_query($Open, "SELECT * FROM edompotensi$tax");
	$hasil2=mysqli_query($Open, "SELECT DISTINCT nim FROM edompotensi$tax");
	$row=mysqli_num_rows($hasil2);
	$hasil3=mysqli_query($Open, "SELECT * FROM edompotensi$tax WHERE done=1 GROUP BY nim");
	$row2=mysqli_num_rows($hasil3);
	$nou=0;
	$isi=0;
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
				<h4 class="panel-title">Results <span class="text-info"><?php echo mysqli_num_rows($tampilUsr);?></span> rows for "Data Potensi EDOM"</h4>
			</div>
            
			<div class="panel-body">
				 <!-- EOF Generate -->

				<form action="index.php?page=view-data-potensi" name="isian" class="form-horizontal" method="POST" >
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
		        </div>

		        </form>
				<table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
					<thead>
						<tr>
						  <th align=center>No</th>
		                  <th align=center>Perta</th>
		                  <th align=center></th>
		                  <th align=center>NIM</th>
		                  <th align=center>KMK</th>
		                  <th align=center>Dosen</th>
		                  <th align=center>Kelas</th>
		                  <th align=center>Prodi</th>
		                  <th align=center>Status</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$no=0;
							while($usr = mysqli_fetch_array($tampilUsr)){
							$no++;
						?>
						<tr>
							<td align=left style="width: 10px"> 
				               <?php echo $no; ?>
				            </td>

				            <td align=center> 
				              <?php echo strtoupper($usr['ta']); ?>
				            </td>

				            <td align=left> 
				              <?php echo strtoupper($usr['utsuas']); ?>
				            </td>

				            <td align=left> 
				              <?php echo $usr['nim']; ?>
				            </td>

				            <td align=left> 
				              <?php echo strtoupper($usr['kodemk']); ?>
				            </td>

				            <td align=left> 
				              <?php echo strtoupper($usr['kodedosen']); ?>
				            </td>

				            <td align=center> 
							  <?php echo strtoupper($usr['kelas']) ?>
							</td>
							<td align=center> 
							  <?php echo strtoupper($usr['idprogstudi']) ?>
							</td>
							
							<td align=center> 
							<?php if ($usr['done']>0) { 
								$status = '-ok-';
								$isi=$isi+1;
							}else{
								$status = '-';
							}
							?>
							 <span class="style20"><?=$status?></span>
							
							</td>

						</tr>
						<?php
							}
						?>
					</tbody>
				</table>
				<div class="col-md-12 text-left p-0">
		        	<p>Jumlah Pengisian :<br>+ Potensi: <?=$no?><br>+ Pengisian : <?=$isi?></p>
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

	$(document).ready(function(){

		$('#perta, #kdprodi, #kelas, #status').change(function(){
			// alert();
	          $('form[name="isian"]').submit();
	     });


	  $("#generateee").click(function(){

        var eeask = $('#ee_bar_lastgenerate');
        if(eeask.html() != ''){
           if (confirm('Anda sudah melakukan generate sebelumnya. Anda yakin ?')) {
                eegenerate();
           }
         }else{
             eegenerate();
         }

        function eegenerate(){
          document.getElementById("ee_bar_no").innerHTML ="0";
          document.getElementById("ee_bar_ok").innerHTML ="0";
          document.getElementById("ee_bar_total").innerHTML ="0";
          document.getElementById("ee_bar_dup").innerHTML ="0";
          document.getElementById('loadarea').src = 'potensi/epod/generate-epod.php';
        }

      });

	})


	 function validateForm()
    {

        function hasExtension(inputID, exts) {
            var fileName = document.getElementById(inputID).value;
            return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(fileName);
        }
 
        if(!hasExtension('import', ['.xlsx'])){
            alert("Hanya file excel yang diijinkan.");
            return false;
        }
    }
</script>