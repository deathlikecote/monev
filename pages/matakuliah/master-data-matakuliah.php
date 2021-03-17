<div class="row">
<?php	
	if ($_POST['save'] == "save") {
		$kodemk 	= strtoupper($_POST['kodemk']);
		$namamk 	= $_POST['namamk'];
		$namemk 	= $_POST['namemk'];
		$skst 		= $_POST['skst'];
		$sksp 		= $_POST['sksp'];
		$sks 		= $_POST['sks'];
		$kelmk 		= strtoupper($_POST['kelmk']);
		
		include "../config/koneksi.php";
		$cari=mysqli_query($Open,"SELECT * FROM m_matakuliah WHERE kodemk='".$kodemk."'") ;
	    $datas=mysqli_num_rows($cari);

	    if (empty($_POST['kodemk']) || empty($_POST['namamk'])) {
				$_SESSION['pesan'] = "Oops! Silahkan isi kolom mandatori ...";
				header("location:index.php?page=form-master-data-matakuliah");

		}else if($datas<1){
	    	$query = "INSERT INTO m_matakuliah (
	    	kodemk,
	    	namamk,
	    	namemk,
	    	skst,
	    	sksp,
	    	sks,
	    	kelmk
	    	) VALUES (
	    	'$kodemk',
	    	'$namamk',
	    	'$namemk',
	    	'$skst',
	    	'$sksp',
	    	'$sks',
	    	'$kelmk')";
	    	$hasil = mysqli_query($Open,$query);
	    	if(!$hasil){
	    		echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
	    	}else{
				$_SESSION['pesan'] = "Good! Data berhasil disimpan ...";
				header("location:index.php?page=form-view-data-matakuliah");
	    	}

	    }else{
	    		$_SESSION['pesan'] = "Oops! Data sudah ada ...";
				header("location:index.php?page=form-master-data-matakuliah");
	    }
	}
?>
</div>