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

<body class="clouds">

	<ul class="kotak" >
		<li class="xheader asbestos">
			<?php echo image_asset('c_logowhitetransp.png','',array('class'=>'logo')); ?>		
			<div class="judul"><small>PORTAL MAHASISWA</small>
				<span>POLTEKPAR PALEMBANG</span>
			</div>
		</li>
		
<a href="<?php echo base_url();?>akun">
		<li class="xinfo alizarin" id="profile_click">
			<div>
				Selamat datang, 
				<b><h3><?php echo $this->session->userdata('namopt');?> / <?php echo $this->session->userdata('nimopt');?></h3></b>
				<h4><?php echo $idprogstudi;?> / <?php echo $kelas;?></h4>
			</div>
		</li>
</a>
		<li class="mm2item belizehole">
		<div class="imej2 ">
                    ABSENSI
			<span>
                        </span>
		</div>
		<div class="xtext">
		</div>
		</li>
		<li class="mm2item belizehole">
		<div class="imej2 ">
                    NILAI
			<span>
                        </span>
		</div>
		<div class="xtext">
		</div>
		</li>
<?php if ($kewajiban_edom) :?>		
<a href="<?php echo base_url();?>main_menu/nim/<?php echo $nim; ?>/<?php echo $xxx; ?>">
		<li class="mm2item belizehole">
		<div class="imej2 ">
                    EDOM
			<span>
Evaluasi Dosen Oleh Mahasiswa
                        </span>
		</div>
		<div class="xtext">
		</div>
		</li>
</a>
<?php else:?>
		<li class="mm2item belizehole">
		<div class="imej2 ">
                    EDOM
			<span>
Evaluasi Dosen Oleh Mahasiswa
                        </span>
		</div>
		<div class="xtext">
		</div>
		</li>
<?php endif;?>	
		
<?php if ($kewajiban_edom) :?>		
<a href="<?php echo base_url();?>main_menu/quiz2/">
		<li class="mm2item belizehole">
		<div class="imej2 ">
                    EPOM
			<span>
Evaluasi Prodi Oleh Mahasiswa
                        </span>
		</div>
		<div class="xtext">
		</div>
		</li>
</a>
<?php else:?>
		<li class="mm2item belizehole">
		<div class="imej2 ">
                    EPOM
			<span>
Evaluasi Prodi Oleh Mahasiswa
                        </span>
		</div>
		<div class="xtext">
		</div>
		</li>
<?php endif;?>	
		
	</ul>
</body>

<script>
	$('#profile_click').on('hover', function(data){
		$('#profile_click').append('<h3>Klik ini untuk personal setting</h3>')		
	});
	

</script>
</html>