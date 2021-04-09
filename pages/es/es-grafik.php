<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
	<li>
		<?php
			if (isset($_SESSION['pesan']) && $_SESSION['pesan'] <> '') {
				echo "<span class='pesan'><div class='btn btn-sm btn-inverse m-b-10'><i class='fa fa-bell text-warning'></i>&nbsp; ".$_SESSION['pesan']." &nbsp; &nbsp; &nbsp;</div></span>";
			}

            $cekRow	=mysqli_query($Open,"SELECT tglakhir FROM m_periode WHERE jenis = 'EDOM'");
			$row = mysqli_fetch_assoc($cekRow);

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
<h1 class="page-header">Executive Summary <small>&nbsp;Grafik</small></h1>
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
                <?php 
					if(date('Y-m-d') < $row['tglakhir']){
						echo '
						 
						<p>Perta/periode '.$_SESSION['perta'].' dapat dilihat pada '.$row['tglakhir'].'</p>
						';
					}
				 ?>
				<form action="index.php?page=es-grafik" name="isian" class="form-horizontal" method="POST" >
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
		    			<div class="col-md-2 text-left">
		    				<button type="submit" name="caridpmk" class="btn btn-primary"><i class="fa fa-eye"></i> Tampilkan</button>
	                    </select>
		    			</div>
		            </div>
		           
		        </div>

		          
		        </form>
				
                <script type="text/javascript">
                <?php
                $sql1=mysqli_query($Open,"SELECT * FROM edom_diagram_es WHERE keterangan='k1' AND ta = '".$pertax."' ");
                $r1=mysqli_fetch_array($sql1);
                ?>
                $(function () {

                    $('#container').highcharts({
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                        <?php echo "text: 'EDOM (".$r1['total'].")' ";?>
                        },
                        tooltip: {
                            pointFormat: '{series.name} : <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    format: '<b>{point.name}</b> : {point.value:.0f} ({point.percentage:.1f} %)',
                                    style: {
                                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                    }
                                }
                            }
                        },
                        series: [{
                            name: 'Persentase',
                            colorByPoint: true,
                            data: [{
                            <?php
                            $b=1;
                                $sql=mysqli_query($Open,"select * from edom_diagram_es where ta = '".$pertax."'");
                                while($r=mysqli_fetch_array($sql)){
                                if($b<4){
                                    echo "
                                        name: '".$r['keterangan']."',
                                        value: ".$r['jumlah'].",
                                        y: ".$r['persen']."
                                        }, {
                                    ";
                                }else{
                                    echo "
                                        name: '".$r['keterangan']."',
                                        value: ".$r['jumlah'].",
                                        y: ".$r['persen']."
                                    ";
                                }
                                    $b=$b+1;
                                }
                            ?>  
                            }]
                        }]
                    });
                });


                <?php
                $sql1=mysqli_query($Open,"select * from edop_diagram_es where keterangan='k1' and ta = '".$pertax."'");
                $r1=mysqli_fetch_array($sql1);
                ?>
                $(function () {

                    $('#container2').highcharts({
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                        <?php echo "text: 'EDOP (".$r1['total'].")' ";?>
                        },
                        tooltip: {
                            pointFormat: '{series.name} : <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    format: '<b>{point.name}</b> : {point.value:.0f} ({point.percentage:.1f} %)',
                                    style: {
                                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                    }
                                }
                            }
                        },
                        series: [{
                            name: 'Persentase',
                            colorByPoint: true,
                            data: [{
                            <?php
                            $b=1;
                                $sql=mysqli_query($Open,"select * from edop_diagram_es where ta = '".$pertax."'");
                                while($r=mysqli_fetch_array($sql)){
                                if($b<4){
                                    echo "
                                        name: '".$r['keterangan']."',
                                        value: ".$r['jumlah'].",
                                        y: ".$r['persen']."
                                        }, {
                                    ";
                                }else{
                                    echo "
                                        name: '".$r['keterangan']."',
                                        value: ".$r['jumlah'].",
                                        y: ".$r['persen']."
                                    ";
                                }
                                    $b=$b+1;
                                }
                            ?>  
                            }]
                        }]
                    });
                });

                //EPOM===============

                <?php
                $sql1=mysqli_query($Open,"select * from epom_diagram_es where keterangan='k1' and ta = '".$pertax."'");
                $r1=mysqli_fetch_array($sql1);
                ?>
                $(function () {

                    $('#container3').highcharts({
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                        <?php echo "text: 'EPOM (".$r1['total'].")' ";?>
                        },
                        tooltip: {
                            pointFormat: '{series.name} : <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    format: '<b>{point.name}</b> : {point.value:.0f} ({point.percentage:.1f} %)',
                                    style: {
                                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                    }
                                }
                            }
                        },
                        series: [{
                            name: 'Persentase',
                            colorByPoint: true,
                            data: [{
                            <?php
                            $b=1;
                                $sql=mysqli_query($Open,"select * from epom_diagram_es where ta = '".$pertax."'");
                                while($r=mysqli_fetch_array($sql)){
                                if($b<4){
                                    echo "
                                        name: '".$r['keterangan']."',
                                        value: ".$r['jumlah'].",
                                        y: ".$r['persen']."
                                        }, {
                                    ";
                                }else{
                                    echo "
                                        name: '".$r['keterangan']."',
                                        value: ".$r['jumlah'].",
                                        y: ".$r['persen']."
                                    ";
                                }
                                    $b=$b+1;
                                }
                            ?>  
                            }]
                        }]
                    });
                });

                //EPOD===============

                <?php
                $sql1=mysqli_query($Open,"select * from epod_diagram_es where keterangan='k1' and ta = '".$pertax."'");
                $r1=mysqli_fetch_array($sql1);
                ?>
                $(function () {

                    $('#container4').highcharts({
                        chart: {
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false,
                            type: 'pie'
                        },
                        title: {
                        <?php echo "text: 'EPOD (".$r1['total'].")' ";?>
                        },
                        tooltip: {
                            pointFormat: '{series.name} : <b>{point.percentage:.1f}%</b>'
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    format: '<b>{point.name}</b> : {point.value:.0f} ({point.percentage:.1f} %)',
                                    style: {
                                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                    }
                                }
                            }
                        },
                        series: [{
                            name: 'Persentase',
                            colorByPoint: true,
                            data: [{
                            <?php
                            $b=1;
                                $sql=mysqli_query($Open,"select * from epod_diagram_es where ta = '".$pertax."'");
                                while($r=mysqli_fetch_array($sql)){
                                if($b<4){
                                    echo "
                                        name: '".$r['keterangan']."',
                                        value: ".$r['jumlah'].",
                                        y: ".$r['persen']."
                                        }, {
                                    ";
                                }else{
                                    echo "
                                        name: '".$r['keterangan']."',
                                        value: ".$r['jumlah'].",
                                        y: ".$r['persen']."
                                    ";
                                }
                                    $b=$b+1;
                                }
                            ?>  
                            }]
                        }]
                    });
                });
                </script>
                <div class="row p-5">
                    
                
                <div class="col-md-12 text-center">
                    <h5>REKAPITULASI DOSEN</h5>
                    K1 (NA >= 4.0) | K2 (3.5 <= NA < 4.0) | K3 (3.0 <= NA < 3.5) | K4 (NA < 3.0) 
                    <hr>
                </div>
                
                <div id="container" class="col-md-6 "></div>
                <div id="container2" class="col-md-6 "></div>
                <div class="col-md-12 text-center m-t-10">
                    <h5>REKAPITULASI PRODI</h5>
                <hr>
                </div>
                <div id="container3" class="col-md-6 "></div>
                <div id="container4" class="col-md-6 "></div>
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
	
</script>