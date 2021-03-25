<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>AKUN</title>
	<?php echo $assets; ?>
	
	<script type="text/javascript">
		
//		alert();
			
	</script>
	
</head>

<body class="clouds">
<a href="<?php echo base_url();?>satpam/logout" class="logout peterriver"><br>Logout</a>
	<ul class="kotak3" >
		<li>
			<ul>
		<li class="xheader asbestos">
			<div class="judul">A K U N
				<small><b><?php echo ucfirst($this->session->userdata('namopt')) ;?> / <?php echo $this->session->userdata('nimopt');?></b></small>
			</div>
		</li>
		<li class="xinfo alizarin">
			<div>
			Personal
			</div>
		</li>
		<li class="xinfo alizarin">
			<div>
			Password
			</div>
		</li>
		<a href="<?php echo base_url();?>main_menu/nim2/<?php echo $this->session->userdata('nimopt'); ?>/<?php echo $edok; ?>">
		<li class="xinfo peterriver">
			<div>
				MAIN MENU
			</div>
		</li>
		</a>
			</ul>
		</li>
		<li class="petunjuk alizarin">
			<div class="keterangan">
				sadlkfjdjf
			</div>
		</li>
	</ul>
<?php echo $this->load->view('layout/footer.php'); ?>