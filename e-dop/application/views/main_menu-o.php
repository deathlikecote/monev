<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	<title>EDOP</title>
	<?php echo $assets; ?>
	
	<style type="text/css">		
	</style>	
	
	<script type="text/javascript">
	</script>	
</head>

<body class="clouds">
	<a href="<?php echo base_url();?>satpam/logout" class="logout  peterriver"><br>Logout</a>

	<ul class="kotak" >
		<li class="xheader asbestos">
			<?php echo image_asset('c_logowhitetransp.png','',array('class'=>'logo')); ?>		
			<div class="judul">E D O P<small>Evaluasi Dosen Oleh Prodi</small>
				<span>POLTEKPAR PALEMBANG</span>
			</div>
		</li>
		<li class="xinfo alizarin">
			<div>
				<b><?php echo $this->session->userdata('namopt');?>/<?php echo $this->session->userdata('nimopt');?></b> anda telah mengerjakan
				<span>
					<?php echo $diisi.'/'.$kewajiban; ?>
				</span>			
				bagian dari total quesioner<?php echo $wow;?>
			</div>
        	</li>
		<?php echo $kotak;?>
	</ul>
</body>
</html>