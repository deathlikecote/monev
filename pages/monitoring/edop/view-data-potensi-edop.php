<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
	<li>
		<?php
			if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
				echo "<span class='pesan'><div class='btn btn-sm btn-inverse m-b-10'><i class='fa fa-bell text-warning'></i>&nbsp; ".$_SESSION['pesan']." &nbsp; &nbsp; &nbsp;</div></span>";
			}
			$wheres = '';
			$_SESSION['pesan'] ="";

			if(isset($_POST['perta'])){
				$pertax = $_POST['perta'];
				if($_SESSION['perta'] != $pertax){
					$wheres = $pertax;
				}else{
					$wheres = '';
				}
				
			}else{
				$pertax = $_SESSION['perta'];
				$wheres = '';
			}
			
		?>
	</li>
	
</ol>


<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Data <small>Potensi EDOP&nbsp;</small></h1>
<!-- end page-header -->
<?php
	
	include "../config/koneksi.php";
	$tampilUsr=mysqli_query($Open, "select ta, utsuas, idprogstudi, kodedosen, kodemk, namadosen, namamk, komentar_d, spote_d from exoxpotensi$wheres order by kodedosen") 
		or die("error:".mysql_error());
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
				<h4 class="panel-title">Results <span class="text-info"><?php echo mysqli_num_rows($tampilUsr);?></span> rows for "Data Potensi EDOP"</h4>
			</div>
            
			<div class="panel-body">
				 <!-- EOF Generate -->

				<form action="index.php?page=view-data-potensi-edop" name="isian" class="form-horizontal" method="POST" >
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
		                  <td align=center>Penilai (prodi)</td>
						  <td align=center>Yang Dinilai</td>
						  <td align=center>Matakuliah</td>
						  <td align=center>Nilai</td>
						  <td align=center>Komentar</td>
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

				            <td align=center> 
							  <?php echo strtoupper($usr['idprogstudi']) ?></span>
							</td>

							<td align=center> 
							  <?php echo strtoupper($usr['kodedosen']) ?></span>
							</td>

							<td align=center> 
							  <?php echo strtoupper($usr['kodemk']) ?></span>
							</td>

							<td align=center> 
							  <?php echo number_format($usr['spote_d'],2,'.',',') ?></span>
							</td>

							<td align=left> 
							  <?php echo $usr['komentar_d'] ?></span>
							</td>
							<?php if ($usr['komentar_d']!='' || !empty($usr['komentar_d'])) { 
								$isi=$isi+1;
							}
							?>
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