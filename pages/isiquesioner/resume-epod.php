<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
	<li>
		<?php
			if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
				echo "<span class='pesan'><div class='btn btn-sm btn-inverse m-b-10'><i class='fa fa-bell text-warning'></i>&nbsp; ".$_SESSION['pesan']." &nbsp; &nbsp; &nbsp;</div></span>";
			}

			$cekRow	=mysqli_query($Open,"SELECT tglakhir FROM m_periode WHERE jenis = 'EPOD'");
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
<h1 class="page-header">Resume <small>EPOD&nbsp;</small></h1>
<!-- end page-header -->

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
				<form action="index.php?page=resume-epod" name="isian" class="form-horizontal" method="POST" >
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
		    				<button type="submit" name="caridpmk" class="btn btn-success" onclick="return validateForm()"><i class="fa fa-search"></i></button>
	                    </select>
		    			</div>
		            </div>
		           
		        </div>

		          
		        </form>
				
				<?php 
		if (isset($_POST['caridpmk'])){
			$ta=$_POST['perta'];	
			$kode=$_SESSION['id_user'];
			$overall=0;	
			$detail=0;
		
			$nilaioverall=mysqli_query($Open, "SELECT * FROM tepodoverall where ta='$ta' and idprogstudi='$kode'");
			$no=mysqli_fetch_array($nilaioverall);
			
		
			echo '<hr style=""> 
			<div class="row">
			 <div class="col-lg-6" style="font-size:14px;margin:0">
			 <p><label style="float:left;width:4cm;color:#3e3b3c">Tahun Akademik</label>: '.$ta.'</p>
			 </div>
  			 <div class="col-lg-6" style="font-size:14px">
				
			 </div>
		   </div>
		   <hr style="margin-top:2px;">
		   
<table style="width:100%;" id="custom1" class="table table-striped table-bordered nowrap" >
  <tr>
    <th width="42" rowspan="2" scope="col" style="text-align:center;vertical-align:middle">Dosen</th>
    <th width="69" rowspan="2" scope="col" style="text-align:center;vertical-align:middle">Mata Kuliah</th>
    <th colspan="3" scope="col" style="text-align:center;vertical-align:middle">Aspek</th>
    <th width="11" rowspan="2" scope="col" style="text-align:center;vertical-align:middle">Score</th>
  </tr>
  <tr>
    <th width="8" style="text-align:center;vertical-align:middle">A</th>
    <th width="8" style="text-align:center;vertical-align:middle">B</th>
    <th width="8" style="text-align:center;vertical-align:middle">C</th>
  </tr>
  ';
 $tn1=mysqli_query($Open, "SELECT a. kodedosen as nama, c.namamk, a.A, a.B, a.C, a.total,a.idprogstudi FROM tnilaiepod a,v_mk c  where  (a.ta='$ta' and a.idprogstudi='$kode') and (c.kodemk=a.kodemk)");
 
		while($tn=mysqli_fetch_array($tn1)){
echo'			 
  <tr>
    <td>'.$tn['nama'].'</td>
    <td>'.$tn['namamk'].'</td>
    <td>'.number_format($tn['A'],2).'</td>
    <td>'.number_format($tn['B'],2).'</td>
    <td>'.number_format($tn['C'],2).'</td>
    <td>'.number_format($tn['total'],2).'</td>
	
  </tr>
  ';
		}
echo'</table>
<a href="isiquesioner/epodreport1-pdf.php?kode='.$_SESSION['id_user'].'&perta='.$ta.'" target="_blank"><button class="btn btn-primary" style="width:100%;">Cetak PDF</button></a><br><br>
';
		
//----------------------js overall---------------------------
		echo'
		 <script type="text/javascript">
			
           AmCharts.makeChart("chartdiv",
				{
					"type": "serial",
					"pathToImages": "amcharts/amcharts/images/",
					"categoryField": "category",
					"startDuration": 1,
					"theme": "patterns",
					"categoryAxis": {
						"gridPosition": "start"
					},
					"trendLines": [],
					"graphs": [
						{
							"balloonText": "[[title]] of [[category]]:[[value]]",
							"bullet": "round",
							"id": "AmGraph-1",
							"title": "Line Score",
							"lineColor": "#418DFB",
							"plotAreaFillAlphas": 0.07,
							"plotAreaFillColors": "#99D7FB",
							"valueField": "column-1",
							"visibleInLegend": false
						}
					],
					"guides": [],
					"valueAxes": [
						{
							"id": "ValueAxis-1",
							"maximum": 5,
							"minimum": 1,
							"autoGridCount": false,
							"title": "Score"
						}
					],
					"allLabels": [],
					"balloon": {},
					"legend": {
						"useGraphSettings": true
					},
					"titles": [
						{
							"id": "Title-1",
							"size": 15,
							"text": "OVERALL \n Score : '.number_format($no['total'],2).'"
						}
					],
					"dataProvider": [
						{
							"category": "Perencanaan PBM",
							"column-1": "'.$no['A'].'"
						},
						{
							"category": "Pelaksanaan PBM",
							"column-1": "'.$no['B'].'"
						},
						{
							"category": "Evaluasi PBM",
							"column-1": "'.$no['C'].'"
						}
					]
				}
			);
        
        </script>
		';
		
//-----------------head & overall & bottomhead-------------------------
echo'
		<h4 style="background-image:url(img/judul.png);background-repeat:no-repeat;background-size:100%;padding:5px;text-shadow:0.5px 0.5px 0.5px white;">Overall</h4>      
        <div id="chartdiv"  style="width:100%;height:8cm;border:solid 2px grey;border-radius:10px;margin-bottom:10px;"></div>

  		<h4 style="background-image:url(img/judul.png);background-repeat:no-repeat;background-size:100%;padding:5px;text-shadow:0.5px 0.5px 0.5px white;">Detail</h4><div class="row">
';			
//----------------selector detail---------------------------------------
	$nilaidetail=mysqli_query($Open, "SELECT a.kodedosen as nama ,a.A,a.B,a.C,a.total FROM tnilaiepod a where (a.ta='$ta' and a.idprogstudi='$kode')");
		while($nd=mysqli_fetch_array($nilaidetail)){
			$detail=$detail+50;
//----------------------js detail--------------------------------
		echo'
		 <script type="text/javascript">
			  AmCharts.makeChart("chartdiv'.$detail.'",
				{
					"type": "serial",
					"pathToImages": "amcharts/amcharts/images/",
					"categoryField": "category",
					"startDuration": 1,
					"theme": "patterns",
					"categoryAxis": {
						"gridPosition": "start"
					},
					"trendLines": [],
					"graphs": [
						{
							"balloonText": "[[title]] of [[category]]:[[value]]",
							"bullet": "round",
							"id": "AmGraph-1",
							"fontSize": 12,
							"title": "Line Score",
							"lineColor": "#418DFB",
							"plotAreaFillAlphas": 0.07,
							"plotAreaFillColors": "#99D7FB",
							"valueField": "column-1",
							"visibleInLegend": false
						}
					],
					"guides": [],
					"valueAxes": [
						{
							"id": "ValueAxis-1",
							"maximum": 5,
							"minimum": 1,
							"autoGridCount": false,
							"title": "Score"
						}
					],
					"allLabels": [],
					"balloon": {},
					"legend": {
						"useGraphSettings": true
					},
					"titles": [
						{
							"id": "Title-1",
							"size": 13,
							"bold": false,
							"text": "'.$nd['nama'].'\n Score : '.number_format($nd['total'],2).'"
						}
					],
					"dataProvider": [
						{
							"category": "Perencanaan\nPBM",
							"column-1": "'.$nd['A'].'"
						},
						{
							"category": "Pelaksanaan\nPBM",
							"column-1": "'.$nd['B'].'"
						},
						{
							"category": "Evaluasi\nPBM",
							"column-1": "'.$nd['C'].'"
						}
					]
				}
			);
            
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

</script>