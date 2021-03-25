<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	<title>e-DOP</title>
	<?php echo $assets; ?>
	
	<style type="text/css">		
	</style>	
	
	<script type="text/javascript">
	</script>	
</head>

<body class="clouds">
	<ul class="kotak" >
		<li class="xheader asbestos">
			<?php echo image_asset('c_logowhitetransp.png','',array('class'=>'logo')); ?>		
			<div class="judul">E D O P<small>Evaluasi Dosen Oleh Prodi</small>
				<span>POLTEKPAR PALEMBANG</span>
			</div>
		</li>
	<!-- <a href="<?php echo base_url();?>./../pd/edop.php">			
		<li class="mm2item belizehole">
		<div class="imej2">
                    HOME
			<span>Portal Prodi
                        </span>
		</div>
		<div class="xtext">
		
		</div>
		</li>
		</a> -->

	
		<!-- <li class="xheader asbestos">
			<?php echo image_asset('c_logowhitetransp.png','',array('class'=>'logo')); ?>		
			<div class="judul">e - D O P<small>Evaluasi Dosen Oleh Prodi</small>
				<span>POLTEKPAR<br>PALEMBANG</span>
			</div>
		</li> -->
		<li class="xinfo alizarin">
			<div>
				<b style="font-size: 1.2em;"><?php echo $this->session->userdata('namopt');?>/<?php echo $this->session->userdata('nimopt');?></b> anda telah mengerjakan
				<span>
					<?php echo $diisi.'/'.$kewajiban; ?>
				</span>			
				bagian dari total quesioner<?php echo $wow;?>
			</div>
                    <a href="<?php echo base_url();?>./../pd/edop.php">
                    <div class="ling peterriver" style="margin-top: -15px">
                        HOME
                    </div>
	            </a>

			<!-- <div>
				<b><?php echo $this->session->userdata('namopt');?>/<?php echo $this->session->userdata('nimopt');?></b> anda telah mengerjakan
				<span>
					<?php echo $diisi.'/'.$kewajiban; ?>
				</span>			
				bagian dari total quesioner<?php echo $wow;?>
			</div> -->
        	</li>
		<?php echo $kotak;?>
	</ul>
</body>
</html>