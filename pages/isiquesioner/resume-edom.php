<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
	<li>
		<?php
			if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
				echo "<span class='pesan'><div class='btn btn-sm btn-inverse m-b-10'><i class='fa fa-bell text-warning'></i>&nbsp; ".$_SESSION['pesan']." &nbsp; &nbsp; &nbsp;</div></span>";
			}

			$cekRow	=mysqli_query($Open,"SELECT tglakhir FROM m_periode WHERE jenis = 'EDOM'");
			$row = mysqli_fetch_assoc($cekRow);

			$wheres = '1';
			$cKodeprodi = '';
			$ckelas = '';
			$_SESSION['pesan'] ="";

			if(isset($_POST['perta'])){
				$pertax = $_POST['perta'];
			}else{
				$pertax = $_SESSION['perta'];
			}

			$wheres .= " AND ta ='".$pertax."'";

			if(isset($_POST['kodemk'])){
				if(!empty($_POST['kodemk'])){
					$kmk = $_POST['kodemk'];
					$wheres .= " AND idprogstudi ='".$_POST['kodemk']."'";
				}
				
			}

		?>
	</li>
	
</ol>


<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Resume <small>EDOM&nbsp;</small></h1>
<!-- end page-header -->
<?php
	
	include "../config/koneksi.php";
	$tampilUsr	=mysqli_query($Open,"SELECT a.*, b.nama FROM edompotensi a, m_siswa b WHERE $wheres AND (b.nim = a.nim) GROUP BY a.ta, a.per, a.utsuas, a.nim, a.idprogstudi, a.kelas ORDER BY a.ta, a.per, a.utsuas, a.nim, a.kodemk, a.idprogstudi, a.kelas asc");
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
				<?php 
					if(date('Y-m-d') < $row['tglakhir']){
						echo '
						 
						<p>Perta/periode '.$_SESSION['perta'].' dapat dilihat pada '.$row['tglakhir'].'</p>
						';
					}
				 ?>
				<form action="index.php?page=resume-edom" name="isian" class="form-horizontal" method="POST" >
				<div class="form-inline"  style="margin-bottom: 20px">
					<div class="form-group">
					
		                <div class="col-md-2 text-left">
		                    <select id="perta" name="perta" class="form-control" >
		                    	<?php 
								if(date('Y-m-d') >= $row['tglakhir']){
								 ?>

		                    	<option value="<?=$_SESSION['perta']?>" <?php echo ($pertax == $_SESSION['perta']) ? 'selected' : '';?>><?=$_SESSION['perta']?></option>
		                    	<?php } ?>

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
		    			<div class="col-md-2 text-left">
		    				<select id="kodemk" name="kodemk" class="form-control select2" searchable="" >
	                        <option value="" selected>--Pilih MK--</option>
	                        
	                    </select>
		    			</div>
		            </div>

		            <div class="form-group">
		    			<div class="col-md-2 text-left">
		    				<button type="submit" name="caridpmk" class="btn btn-success" onclick="return validateForm()"><i class="fa fa-search"></i></button>
	                    </select>
		    			</div>
		            </div>
		           
		        </div>

		          
		        </form>
				
				<?php 
		if (isset($_POST['caridpmk'])){
			$ta=$_POST['perta'];
			$mk=$_POST['kodemk'];	
			$kode=$_SESSION['id_user'];
			$overall=0;	
			$detail=0;
			$namamk1=mysqli_query($Open, "SELECT a.kodemk, b.namamk FROM t_penugasan a, m_matakuliah b  where a.perta='$ta' AND a.kodemk='$mk' AND b.kodemk=a.kodemk");
			$nmk=mysqli_fetch_array($namamk1);
		
			$nilaioverall=mysqli_query($Open, "SELECT * FROM tedomoverall  where kodemk='$mk' and ta='$ta' and kodedosen='$kode'");
			$no=mysqli_fetch_array($nilaioverall);
			
		
			echo '<hr style=""> 
			<div class="row">
			 <div class="col-lg-6" style="font-size:14px;margin:0">
				<p ><label style="float:left;width:3cm;color:#3e3b3c"> Mata Kuliah</label>: ('.$nmk['kodemk'].') '.$nmk['namamk'].'</p>
			 </div>
  			 <div class="col-lg-6" style="font-size:14px">
				<p><label style="float:left;width:4cm;color:#3e3b3c">Tahun Akademik</label>: '.$ta.'</p>
			 </div>
		   </div>
		   <hr style="margin-top:2px;">
		   
			<table style="width:100%;" id="custom1" class="table table-striped table-bordered nowrap" width="100%" >
			<thead>
			  <tr>
			    <th width="42" rowspan="2" class="text-center" style="vertical-align:middle">
			    	Prodi
			    </th>
			    <th width="69" rowspan="2" class="text-center" style="vertical-align:middle">
			    	Kelas
			    </th>
			    <th colspan="4" class="text-center" style="vertical-align:middle">
			    	Aspek
			    </th>
			    <th width="11" rowspan="2" class="text-center" style="vertical-align:middle">
			    	Score
			    </th>
				<th width="11" rowspan="2" class="text-center" style="vertical-align:middle"></th>
			  </tr>
			  <tr>
			    <th width="8" class="text-center">A</th>
			    <th width="8" class="text-center">B</th>
			    <th width="8" class="text-center">C</th>
			    <th width="8" class="text-center">D</th>
			  </tr>
			  </thead>
			  <tbody>
			  ';
 $tn1=mysqli_query($Open, "SELECT * FROM tnilaiedom  where kodemk='$mk' and ta='$ta' and kodedosen='$kode'");
		while($tn=mysqli_fetch_array($tn1)){
echo'			 
  <tr>
    <td>'.$tn['idprogstudi'].'</td>
    <td>'.$tn['kelas'].'</td>
    <td>'.number_format($tn['A'],2).'</td>
    <td>'.number_format($tn['B'],2).'</td>
    <td>'.number_format($tn['C'],2).'</td>
    <td>'.number_format($tn['D'],2).'</td>
    <td>'.number_format($tn['total'],2).'</td>
	<td><a href="isiquesioner/edomreport1-pdf.php?kode='.$tn['kode'].'&perta='.$ta.'" target="_blank">Cetak PDF</a></td>
  </tr>
  ';
		}

echo'</tbody></table><br>';
		
//----------------------js overall---------------------------
		echo'
		 <script type="text/javascript">
			
             var chart;

            var chartData = [
                {
                    "direction": "Pedagogik",
                    "value": '.round($no['A'],2).'
                },
                {
                    "direction": "Pribadi",
                    "value": '.round($no['B'],2).'
                },
                {
                    "direction": "Professional",
                    "value": '.round($no['C'],2).'
                },
                {
                    "direction": "Sosial",
                    "value": '.round($no['D'],2).'
                }
            ];


            AmCharts.ready(function () {
                // RADAR CHART
                chart = new AmCharts.AmRadarChart();
                chart.dataProvider = chartData;
                chart.categoryField = "direction";
                chart.startDuration = 1;

                // TITLE
                chart.addTitle("Overall \n Score : '.round($no['total'],2).'", 15);

                // VALUE AXIS
                var valueAxis = new AmCharts.ValueAxis();
                valueAxis.gridType = "circles";
                valueAxis.fillAlpha = 0.05;
                valueAxis.fillColor = "#000000";
                valueAxis.axisAlpha = 0.2;
                valueAxis.gridAlpha = 0;
                valueAxis.fontWeight = "bold";
                valueAxis.minimum = 0;
				valueAxis.maximum = 5;
                chart.addValueAxis(valueAxis);

                // GRAPH
                var graph = new AmCharts.AmGraph();
                graph.lineColor = "#337ab7";
                graph.fillAlphas = 0.4;
                graph.bullet = "round";
                graph.valueField = "value";
                graph.balloonText = "[[category]]: [[value]] m/s";
                chart.addGraph(graph);

                // GUIDES
                // blue fill
                var guide = new AmCharts.Guide();
                guide.angle = 225;
                guide.tickLength = 0;
                guide.toAngle = 315;
                guide.value = 0;
                guide.toValue = 5;
                guide.fillColor = "#9289ba";
                guide.fillAlpha = 0.6;
                valueAxis.addGuide(guide);

                // red fill
                guide = new AmCharts.Guide();
                guide.angle = 45;
                guide.tickLength = 0;
                guide.toAngle = 135;
                guide.value = 0;
                guide.toValue = 5;
                guide.fillColor = "#CC3333";
                guide.fillAlpha = 0.6;
                valueAxis.addGuide(guide);

                // WRITE                
                chart.write("chartdiv");
            });
        </script>
		';
		
//-----------------head & overall & bottomhead-------------------------
echo'
		<h4 >Overall</h4>      
        <div id="chartdiv"  style="width:100%;height:8cm;border:solid 2px grey;border-radius:10px;margin-bottom:10px;"></div>

  		<h4>Detail</h4><div class="row">
';			
//----------------selector detail---------------------------------------
	$nilaidetail=mysqli_query($Open, "SELECT * FROM tnilaiedom  where kodemk='$mk' and ta='$ta' and kodedosen='$kode'");
		while($nd=mysqli_fetch_array($nilaidetail)){
			$detail=$detail+50;
		echo'
		 <script type="text/javascript">
			
             var chart'.$detail.';

            var chart'.$detail.'Data = [
                {
                    "direction": "Pedagogik",
                    "value": '.round($nd['A'],2).'
                },
                {
                    "direction": "Pribadi",
                    "value": '.round($nd['B'],2).'
                },
                {
                    "direction": "Professional",
                    "value": '.round($nd['C'],2).'
                },
                {
                    "direction": "Sosial",
                    "value": '.round($nd['D'],2).'
                }
            ];


            AmCharts.ready(function () {
                // RADAR CHART
                chart'.$detail.' = new AmCharts.AmRadarChart();
                chart'.$detail.'.dataProvider = chart'.$detail.'Data;
                chart'.$detail.'.categoryField = "direction";
                chart'.$detail.'.startDuration = 1;

                // TITLE
                chart'.$detail.'.addTitle("'.$nd['idprogstudi'].' '.$nd['kelas'].' \n Score : '.round($nd['total'],2).'", 15);

                // VALUE AXIS
                var valueAxis = new AmCharts.ValueAxis();
                valueAxis.gridType = "circles";
                valueAxis.fillAlpha = 0.05;
                valueAxis.fillColor = "#000000";
                valueAxis.axisAlpha = 0.2;
                valueAxis.gridAlpha = 0;
                valueAxis.fontWeight = "bold";
                valueAxis.minimum = 0;
				valueAxis.maximum = 5;
                chart'.$detail.'.addValueAxis(valueAxis);

                // GRAPH
                var graph = new AmCharts.AmGraph();
                graph.lineColor = "#337ab7";
                graph.fillAlphas = 0.4;
                graph.bullet = "round";
                graph.valueField = "value";
                graph.balloonText = "[[category]]: [[value]] m/s";
                chart'.$detail.'.addGraph(graph);

                // GUIDES
                // blue fill
                var guide = new AmCharts.Guide();
                guide.angle = 225;
                guide.tickLength = 0;
                guide.toAngle = 315;
                guide.value = 0;
                guide.toValue = 5;
                guide.fillColor = "#9289ba";
                guide.fillAlpha = 0.6;
                valueAxis.addGuide(guide);

                // red fill
                guide = new AmCharts.Guide();
                guide.angle = 45;
                guide.tickLength = 0;
                guide.toAngle = 135;
                guide.value = 0;
                guide.toValue = 5;
                guide.fillColor = "#CC3333";
                guide.fillAlpha = 0.6;
                valueAxis.addGuide(guide);

                // WRITE                
                chart'.$detail.'.write("chartdiv'.$detail.'");
            });
        </script>
		';
//--------------------div detail------------------------------------		
		echo'
		
    		<div class="col-lg-6"><div id="chartdiv'.$detail.'"  style="height:7cm;border:solid 2px grey;border-radius:10px;margin:0px 0px 10px 0px;"></div></div> 
		
				';
		}
		echo'</div>	';
		}
		
		
		?>
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
		$.post("isiquesioner/master-lookup.php", {jenis:'pilihMkEdom', perta:perta}, function(result){
			$('#kodemk').html(result);
		});
	}

	function validateForm(){
		if($('#kodemk').val() == '' || empty($('#kodemk').val()) ){
			alert('Silahkan pilih MK terlebih dahulu');
			return false;
		}
	}

	$(document).ready(function(){
		cariMK();

		$('#perta').change(function(){ cariMK(); });
	 

	})


	
</script>