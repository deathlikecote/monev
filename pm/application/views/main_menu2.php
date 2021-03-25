<?php
// Start the session
session_start();
include "koneksi.php";
//include "http://sisak.poltekpar-palembang.ac.id/master/master/cekpm.php";


$_SESSION['nimses']=$this->session->userdata('nimopt');
$qrstat=mysqli_query($plm, "select * from tglupdatepm");
$sstatus=mysqli_fetch_array($qrstat);
//$ddstat-mysqli_fetch_array($qrstat);
$buka=$sstatus['status'];
//print($_SESSION['nimses']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	<title>PORTAL MAHASISWA</title>
	<?php echo $assets; ?>
	
	<script type="text/javascript">
		$(document).ready(function(){
			$('#imgpc').remove();
			$('#imghp').remove();
		})
	</script>	
</head>
<style type="text/css">
body{
	background: url('./../../../assets/images/bg.png') no-repeat center center fixed;
	    -webkit-background-size: cover;
	    -moz-background-size: cover;
	    -o-background-size: cover;
	    background-size: cover;
}
	.mm2item{
		height: 50px
	}


</style>
<body class="">
 <?php  $this->load->view('welcome_message'); ?>
 
<div id="framemenu" >
		<ul class="kotak" style="margin-top: 0px;margin-bottom: 10px;width: 100%;">
		<li class="mm2item asbestos" id="liabsen" style="" >
		<div class="imej2 " style="padding:15px 0;">
			ABSENSI
			<span>
				Rekapitulasi Absensi<br>
				<b><?php echo $zzz['rekap'].' | Total='.$zzz['total'];?></b>
				<br>
				Surat Peringatan<br>
				<b><?php echo $sp['sp1'];?></b><br>
				<b><?php echo $sp['sp2'];?></b><br>
				<b><?php echo $sp['sp3'];?></b><br>
				<b><?php echo $sp['sk'];?></b><br>
			</span>
		</div>
		<div class="xtext">
		</div>
		</li>

		<li class=" amethyst" id="li2item">
			<div>
			<?php include "hcipkspeedo.php"; ?>
			</div>
			<div style="clear: both;"></div>
		</li>

<!--		<a style="line-height: 40px; font-size: 14pt" id="adec" href="../../../../updatedata/edit_mahasiswapm.php?id=<?php echo $this->session->userdata('nimopt');?>">	-->		
<!--

		<a style="line-height: 40px; font-size: 14pt" id="adec" href="../../../../updatedata/edit_mahasiswapm.php">			
		<li class=" belizehole" id="li2item">
		UPDATE DATA
		</li>
		</a>
-->
		<?php if($buka!=0){   ?>
		<a id="adec" href="http://sisak.poltekpar-palembang.ac.id/master/master/edit_mahasiswapm.php?id=<?php echo $this->session->userdata('nimopt'); ?>">			
		<li class=" green" id="li2item">
			<div id="iconmenu">
				<img id="imgmenu"  src="./../../../assets/images/icons/w_pencil-100.png">
			</div>	
			<div class="teksmenu" id="judulmenu">UPDATE DATA</div>
			<div style="clear: both;"></div>
		</li>
		</a>
	<?php } ?>
<!--
		<a style="line-height: 40px; font-size: 14pt" id="adec" href="<?php echo base_url();?>pengumuman/">			
		<li class=" belizehole" id="li2item">
		PENGUMUMAN
		</li>
		</a>
-->
		<a id="adec" href="<?php echo base_url();?>pengumuman/">			
		<li class=" belizehole" id="li2item">
			<div id="iconmenu">
				<img id="imgmenu"  src="./../../../assets/images/icons/icon-megaphone-100.png">
			</div>	
			<div class="teksmenu" id="judulmenu">PENGUMUMAN</div>
			<div style="clear: both;"></div>
		</li>
		</a>


		<a id="adec" href="<?php echo base_url();?>nilai/daftar/<?php echo $this->session->userdata('nimopt');?>">			
		<li class=" amethyst" id="li2item">
			<div id="iconmenu">
				<img id="imgmenu"  src="./../../../assets/images/icons/icons8-list-50.png">
			</div>	
			<div class="teksmenu" id="judulmenu">DAFTAR NILAI</div>
			<div style="clear: both;"></div>
		</li>
		</a>
		
		<?php if ($this->session->userdata('statedom')==1) :?>			
		<?php if ($kewajiban_edom) :?>		
		<a id="adec" href="<?php echo base_url();?>main_menu/nim/<?php echo $nim; ?>/<?php echo $xxx; ?>">
				<li class=" orange" id="li2item">
					<div id="iconmenu">
						<img id="imgmenu"  src="./../../../assets/images/icons/icons8-test-passed-filled-100.png">
					</div>	

					<div class="teksmenu" id="judulmenu">EDOM <span id="spansubjudul">Evaluasi Dosen Oleh Mahasiswa</span></div>
					<div style="clear: both;"></div>
				</li>
		</a>
		<?php else:?>
				<li class=" orange" id="li2item">
					<div id="iconmenu">
						<img id="imgmenu"  src="./../../../assets/images/icons/icons8-test-passed-filled-100.png">
					</div>	

					<div class="teksmenu" id="judulmenu">EDOM <span id="spansubjudul">Evaluasi Dosen Oleh Mahasiswa</span></div>
					<div style="clear: both;"></div>
				</li>
		<?php endif;?>	
				
		<?php if ($kewajiban_edom) :?>		
		<a id="adec" href="<?php echo base_url();?>main_menu/quiz2/">
				<li class=" yellow" id="li2item">
					<div id="iconmenu">
						<img id="imgmenu"  src="./../../../assets/images/icons/icons8-exam-filled-100.png">
					</div>	

					<div class="teksmenu" id="judulmenu">EPOM <span id="spansubjudul">Evaluasi Prodi Oleh Mahasiswa</span></div>
					<div style="clear: both;"></div>
				</li>
		</a>
		<?php else:?>
				<li class=" yellow" id="li2item">
					<div id="iconmenu">
						<img id="imgmenu"  src="./../../../assets/images/icons/icons8-exam-filled-100.png">
					</div>	

					<div class="teksmenu" id="judulmenu">EPOM <span id="spansubjudul">Evaluasi Prodi Oleh Mahasiswa</span></div>
					<div style="clear: both;"></div>
				</li>
		<?php endif;?>	
		<?php else:?>
			<li class=" orange" id="li2item">
					<div id="iconmenu">
						<img id="imgmenu"  src="./../../../assets/images/icons/icons8-test-passed-filled-100.png">
					</div>	

					<div class="teksmenu" id="judulmenu">EDOM <span id="spansubjudul">Evaluasi Dosen Oleh Mahasiswa</span></div>
					<div style="clear: both;"></div>
				</li>
				
			<li class=" yellow" id="li2item">
					<div id="iconmenu">
						<img id="imgmenu"  src="./../../../assets/images/icons/icons8-exam-filled-100.png">
					</div>	

					<div class="teksmenu" id="judulmenu">EPOM <span id="spansubjudul">Evaluasi Prodi Oleh Mahasiswa</span></div>
					<div style="clear: both;"></div>
				</li>
		<?php endif;?>
		<a href="<?php echo base_url();?>pembayaran">
				<li class=" orange" id="li2item">
					<div id="iconmenu">
						<img id="imgmenu"  src="./../../../assets/images/icons/icon-megaphone-100.png">
					</div>	

					<div class="teksmenu" id="judulmenu">Pembayaran</div>
					<div style="clear: both;"></div>
				</li>
		</a>
				<a id="adec" href="<?php echo base_url();?>satpam/logout">
				<li class=" darkgrey" id="li2item">
					<div id="iconmenu">
						<img id="imgmenu"  src="./../../../assets/images/icons/icons8-export-filled-100.png">
					</div>	

					<div class="teksmenu" id="judulmenu">LOGOUT</div>
					<div style="clear: both;"></div>
				</li>
		</a>
			</ul>
	</div>


	<div id="framebanner" >
		<?php  $this->load->view('banner'); ?>
	</div>


</body>

<script>
//	$('#profile_click').on('hover', function(data){
//		$('#profile_click').append('<h3>Klik ini untuk personal setting</h3>')		
//	});
	

</script>
</html>