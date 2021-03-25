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
	<!-- <a href="<?php echo base_url();?>satpam/logout" class="logout  peterriver"><br>Logout</a> -->

	

	
	<div style="margin:0 auto;width:50%;text-align:center;"><br><br>
	 <a href="<?php echo base_url();?>main_menu/nim2/<?php echo $this->session->userdata('nimopt'); ?>/<?php echo $edok; ?>">
                    <div class="ling peterriver" style="margin:0 auto;width:50%;text-align:center;padding:10px">
                        HOME
                    </div>
	            </a>
	<h1>PENGAJUAN SIDANG<br> <?php echo $this->session->userdata('nimopt'); ?><br>
	<?php 
	$dbsisak = $this->load->database('sisak',TRUE);
	$query = $dbsisak->query("select sum(sks) as sks, sum(bobot*sks) as bobot from t_nilai where nim=".$this->session->userdata('nimopt')." group by nim");	
		
		if ($query->num_rows() > 0)
			{
  				$row = $query->row(); 
  				$tot=$row->bobot/$row->sks;
  				echo "IPK ".number_format($tot,2);
   				
			}	
	 ?></h1>
	<p>
	<label>Periode Sidang</label>
	<select name="persidang">
	<option value="JAN-APR">JAN-APR</option>
	<option value="AGT-OKT">AGT-OKT</option>
	</select>
	<?php //echo $nama;?>
	</p>
	
	<p>
	<label>Tahun Akademik</label>
	<select name="persidang">
	<option value="2015/2016">2015/2016</option>
	<option value="2016/2017">2016/2017</option>
	</select>
	<?php //echo $nama;?>
	</p>
	
	</div>
</body>

<script>
//	$('#profile_click').on('hover', function(data){
//		$('#profile_click').append('<h3>Klik ini untuk personal setting</h3>')		
//	});
	

</script>
</html>