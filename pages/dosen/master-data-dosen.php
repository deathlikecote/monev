<div class="row">
<?php	
	if ($_POST['save'] == "save") {
		$kodedosen 	= strtoupper($_POST['kodedosen']);
		$nama 		= $_POST['nama'];
		
		include "../config/koneksi.php";
		$cari=mysqli_query($Open,"select * from m_dosen where kodedosen='".$kodedosen."'") ;
	    $datas=mysqli_num_rows($cari);
	    if (empty($_POST['kodedosen']) || empty($_POST['nama'])) {
				$_SESSION['pesan'] = "Oops! Silahkan isi kolom mandatori ...";
				header("location:index.php?page=form-master-data-dosen");

		}else if($datas<1){
	    	$query = "INSERT INTO m_dosen (kodedosen, nama) VALUES ('$kodedosen', '$nama')";
	    	$hasil = mysqli_query($Open,$query);
	    	if(!$hasil){
	    		echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
	    	}else{
	    		$insert = "INSERT INTO m_user (nama_user, nama, passtext, password, hak_akses, avatar, status) VALUES ('$kodedosen', '".$_POST['nama']."', '".$GLOBALS['passTextDef']."', '".$GLOBALS['passDef']."', 'Dosen', '', '1')";
				$query = mysqli_query ($Open,$insert);
				
				if($query){
					$_SESSION['pesan'] = "Good! Data berhasil disimpan ...";
					header("location:index.php?page=form-view-data-dosen");
				}
					else {
						echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
					}
	    		
	    	}

	    }else{
	    		$_SESSION['pesan'] = "Oops! Prodi sudah ada ...";
				header("location:index.php?page=form-master-data-dosen");
	    }
	}
?>
</div>