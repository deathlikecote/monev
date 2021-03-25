<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	<title>e-POD</title>
	<?php echo $assets; ?>
	
	<style type="text/css">		
	</style>	
	
	<script type="text/javascript">
	</script>	
</head>

<body style="background-color: #E4E7E8;">
	<?php 
if(date('Y-m-d') < $this->session->userdata('tgl_awal')){
	$mtglawal=date_create($this->session->userdata('tgl_awal'));
	$tglawal = date_format($mtglawal,"d M Y");
	echo '
	<div style="margin-top:50px; text-align:center;">
		<h2 style="color: green">Jadwal pengisian EPOD akan dibuka pada<br>'.$tglawal.'</h2>
	</div>
	';
}else if(date('Y-m-d') >= $this->session->userdata('tgl_akhir')){
	$mtglakhir=date_create($this->session->userdata('tgl_akhir'));
	$tglakhir = date_format($mtglakhir,"d M Y");
	echo '
	<div style="margin-top:50px; text-align:center;">
		<h2 style="color: green">Jadwal pengisian EPOD telah berakhir pada<br>'.$tglakhir.'</h2>
	</div>
	';
}else{
	?>
	<ul class="kotak" style="margin-top: -50px">
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
<?php } ?>
</body>
</html>