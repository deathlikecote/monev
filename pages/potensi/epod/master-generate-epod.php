<div class="row">
<?php	
	if ($_POST['save'] == "save") {
		$kdprodi	= $_POST['kdprodi'];
		$kodemk		= $_POST['kodemk'];
		$kodedosen	= $_POST['kodedosen'];
		$pertext    = $_SESSION['perteks'];
		$utsuas     = $_SESSION['utsuas'];

		include "../config/koneksi.php";
$row=mysqli_query($Open,"select a.*, b.namamk from t_penugasan a, m_matakuliah b where (a.perta = '".$_SESSION['perta']."' AND a.kodedosen = '$kodedosen') and (b.kodemk = a.kodemk) group by a.kodedosen, a.kdprodi, a.kodemk") ;

while($data=mysqli_fetch_array($row)){

		$dosenosplit = $data['kodedosen'];
		$myArray = explode('/', $dosenosplit);
		foreach($myArray as $dosensplit){

		$kedops 	= $dosensplit."".$data['kodemk']."".$data['kdprodi'];
		$kodedps	= $dosensplit."".$data['kdprodi'];

		$caripot=mysqli_query($Open,"select * from exoxpotensi where ta='".$_SESSION['perta']."' and concat(kodedosen,kodemk,idprogstudi) = '".$kedops."'") ;
		$datapot=mysqli_num_rows($caripot);
		if($datapot<1){

			$nmdosen=mysqli_query($Open,"select nama from m_dosen where kodedosen = '".$dosensplit."'") ;
			$data_nmdosen=mysqli_fetch_assoc($nmdosen);
			if(empty($data_nmdosen['nama'])){
				$data_nmdosen['nama'] = '?';
			}

			$query = "INSERT INTO exoxpotensi 
			(
				ta,
				per,
				utsuas,
				kodemk,
				kodedosen,
				idprogstudi,
				done_p,
				done_d,
				namamk,
				namadosen,
				spote_p,
				spote_d,
				epodpot,
				kedop,
				kodedp
			)
			 VALUES (
			 	'".$data['perta']."',
				'".$pertext."',
				'".$utsuas."',
				'".$data['kodemk']."',
				'".$dosensplit."',
				'".$data['kdprodi']."',
				'0',
				'0',
				'".$data['namamk']."',
				'".$data_nmdosen['nama']."',
				'0',
				'0',
				'0',
				'".$kedops."',
				'".$kodedps."'
			 	)";
			$hasil = mysqli_query($Open,$query);
			if(!$hasil){
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}else{
				$_SESSION['pesan'] = "Good! Data berhasil disimpan ...";
				header("location:index.php?page=form-view-generate-epod");
			
			}
		}else{
			$_SESSION['pesan'] = "Oops! Data sudah ada ...";
				header("location:index.php?page=form-view-generate-epod");
		}
	} //eof spitdosen
}
}

?>
</div>