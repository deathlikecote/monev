
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	<title>EDOM</title>
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
	<div class="text-center" style="margin-top:100px">
		<h3 class="text-success">Jadwal pengisian EDOM akan dibuka pada<br>'.$tglawal.'
	</div>
	';
}else if(date('Y-m-d') >= $this->session->userdata('tgl_akhir')){
	$mtglakhir=date_create($this->session->userdata('tgl_akhir'));
	$tglakhir = date_format($mtglakhir,"d M Y");
	echo '
	<div class="text-center" style="margin-top:100px">
		<h3 class="text-success">Jadwal pengisian EDOM telah berakhir pada<br>'.$tglakhir.'</h3>
	</div>
	';
}else{
	
 ?>
<div class="">
	<ul class="kotak" >
		<li class="xinfo alizarin">
			<div>
				<b style="font-size: 1.2em;"><?php echo $this->session->userdata('namopt');?><br><?php echo $this->session->userdata('nimopt');?></b> anda telah mengerjakan
				<span>
					<?php echo $diisi.'/'.$kewajiban; ?>
				</span>			
				bagian dari total quesioner<?php echo $wow;?><br><?php echo $error;?>

			</div>
                    
        	</li>
		<?php echo $kotak;?>
	</ul>
</div>
</body>
</html>
<?php } ?>