<div class="row">
<?php	
	if ($_POST['save'] == "save") {
		$kdprodi	= $_POST['kdprodi'];
		$kelas		= $_POST['kelas'];
		$nim		= $_POST['nim'];
		$pertext    = $_SESSION['perteks'];
		$utsuas     = $_SESSION['utsuas'];

		include "../config/koneksi.php";

	mysqli_query($Open,"DELETE FROM edompotensi WHERE ta = '".$_SESSION['perta']."' AND nim ='$nim'");
	mysqli_query($Open,"DELETE FROM epompotensi WHERE ta = '".$_SESSION['perta']."' AND nim ='$nim'");


	$row=mysqli_query($Open,"SELECT * FROM t_kelas WHERE perta = '".$_SESSION['perta']."' AND nim ='$nim'") ;
	$data=mysqli_fetch_array($row);
	$cari=mysqli_query($Open,"
		SELECT 
			a.*, b.namamk
		FROM 
			t_penugasan a, m_matakuliah b
		WHERE
			(a.perta = '".$_SESSION['perta']."' and 
			a.kdprodi='".$data['kdprodi']."' and 
			a.kelas = '".$data['kelas']."') and
			(b.kodemk = a.kodemk)
			GROUP BY a.kdprodi, a.kelas, a.kodemk, a.kodedosen order by a.kodedosen asc");

		while($kur=mysqli_fetch_array($cari)){
		

		$dosenosplit = $kur['kodedosen'];
		$myArray = explode('/', $dosenosplit);
		foreach($myArray as $dosensplit){

		$kodex 	= $dosensplit."".$kur['kodemk']."".$kur['kdprodi']."".$kur['kelas'];
		$kodex2 = $dosensplit."".$kur['kdprodi'];

		$caripot=mysqli_query($Open,"select * from edompotensi where ta='".$_SESSION['perta']."' and nim='".$data['nim']."' and kodemk = '".$kur['kodemk']."' and idprogstudi = '".$data['kdprodi']."' and kelas = '".$data['kelas']."' and kodedosen = '".$dosensplit."'") ;
		$datapot=mysqli_num_rows($caripot);
		if($datapot<1){
			
			$nmdosen=mysqli_query($Open,"select nama from m_dosen where kodedosen = '".$dosensplit."'") ;
			$data_nmdosen=mysqli_fetch_assoc($nmdosen);
			if(empty($data_nmdosen['nama'])){
				$data_nmdosen['nama'] = '?';
			}
			$query = "INSERT INTO edompotensi 
			(
				ta,
				per,
				utsuas,
				nim,
				kodemk,
				kodedosen,
				idprogstudi,
				done,
				namamk,
				namadosen,
				spote,
				kelas,
				kode,
				kode2
			)
			 VALUES (
			 	'".$data['perta']."',
				'".$pertext."',
				'".$utsuas."',
				'".$data['nim']."',
				'".$kur['kodemk']."',
				'".$dosensplit."',
				'".$kur['kdprodi']."',
				'0',
				'".$kur['namamk']."',
				'".$data_nmdosen['nama']."',
				'0',
				'".$data['kelas']."',
				'".$kodex."',
				'".$kodex2."'
			 	)";
			$hasil = mysqli_query($Open,$query);
			if(!$hasil){
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}
			}
	} //eof split dosen

	}

		$kodex 	= $data['kdprodi']."".$data['kelas'];

		$caripot=mysqli_query($Open,"SELECT * FROM epompotensi WHERE ta='".$_SESSION['perta']."' and nim='".$data['nim']."' and idprogstudi = '".$data['kdprodi']."' and kelas_id = '".$data['kelas']."'") ;
		$datapot=mysqli_num_rows($caripot);
		if($datapot<1){
			$query = "INSERT INTO epompotensi 
			(
				ta,
				per,
				utsuas,
				nim,
				idprogstudi,
				done,
				spote,
				kelas_id,
				kode
			)
			 VALUES (
				'".$data['perta']."',
				'".$pertext."',
				'".$utsuas."',
				'".$data['nim']."',
				'".$data['kdprodi']."',
				'0',
				'0',
				'".$data['kelas']."',
				'".$kodex."'
			 	)";
			$hasil = mysqli_query($Open,$query);
			if(!$hasil){
				echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
			}else{
				$_SESSION['pesan'] = "Good! Data berhasil disimpan ...";
				header("location:index.php?page=form-view-generate-edom");
			}
			}else{
				$_SESSION['pesan'] = "Good! Data berhasil disimpan ...";
				header("location:index.php?page=form-view-generate-edom");
			}
}

?>
</div>