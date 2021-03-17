<div class="row">
<?php	
	if ($_POST['save'] == "save") {
		$tim 	= strtoupper($_POST['tim']);
		
		include "../config/koneksi.php";
		$cari=mysqli_query($Open,"select * from m_timdosen where tim='".$tim."'") ;
	    $datas=mysqli_num_rows($cari);
	    if (empty($_POST['tim'])) {
				$_SESSION['pesan'] = "Oops! Silahkan isi kolom mandatori ...";
				header("location:index.php?page=form-master-data-timdosen");

		}else if($datas<1){
	    	$query = "INSERT INTO m_timdosen (tim) VALUES ('$tim')";
	    	$hasil = mysqli_query($Open,$query);
	    	if(!$hasil){
	    		echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
	    	}else{
				$_SESSION['pesan'] = "Good! Data berhasil disimpan ...";
				header("location:index.php?page=form-view-data-timdosen");
	    	}

	    }else{
	    		$_SESSION['pesan'] = "Oops! Data sudah ada ...";
				header("location:index.php?page=form-master-data-timdosen");
	    }
	}
?>
</div>