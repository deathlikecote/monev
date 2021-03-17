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
<h1 class="page-header">Dashboard <small>Overview &amp; statistic</small></h1>
<!-- end page-header -->

<?php
	include "../config/koneksi.php";
	
	$totSurvei		= mysqli_num_rows(mysqli_query($Open,"SELECT * FROM tb_projek"));
	$surveiDatang	= mysqli_num_rows(mysqli_query($Open,"SELECT * FROM tb_projek WHERE tgl_terbit > '".date('Y-m-d')."'"));
	$surveiAktif	= mysqli_num_rows(mysqli_query($Open,"SELECT * FROM tb_projek WHERE tgl_terbit <= '".date('Y-m-d')."' AND tgl_tutup > '".date('Y-m-d')."'"));
	$surveiBerakhir	= mysqli_num_rows(mysqli_query($Open,"SELECT * FROM tb_projek WHERE tgl_tutup < '".date('Y-m-d')."'"));
			
	/*$jmlhar	=mysqli_query($Open,"SELECT * FROM tb_penghargaan");
	$jhar	=mysqli_num_rows($jmlhar);
		
	$jmltug	=mysqli_query($Open,"SELECT * FROM tb_penugasan");
	$jtug	=mysqli_num_rows($jmltug);
			
	$jmldik	=mysqli_query($Open,"SELECT * FROM tb_diklat");
	$jdik	=mysqli_num_rows($jmldik);*/
?>
<style type="text/css">
.progress {
	text-align:center;
}
.progress-value {
    position:absolute;
    right:0;
    left:0;
    top: 1px;
}
</style>
<div class="row">
	<!-- begin col-3 -->
	<div class="col-md-3 col-sm-6">
		<div class="widget widget-stats bg-white text-inverse">
			<div class="stats-icon stats-icon-lg stats-icon-square bg-gradient-red"><i class="ion-ios-paper"></i></div>
			<div class="stats-title">SURVEI</div>
			<div class="stats-number"><?=$totSurvei?></div>
			<div class="stats-progress progress">
				<div class="progress-bar" style="width: 90%;"></div>
			</div>
			<div class="stats-desc">Total survei</div>
		</div>
	</div>
	<!-- end col-3 -->
		<!-- begin col-3 -->
	<div class="col-md-3 col-sm-6">
		<div class="widget widget-stats bg-white text-inverse">
			<div class="stats-icon stats-icon-lg stats-icon-square bg-gradient-orange"><i class="ion-ios-calendar"></i></div>
			<div class="stats-title">SURVEI AKAN DATANG</div>
			<div class="stats-number"><?=$surveiDatang?></div>
			<div class="stats-progress progress">
				<div class="progress-bar" style="width: 90%;"></div>
			</div>
			<div class="stats-desc">Total survei yang akan datang</div>
		</div>
	</div>
	<!-- end col-3 -->
	<!-- begin col-3 -->
	<div class="col-md-3 col-sm-6">
		<div class="widget widget-stats bg-white text-inverse">
			<div class="stats-icon stats-icon-lg stats-icon-square bg-gradient-green"><i class="ion-ios-checkmark"></i></div>
			<div class="stats-title">SUERVEI AKTIF</div>
			<div class="stats-number"><?=$surveiAktif?></div>
			<div class="stats-progress progress">
				<div class="progress-bar" style="width: 90%;"></div>
			</div>
			<div class="stats-desc">Total survei yang sedang berlangsung</div>
		</div>
	</div>
	<!-- end col-3 -->
	<!-- begin col-3 -->
	<div class="col-md-3 col-sm-6">
		<div class="widget widget-stats bg-white text-inverse">
			<div class="stats-icon stats-icon-lg stats-icon-square bg-gradient-orange"><i class="ion-ios-close"></i></div>
			<div class="stats-title">SURVEI BERAKHIR</div>
			<div class="stats-number"><?=$surveiBerakhir?></div>
			<div class="stats-progress progress">
				<div class="progress-bar" style="width: 90%;"></div>
			</div>
			<div class="stats-desc">Total survei yang telah berakhir</div>
		</div>
	</div>
	<!-- end col-3 -->
</div>
<!-- end row -->
<div class="row">
	<!-- begin col-12 -->
	<div class="col-md-6">
		<div class="panel panel-inverse" data-sortable-id="index-1">
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
				</div>
				<h4 class="panel-title"><i class="ion-stats-bars fa-lg text-warning"></i> &nbsp;Survei</h4>
			</div>
			<div class="panel-body">
				<div id="pieSurvei" class="height-sm"></div>
			</div>
		</div>				
	</div>
	<!-- end col-12 -->
	<!-- begin col-12 -->
	<div class="col-md-6">
		<div class="panel panel-inverse" data-sortable-id="index-1">
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
				</div>
				<h4 class="panel-title"><i class="ion-stats-bars fa-lg text-warning"></i> &nbsp;Survei Aktif</h4>
			</div>
			<div class="panel-body">
				<div id="barSurveiAktif" class="height-sm">
					<div class="text-center col-md-12 m-b-20" style="color:#333333;font-size:18px;fill:#333333;">Survei Aktif - Berakhir</div>
					
					<?php 
						$f1=mysqli_query($Open,"SELECT * FROM tb_projek WHERE tgl_terbit <= '".date('Y-m-d')."' AND tgl_tutup > '".date('Y-m-d')."' ORDER BY ID DESC LIMIT 5");
						while ($rLab = mysqli_fetch_array($f1)) {
						$date0 = date_create($rLab['tgl_terbit']);
						$date1=date_create(date('Y-m-d'));
						$date2 = date_create($rLab['tgl_tutup']);
						$diff=date_diff($date1,$date2);
						$diff2=date_diff($date0,$date1);
						$diffTotal=date_diff($date0,$date2);

						$totalDiff = $diffTotal->format("%a");
						$exisDiff = $diff2->format("%a");
						$persenDiff = ($exisDiff/$totalDiff)*100;

					 ?>
					 <div class="row">
						<div class="col-md-3 text-right"><?=$rLab['nama']?></div>
						<div class="progress col-md-7 p-0">
							<span class="progress-value"><?=round($persenDiff,0)."% | ".date('d-M')?> <?=$diff->format("%R%a Hari")?></span>
						  <div class="progress-bar bg-success" style="width: <?=round($persenDiff,0)?>%;"></div>
						</div>
						<div class="col-md-2"><?=date_format($date2, 'd-M')?></div>
					 </div>
					<?php } ?>
				</div>
			</div>
		</div>				
	</div>
	<!-- end col-12 -->
</div>

<div class="row">
	<!-- begin col-12 -->
	<div class="col-md-12">
		<div class="panel panel-inverse" data-sortable-id="index-1">
			<div class="panel-heading">
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
				</div>
				<h4 class="panel-title"><i class="ion-stats-bars fa-lg text-warning"></i> &nbsp;Perbandingan Responden Aktif dan Pasif</h4>
			</div>
			<div class="panel-body">
				<div id="multiBarResp" class="height-sm"></div>
			</div>
		</div>				
	</div>
	<!-- end col-12 -->
</div>


<script src="../assets/plugins/highcharts/js/highcharts.js"></script>
<script src="../assets/plugins/highcharts/js/modules/data.js"></script>
<script type="text/javascript">
var chart3;
	$(function () {
	chart3 = new Highcharts.Chart({
	        chart: {
	        	renderTo: 'multiBarResp',
	            type: 'column'
	        },
	        title: {
	            text: 'Jumlah Responden/Survei'
	        },
	        subtitle: {
	            text: ''
	        },
	        xAxis: {
	            categories:
	             <?php
	         	$a="";
	            $b="";
	            $f1=mysqli_query($Open,"SELECT * FROM tb_projek ORDER BY ID DESC LIMIT 5");
				while ($rLab = mysqli_fetch_array($f1)) {
					$a.="'".$rLab['nama']."',";
				}
	            
	            ?>
	              [<?php echo substr($a,0,-1); ?>],
	              crosshair: true,
	            title: {
	                text: null
	            }
	        },
	        yAxis: {
	            min: 0,
	            title: {
	                text: 'Jumlah',
	                align: 'middle'
	            },
	            labels: {
	                overflow: 'justify'
	            }
	        },
	        tooltip: {
	            headerFormat: '<span style="font-size:10px">Survei {point.key}</span><table>',
	            pointFormat: '<tr><td style="color:{black};padding:0">{series.name}: </td>' +
	              '<td style="padding:0"><b>{point.y}</b></td></tr>',
	            footerFormat: '</table>',
	            shared: true,
	            useHTML: true
	          },
	          plotOptions: {
	            column: {
	              pointPadding: 0.2,
	              borderWidth: 0
	            },
	            series: {
	                borderWidth: 0,
	                dataLabels: {
	                    enabled: true,
	                    format: '{point.y}'
	                }
	            }
	          },
	        credits: {
	            enabled: false
	        },
	        series: [
	        <?php
	       		
	           for ($i = 0; $i < 3; $i++) {
	           	$hasil = "";
	           	$f1=mysqli_query($Open,"SELECT * FROM tb_projek ORDER BY ID DESC LIMIT 5");
					while ($rLab = mysqli_fetch_array($f1)) {
			           	if($i==0){
							$teks = 'Responden';
							$query=mysqli_num_rows(mysqli_query($Open,"select * from tb_".$rLab['nama_value']."_user where id !='1'"));

						}else if($i==1){
							$teks = 'Aktif';
							$query=mysqli_num_rows(mysqli_query($Open,"select * from tb_".$rLab['nama_value']."_user a, tb_".$rLab['nama_value']."_answer b where a.id !='1' AND (a.id = b.id_user) GROUP BY a.id"));
						}else{
							$teks = 'Pasif';
							$query=mysqli_num_rows(mysqli_query($Open,"SELECT * FROM tb_".$rLab['nama_value']."_user WHERE id !='1' and id NOT IN (SELECT id_user FROM tb_".$rLab['nama_value']."_answer GROUP BY id_user)"));
						}
						$hasil .=$query.",";
					}
			?>
	            {
	         
		            name:<?php echo "'".$teks."'"; ?>,
		            data:  [<?=substr($hasil,0,-1)?>]

		        }<?php if($i < 2){echo  ",";} ?>

	    	<?php
	    		
	            }
	        ?>
	        ]
	       
	    });
	});
</script>
<script type="text/javascript">
	var chart1; // globally available
		$(document).ready(function() {
			chart1 = new Highcharts.Chart({
	        chart: {
	        	renderTo: 'pieSurvei',
	            plotBackgroundColor: null,
	            plotBorderWidth: null,
	            plotShadow: false,
	            type: 'pie'
	        },
	        title: {
	            text: 'Total Survei: <?=$totSurvei?>'
	        },
	        tooltip: {
	            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
	        },
	        plotOptions: {
	            pie: {
	                allowPointSelect: true,
	                cursor: 'pointer',
	                dataLabels: {
	                    enabled: true,
	                    format: '<b>{point.name}</b>: <br>{point.value:.0f} ({point.percentage:.1f} %)'
	                }
	            }
	        },
	        series: [{
	            name: 'Brands',
	            colorByPoint: true,
	            data: [{
	                <?php
                        echo "name: 'Akan Datang',";
                         echo "value: ".$surveiDatang.",";
                        echo "y: ".$surveiDatang.",";
                        echo "},{";
                  
                        echo "name: 'Aktif',";
                         echo "value: ".$surveiAktif.",";
                        echo "y: ".$surveiAktif.","; 
                        echo "sliced: true,
                        selected: true";
                        echo "},{";

                        echo "name: 'Berakhir',";
                         echo "value: ".$surveiBerakhir.",";
                        echo "y: ".$surveiBerakhir.","; 
	              ?>
	            }]
	        }]
		});	
			});	
</script>

<script> // 500 = 0,5 s
	$(document).ready(function(){setTimeout(function(){$(".pesan").fadeIn('slow');}, 500);});
	setTimeout(function(){$(".pesan").fadeOut('slow');}, 7000);
</script>