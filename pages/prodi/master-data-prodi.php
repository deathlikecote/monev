<div class="row">
<?php	
	if ($_POST['save'] == "save") {
		$kodeprodi 	= strtoupper($_POST['kodeprodi']);
		$namaprodi 	= strtoupper($_POST['namaprodi']);
		$jurprodi 	= strtoupper($_POST['jurprodi']);
		$jenprodi 	= strtoupper($_POST['jenprodi']);
		
		include "../config/koneksi.php";
		$cari=mysqli_query($Open,"select * from m_prodi where kodeprodi='".$kodeprodi."'") ;
	    $datas=mysqli_num_rows($cari);
	    if (empty($_POST['kodeprodi']) || empty($_POST['namaprodi']) || empty($_POST['jenprodi'])) {
				$_SESSION['pesan'] = "Oops! Silahkan isi kolom mandatori ...";
				header("location:index.php?page=form-master-data-prodi");

		}else if($datas<1){
	    	$query = "INSERT INTO m_prodi (kodeprodi, namaprodi, jurprodi, jenprodi) VALUES ('$kodeprodi', '$namaprodi', '$jurprodi', '$jenprodi')";
	    	$hasil = mysqli_query($Open,$query);
	    	if(!$hasil){
	    		echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
	    	}else{
	    		$insert = "INSERT INTO m_user (nama_user, nama, passtext, password, hak_akses, avatar, status) VALUES ('$kodeprodi', '".$_POST['namaprodi']."', '".$GLOBALS['passTextDef']."', '".$GLOBALS['passDef']."', 'Prodi', '', '1')";
				$query = mysqli_query ($Open,$insert);
				
				if($query){
					$_SESSION['pesan'] = "Good! Data berhasil disimpan ...";
					header("location:index.php?page=form-view-data-prodi");
				}
					else {
						echo "<div class='register-logo'><b>Oops!</b> 404 Error Server.</div>";
					}
	    		
	    	}

	    }else{
	    		$_SESSION['pesan'] = "Oops! Prodi sudah ada ...";
				header("location:index.php?page=form-master-data-prodi");
	    }
	}
?>
</div>