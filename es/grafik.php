<?php 
    include "./../include/koneksi.php";
    if(isset($_POST['perta'])){
        $perta = $_POST['perta']; 
    }else{
        $perta = $_SESSION['pertan']; 
    }
?>
            
<script type="text/javascript">
	<?php

$sql1=mysqli_query($plm_edom,"select * from edom_diagram_es where keterangan='k1' and ta = '".$perta."' ");
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
            	$sql=mysqli_query($plm_edom,"select * from edom_diagram_es where ta = '".$perta."'");
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
$sql1=mysqli_query($plm_edom,"select * from edop_diagram_es where keterangan='k1' and ta = '".$perta."'");
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
            	$sql=mysqli_query($plm_edom,"select * from edop_diagram_es where ta = '".$perta."'");
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
$sql1=mysqli_query($plm_edom,"select * from epom_diagram_es where keterangan='k1' and ta = '".$perta."'");
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
            	$sql=mysqli_query($plm_edom,"select * from epom_diagram_es where ta = '".$perta."'");
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
$sql1=mysqli_query($plm_edom,"select * from epod_diagram_es where keterangan='k1' and ta = '".$perta."'");
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
            	$sql=mysqli_query($plm_edom,"select * from epod_diagram_es where ta = '".$perta."'");
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

            <div class="col-md-12" style="">
                
            
            <div class="col-md-12 centext" style="background: #a9dcf9;color: #333">REKAPITULASI DOSEN</div>
            <div class="col-md-12 centext" id="ket" style="background: #a9dcf9;color: #333"> K1(NA >= 4.0) | K2(3.5 <= NA < 4.0) | K3(3.0 <= NA < 3.5) | K4(NA < 3.0) </div>
            <div id="container" class="col-md-6 "></div>
            <div id="container2" class="col-md-6 "></div>
            <div class="col-md-12 centext" style="background: #a9dcf9;color: #333">REKAPITULASI PRODI</div>
            <div id="container3" class="col-md-6 "></div>
            <div id="container4" class="col-md-6 "></div>
            </div>